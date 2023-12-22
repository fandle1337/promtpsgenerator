<?php

namespace App\Service;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;
use App\Dto\DtoTemplate;
use App\Exception\ExceptionPrompt;
use App\Repository\Rest\RepositoryPrompt as RepositoryRestPrompt;
use App\Repository\Storage\RepositoryPortal;
use App\Repository\Storage\RepositoryPrompt;
use App\Repository\Storage\RepositoryTemplate;

class ServicePrompt extends ServiceAbstract
{
    public function __construct(
        protected RepositoryTemplate   $repositoryTemplate,
        protected RepositoryPortal     $repositoryPortal,
        protected RepositoryPrompt     $repositoryPrompt,
        protected RepositoryRestPrompt $repositoryRestPrompt,
    )
    {
        parent::__construct($this->repositoryPortal);
    }

    /**
     * @throws ExceptionPrompt
     */
    public function add(DtoPrompt $dtoPrompt): bool
    {
        $dtoPrompt->portalId = $this->dtoPortal->id;

        if ($this->repositoryPrompt->isHasByPortalId($this->dtoPortal->id, $dtoPrompt->code)) {
            throw new ExceptionPrompt('Промпт с таким кодом уже зарегистрирован на портале.');
        }

        if (!$this->repositoryRestPrompt->register($dtoPrompt)) {
            throw new ExceptionPrompt('Ошибка регистрации, проверьте данные.');
        }

        return $this->repositoryPrompt->add($dtoPrompt);
    }

    public function delete(int $promptId): bool
    {
        $this->repositoryRestPrompt->unregister(
            $this->repositoryPrompt->getCodeById($promptId)
        );

        return $this->repositoryPrompt->deleteById($promptId, $this->dtoPortal->id);
    }

    public function list(DtoFilter $dtoFilter): array
    {
        if ($dtoFilter->showTemplates) {
            $templateList = $this->repositoryTemplate->getAll($dtoFilter);
            $promptList = $this->repositoryPrompt->getAllByPortalId($dtoFilter, $this->dtoPortal->id);

            return array_merge($promptList, $this->getNonInstallTemplateList($templateList, $promptList));
        }
        return $this->repositoryPrompt->getAllByPortalId($dtoFilter, $this->dtoPortal->id);
    }

    /**
     * @param DtoTemplate[] $templateList
     * @param DtoPrompt[] $promptList
     * @return array
     */
    protected function getNonInstallTemplateList(array $templateList, array $promptList): array
    {
        $promptCodes = array_column($promptList, 'code');

        $nonInstalledTemplates = array_filter(
            $templateList,
            function (DtoTemplate $template) use ($promptCodes) {
                return !in_array($template->code, $promptCodes);
            }
        );

        return array_values($nonInstalledTemplates);
    }

    public function generateCodeForPrompt(): string
    {
        return 'rest_sw_' . $this->dtoPortal->id . '_' . (int)microtime(true);
    }
}
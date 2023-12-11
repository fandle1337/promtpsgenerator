<?php

namespace App\Service;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;
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

    public function add(DtoPrompt $dtoPrompt): bool
    {
        $dtoPrompt->portalId = $this->dtoPortal->id;

        if ($this->repositoryPrompt->isUniqueCodeByPortalId($this->dtoPortal->id, $dtoPrompt->code)) {
            $this->repositoryPrompt->add($dtoPrompt);
            return $this->repositoryRestPrompt->register($dtoPrompt);
        }

        return false;
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
            $promptList = $this->repositoryPrompt->getByPortalId($dtoFilter, $this->dtoPortal->id);

            return array_merge($promptList, $templateList);
        }
        return $this->repositoryPrompt->getByPortalId($dtoFilter, $this->dtoPortal->id);
    }
}
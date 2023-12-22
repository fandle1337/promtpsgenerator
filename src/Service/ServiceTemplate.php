<?php

namespace App\Service;

use App\Repository\Storage\RepositoryPortal;
use App\Repository\Storage\RepositoryPrompt;
use App\Repository\Storage\RepositoryTemplate;
use App\Repository\Rest\RepositoryPrompt as RepositoryRestPrompt;


class ServiceTemplate extends ServiceAbstract
{
    public function __construct(
        protected RepositoryPortal   $repositoryPortal,
        protected RepositoryTemplate $repositoryTemplate,
        protected RepositoryPrompt   $repositoryPrompt,
        protected RepositoryRestPrompt $repositoryRestPrompt,
    )
    {
        parent::__construct($repositoryPortal);
    }

    public function copy(int $templateId): bool
    {
        $dtoTemplate = $this->repositoryTemplate->getById($templateId);
        if ($this->repositoryPrompt->isHasByPortalId($this->dtoPortal->id, $dtoTemplate->code)) {
            return false;
        }

        $dtoTemplate->portalId = $this->dtoPortal->id;

        $this->repositoryPrompt->add($dtoTemplate);

        return $this->repositoryRestPrompt->register($dtoTemplate);
    }
}
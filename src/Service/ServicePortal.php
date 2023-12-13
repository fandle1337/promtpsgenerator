<?php

namespace App\Service;

use App\Dto\DtoPortal;
use App\Repository\Storage\RepositoryPortal;
use App\Repository\Storage\RepositoryPrompt;

class ServicePortal
{
    public function __construct(
        protected RepositoryPortal $repositoryPortal,
        protected RepositoryPrompt $repositoryPrompt,
    )
    {
    }

    public function register(DtoPortal $dtoPortal): bool
    {
        if ($this->repositoryPortal->add($dtoPortal)) {
            return true;
        }
        return false;
    }
}
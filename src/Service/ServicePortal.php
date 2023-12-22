<?php

namespace App\Service;

use App\Dto\DtoPortal;
use App\Repository\Storage\RepositoryPortal;

class ServicePortal
{
    public function __construct(
        protected RepositoryPortal $repositoryPortal,
    )
    {
    }

    public function register(DtoPortal $dtoPortal): bool
    {
        if ($this->repositoryPortal->addOrUpdate($dtoPortal)) {
            return true;
        }
        return false;
    }
}
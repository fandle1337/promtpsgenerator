<?php

namespace App\Service;

use App\Dto\DtoPortal;
use App\Repository\Storage\RepositoryPortal;

class ServicePortal extends ServiceAbstract
{
    public function __construct(
        protected RepositoryPortal $repositoryPortal
    )
    {
        parent::__construct($repositoryPortal);
    }

    public function register(DtoPortal $dtoPortal): bool
    {
        if ($this->repositoryPortal->add($dtoPortal)) {
            return true;
        }
        return false;
    }
}
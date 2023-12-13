<?php

namespace App\Service;

use App\Dto\DtoFilter;
use App\Repository\Rest\RepositoryFilter;
use App\Repository\Storage\RepositoryPortal;

class ServiceFilter extends ServiceAbstract
{
    public function __construct(
        protected RepositoryPortal $repositoryPortal,
        protected RepositoryFilter $repositoryFilter,
    )
    {
        parent::__construct($repositoryPortal);
    }

    public function get(): DtoFilter
    {
        return $this->repositoryFilter->get();
    }

    public function set(DtoFilter $dtoFilter): bool
    {
        return $this->repositoryFilter->set($dtoFilter);
    }
}
<?php

namespace App\Service;

use App\Dto\DtoPortal;
use App\Repository\Storage\RepositoryPortal;

class ServiceAbstract
{
    protected DtoPortal $dtoPortal;
    public function __construct(
        protected RepositoryPortal $repositoryPortal,
    )
    {
        $b24client = (new \Sw24\Bitrix24Auth\Bitrix24Client())->getClient();
        $this->dtoPortal = $this->repositoryPortal->getByMemberId($b24client->getMemberId());
    }
}
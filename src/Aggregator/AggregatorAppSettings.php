<?php

namespace App\Aggregator;

use App\Dto\DtoAppSettings;
use App\Repository\Rest\RepositoryUser;
use App\Service\ServiceUserPermissions;
use Sw24\Bitrix24Auth\Bitrix24Client;

class AggregatorAppSettings
{
    public function __construct(
        protected RepositoryUser $repositoryUser,
        protected ServiceUserPermissions $serviceUserPermissions,
    )
    {
    }

    public function make(): DtoAppSettings
    {
        $client24 = (new Bitrix24Client())->getClient();
        $domain = $client24->getDomain();

        return new DtoAppSettings(
            $domain,
            $_ENV['MODULE_CODE'],
            $this->repositoryUser->getCurrentUserId(),
'A'
//            $this->serviceUserPermissions->get(),
        );
    }
}
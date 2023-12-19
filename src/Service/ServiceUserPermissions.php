<?php

namespace App\Service;

use App\Enum\EnumUserPermission;
use App\Repository\Rest\RepositoryUser;

class ServiceUserPermissions
{
    public function __construct(
        protected RepositoryUser $repositoryUser,
    )
    {
    }

    public function get(): string
    {
        if ($this->repositoryUser->isAdmin()) {
            return EnumUserPermission::ADMIN;
        } else {
            return EnumUserPermission::USER;
        }
    }
}
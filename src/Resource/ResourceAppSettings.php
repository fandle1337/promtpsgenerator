<?php

namespace App\Resource;

use App\Dto\DtoAppSettings;

class ResourceAppSettings
{
    public static function toArray(DtoAppSettings $dtoAppSettings): array
    {
        return [
            'domain' => $dtoAppSettings->domain,
            'module_code' => $dtoAppSettings->moduleCode,
            'user_id' => $dtoAppSettings->userId,
            'user_permission_group' => $dtoAppSettings->userPermission,
        ];
    }
}
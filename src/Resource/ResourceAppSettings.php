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
            'is_admin' => $dtoAppSettings->isAdmin,
        ];
    }
}
<?php

namespace App\Resource;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;

class ResourceFilter
{
    /**
     * @param DtoFilter $dtoFilter
     * @return array
     */
    public static function toArray(DtoFilter $dtoFilter): array
    {
        return [
            'showTemplates' => $dtoFilter->showTemplates,
            'placement' => $dtoFilter->category,
        ];
    }
}
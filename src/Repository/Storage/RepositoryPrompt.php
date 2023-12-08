<?php

namespace App\Repository\Storage;

use App\Dto\DtoFilter;
use App\Model\ModelPrompt;

class RepositoryPrompt
{
    public function getByPortalId(DtoFilter $dtoFilter, int $portalId): array
    {
        return ModelPrompt::where('portal_id', $portalId)
            ->get();
    }
}
<?php

namespace App\Repository\Storage;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;
use App\Model\ModelPrompt;

class RepositoryPrompt
{
    public function getByPortalId(DtoFilter $dtoFilter, int $portalId): array
    {
        $query = ModelPrompt::where('portal_id', $portalId);

        if ($dtoFilter->category !== '') {
            $query->whereJsonContains('categories', $dtoFilter->category);
        }

        $response = $query->get();

        foreach ($response as $row) {
            $result[] = new DtoPrompt(
                $row->id,
                $row->portal_id,
                json_decode($row->categories),
                $row->code,
                $row->icon,
                $row->prompt,
                $row->ru_name,
                $row->en_name,
                $row->parent_code,
                $row->sort,
                $row->date_created,
            );
        }

        return $result ?? [];
    }

    public function add(DtoPrompt $dtoPrompt): bool
    {
        $id = ModelPrompt::InsertGetId([
            'portal_id' => $dtoPrompt->portalId,
            'ru_name' => $dtoPrompt->ruName,
            'en_name' => $dtoPrompt->enName,
            'categories' => json_encode($dtoPrompt->categories),
            'code' => $dtoPrompt->code,
            'icon' => $dtoPrompt->icon,
            'prompt' => $dtoPrompt->prompt,
            'parent_code' => $dtoPrompt->parentCode,
            'sort' => $dtoPrompt->sort,
            'date_created' => $dtoPrompt->dateCreated ?? date('Y-m-d H:i:s'),
        ]);

        if (empty($id)) {
            return false;
        }
        return true;
    }

    public function deleteById(int $promptId, int $portalId): bool
    {
        $response = ModelPrompt::where('portal_id', $portalId)
            ->where('id', $promptId)
            ->delete();

        return $response > 0;
    }

    public function isUniqueCodeByPortalId(int $portalId, string $code): bool
    {
        $result = ModelPrompt::where('portal_id', $portalId)
            ->where('code', $code)
            ->count();

        return $result == 0;
    }

    public function getCodeById(int $promptId): string
    {
        $result = ModelPrompt::where('id', $promptId)
            ->first();

        return $result->code;
    }

    public function deleteAllByPortalId(int $portalId): bool
    {
        $result = ModelPrompt::where('portal_id', $portalId)
            ->delete();

        return $result > 0;
    }
}
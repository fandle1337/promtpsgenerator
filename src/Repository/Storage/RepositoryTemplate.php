<?php

namespace App\Repository\Storage;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;
use App\Dto\DtoTemplate;
use App\Model\ModelTemplate;

class RepositoryTemplate
{
    /**
     * @return DtoTemplate[]
     */
    public function getAll(DtoFilter $dtoFilter): array
    {
        $query = ModelTemplate::query();

        if ($dtoFilter->category !== '') {
            $query->whereJsonContains('categories', $dtoFilter->category);
        }

        $response = $query->get();

        foreach ($response as $row) {
            $result[] = new DtoTemplate(
                $row->id,
                null,
                json_decode($row->categories),
                $row->code,
                $row->icon,
                $row->prompt,
                $row->ru_name,
                $row->en_name,
                $row->parent_code,
                $row->sort,
                $row->date_created,
                true,
            );
        }
        return $result ?? [];
    }

    public function getById(int $templateId): DtoTemplate
    {
        $result = ModelTemplate::where('id', $templateId)->first();

        return new DtoTemplate(
            $result->id,
            null,
            json_decode($result->categories),
            $result->code,
            $result->icon,
            $result->prompt,
            $result->ru_name,
            $result->en_name,
            $result->parent_code,
            $result->sort,
            null,
            true,
        );
    }
}
<?php

namespace App\Repository\Storage;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;
use App\Model\ModelTemplate;

class RepositoryTemplate
{
    /**
     * @return DtoPrompt[]
     */
    public function getAll(DtoFilter $dtoFilter): array
    {
        $query = ModelTemplate::query();

        if ($dtoFilter->category !== '') {
            $query->whereJsonContains('categories', $dtoFilter->category);
        }

        $response = $query->get();

        foreach ($response as $row) {
            $result[] = new DtoPrompt(
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
}
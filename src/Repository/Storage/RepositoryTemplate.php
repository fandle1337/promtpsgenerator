<?php

namespace App\Repository\Storage;

use App\Dto\DtoFilter;
use App\Dto\DtoTemplate;
use App\Model\ModelTemplate;

class RepositoryTemplate
{
    /**
     * @param DtoFilter $dtoFilter
     * @return array
     */
    public function getAll(DtoFilter $dtoFilter): array
    {
        $query = ModelTemplate::query();

        if (!empty($dtoFilter->category)) {
            $query->whereHas('categories', function ($query) use ($dtoFilter) {
                $query->where('template_categories.code', $dtoFilter->category);
            });
        }

        foreach ($query->get() as $template) {

            $categories = $template->categories->pluck('code')->toArray();

            $result[] = new DtoTemplate(
                $template->id,
                null,
                $categories,
                $template->code,
                $template->icon,
                $template->prompt,
                $template->ru_name,
                $template->en_name,
                $template->parent_code,
                $template->sort,
                $template->date_created,
                true,
                $template->section,
            );
        }

        return $result ?? [];
    }

    public function getById(int $templateId): DtoTemplate|bool
    {
        $result = ModelTemplate::where('id', $templateId)->first();

        if (!$result) {
            return false;
        }

        $categories = $result->categories()->pluck('template_categories.code')->toArray();

        return new DtoTemplate(
            $result->id,
            null,
            $categories,
            $result->code,
            $result->icon,
            $result->prompt,
            $result->ru_name,
            $result->en_name,
            $result->parent_code,
            $result->sort,
            null,
            true,
            $result->section,
        );
    }
}
<?php

namespace App\Repository\Storage;

use App\Dto\DtoFilter;
use App\Dto\DtoPrompt;
use App\Model\ModelPrompt;

class RepositoryPrompt
{
    public function getAllByPortalId(DtoFilter $dtoFilter, int $portalId): array
    {
        $query = ModelPrompt::where('portal_id', $portalId);

        if (!empty($dtoFilter->category)) {
            $query->whereHas('categories', function ($query) use ($dtoFilter) {
                $query->where('prompt_categories.code', $dtoFilter->category);
            });
        }

        foreach ($query->get() as $prompt) {

            $categories = $prompt->categories->pluck('code')->toArray();

            $result[] = new DtoPrompt(
                $prompt->id,
                $prompt->portal_id,
                $categories,
                $prompt->code,
                $prompt->icon,
                $prompt->prompt,
                $prompt->ru_name,
                $prompt->en_name,
                $prompt->parent_code,
                $prompt->sort,
                $prompt->date_created,
                null,
                $prompt->section,
            );
        }

        return $result ?? [];
    }

    public function add(DtoPrompt $dtoPrompt): bool
    {
        $prompt = ModelPrompt::create([
            'portal_id'    => $dtoPrompt->portalId,
            'ru_name'      => $dtoPrompt->ruName,
            'en_name'      => $dtoPrompt->enName,
            'code'         => $dtoPrompt->code,
            'icon'         => $dtoPrompt->icon,
            'prompt'       => $dtoPrompt->prompt,
            'parent_code'  => $dtoPrompt->parentCode,
            'sort'         => $dtoPrompt->sort,
            'date_created' => $dtoPrompt->dateCreated ?? date('Y-m-d H:i:s'),
            'section'      => $dtoPrompt->section,
        ]);

        $prompt->categories()->attach($dtoPrompt->categories);

        return (bool)$prompt->id;
    }

    public function deleteById(int $promptId, int $portalId): bool
    {
        return (bool)ModelPrompt::where('portal_id', $portalId)->where('id', $promptId)->delete();
    }

    public function isHasByPortalId(int $portalId, string $code): bool
    {
        $result = ModelPrompt::where('portal_id', $portalId)
            ->where('code', $code)
            ->count();

        return $result !== 0;
    }

    public function getCodeById(int $promptId): string|bool
    {
        $result = ModelPrompt::where('id', $promptId)->first();

        if (!$result) {
            return false;
        }

        return $result->code;
    }

    public function deleteAllByPortalId(int $portalId): bool
    {
        return (bool)ModelPrompt::where('portal_id', $portalId)->delete();
    }
}
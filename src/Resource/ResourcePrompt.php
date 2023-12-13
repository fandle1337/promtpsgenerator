<?php

namespace App\Resource;

use App\Dto\DtoPrompt;

class ResourcePrompt
{
    /**
     * @param DtoPrompt[] $dtoPromptList
     * @return array
     */
    public static function toArray(array $dtoPromptList): array
    {
        foreach ($dtoPromptList as $dto) {
            $item = [
                'id' => $dto->id,
                'categories' => $dto->categories,
                'code' => $dto->code,
                'prompt' => $dto->prompt,
                'translate' => [
                    'ru' => $dto->ruName,
                    'en' => $dto->enName,
                ],
                'parentCode' => $dto->parentCode,
                'sort' => $dto->sort,
                'icon' => $dto->icon,
                'dateCreated' => $dto->dateCreated,
            ];
            if ($dto->isTemplate) {
                $item['isTemplate'] = true;
            }

            $result[] = $item;
        }

        return $result ?? [];
    }

    public static function formatForParameters(DtoPrompt $dtoPrompt): array
    {
        $parameters = [
            'category' => $dtoPrompt->categories,
            'code' => $dtoPrompt->code,
            'icon' => $dtoPrompt->icon,
            'prompt' => $dtoPrompt->prompt,
            'translate' => [
                'ru' => $dtoPrompt->ruName,
                'en' => $dtoPrompt->enName,
            ]
        ];

        if ($dtoPrompt->parentCode) {
            $parameters['parent_code'] = $dtoPrompt;
        }

        if ($dtoPrompt->sort) {
            $parameters['sort'] = $dtoPrompt;
        }

        return $parameters;
    }
}
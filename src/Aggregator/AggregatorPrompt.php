<?php

namespace App\Aggregator;

use App\Dto\DtoPrompt;

class AggregatorPrompt
{
    public function make(
        ?int    $portalId,
        ?array  $categories,
        ?string $code,
        ?string $icon,
        ?string $prompt,
        ?string $ruName,
        ?string $enName,
        ?string $parentCode,
        ?int    $sort,
        ?string $dateCreated,
    ): DtoPrompt
    {
        return new DtoPrompt(
            null,
            $portalId,
            $categories,
            $code,
            $icon,
            $prompt,
            $ruName,
            $enName,
            $parentCode,
            $sort,
            $dateCreated,
        );
    }
}
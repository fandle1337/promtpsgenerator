<?php

namespace App\Aggregator;

use App\Dto\DtoFilter;

class AggregatorFilter
{
    public function make(
        bool   $showTemplates,
        string $category,
    ): DtoFilter
    {
        return new DtoFilter(
            $showTemplates,
            $category
        );
    }
}
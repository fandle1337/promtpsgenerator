<?php

namespace App\Dto;

class DtoFilter
{
    public function __construct(
        public ?bool   $showTemplates = null,
        public ?string $category = null,
    )
    {
    }
}
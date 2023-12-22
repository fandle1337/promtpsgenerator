<?php

namespace App\Dto;

class DtoPrompt
{
    public function __construct(
        public ?int    $id = null,
        public ?int    $portalId = null,
        public ?array  $categories = null,
        public ?string $code = null,
        public ?string $icon = null,
        public ?string $prompt = null,
        public ?string $ruName = null,
        public ?string $enName = null,
        public ?string $parentCode = null,
        public ?int    $sort = null,
        public ?string $dateCreated = null,
        public ?bool   $isTemplate = null,
        public ?string $section = null,
    )
    {
    }
}
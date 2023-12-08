<?php

namespace App\Dto;

class DtoPrompt extends DtoAbstract
{
    public function __construct(
        public ?int    $id = null,
        public ?int    $portalId = null,
        public ?string $name = null,
        public ?array  $category = null,
        public ?string $code = null,
        public ?string $prompt = null,
        public ?array  $translate = null,
        public ?string $parentCode = null,
        public ?int    $sort = null,
        public ?string $dateCreated = null,
    )
    {
        parent::__construct();
    }
}
<?php

namespace App\Dto;

class DtoAppSettings extends DtoAbstract
{
    public function __construct(
        public ?string $domain = null,
        public ?string $moduleCode = null,
        public ?int    $userId = null,
        public ?bool   $isAdmin = null,
//        public ?bool   $isAvailable = null,
    )
    {
        parent::__construct();
    }
}
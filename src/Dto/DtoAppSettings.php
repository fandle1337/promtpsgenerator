<?php

namespace App\Dto;

class DtoAppSettings extends DtoAbstract
{
    public function __construct(
        public ?string $domain = null,
        public ?string $moduleCode = null,
        public ?int    $userId = null,
        public ?string   $userPermission = null,
    )
    {
        parent::__construct();
    }
}
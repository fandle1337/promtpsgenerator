<?php

namespace App\Dto;

class DtoPortal extends DtoAbstract
{
    public function __construct(
        public ?int    $id = null,
        public ?string $domain = null,
        public ?string $lang = null,
        public ?string $license = null,
        public ?string $memberId = null,
        public ?string $accessToken = null,
        public ?string $refreshToken = null,
        public ?string $dateInstall = null,
        public ?string $dateUninstall = null,
    )
    {
        parent::__construct();
    }
}
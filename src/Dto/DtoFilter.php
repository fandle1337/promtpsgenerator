<?php

namespace App\Dto;

class DtoFilter extends DtoAbstract
{
    public function __construct(
        public ?bool   $showTemplates = null,
        public ?string $category = null,
    )
    {
        parent::__construct();
    }
}
<?php

namespace App\Repository\Rest;

use App\Dto\DtoPrompt;
use App\Resource\ResourcePrompt;

class RepositoryPrompt extends RepositoryRestAbstract
{
    public function register(DtoPrompt $dtoPrompt): bool
    {
        return isset($this->client->call(
            'ai.prompt.register',
            ResourcePrompt::formatForParameters($dtoPrompt),
        )['result']);
    }

    public function unregister(string $code): bool
    {
        return $this->client->call(
            'ai.prompt.unregister',
            ['code' => $code]
        )['result'];
    }
}
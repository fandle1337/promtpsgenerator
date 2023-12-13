<?php

namespace App\Repository\Rest;

use App\Dto\DtoFilter;

class RepositoryFilter extends RepositoryRestAbstract
{
    public function get(): DtoFilter
    {
        $result = $this->client->call(
            'user.option.get'
        )['result'];

        return new DtoFilter(
            $result['showTemplates'] ?? null,
            $result['category'] ?? null
        );
    }

    public function set(DtoFilter $dtoFilter): bool
    {
        $response = $this->client->call(
            'user.option.set',
            [
                'showTemplates' => $dtoFilter->showTemplates,
                'category' => $dtoFilter->category,
            ]
        );
        return $response['result'];
    }
}
<?php

namespace App\Repository;

use App\Interfaces\InterfaceRepository;
use Bitrix24\Bitrix24;


class RepositoryRestAbstract implements InterfaceRepository
{
    protected Bitrix24 $client;

    public function __construct()
    {
        $this->client = (new \Sw24\Bitrix24Auth\Bitrix24Client())->getClient();
    }

    protected static function revealResponse($restResponse): array
    {
        return $restResponse['result'] ?? [];
    }

    public static function revealOnceResponse($restResponse): array
    {
        return $restResponse['result'] ? $restResponse['result'][0] : [];
    }


}
<?php

namespace App\Repository\Rest;

use App\Dto\DtoPrompt;
use App\Exception\ExceptionPrompt;
use App\Resource\ResourcePrompt;
use Bitrix24\Exceptions\Bitrix24ApiException;
use Bitrix24\Exceptions\Bitrix24EmptyResponseException;
use Bitrix24\Exceptions\Bitrix24Exception;
use Bitrix24\Exceptions\Bitrix24IoException;
use Bitrix24\Exceptions\Bitrix24MethodNotFoundException;
use Bitrix24\Exceptions\Bitrix24PaymentRequiredException;
use Bitrix24\Exceptions\Bitrix24PortalDeletedException;
use Bitrix24\Exceptions\Bitrix24PortalRenamedException;
use Bitrix24\Exceptions\Bitrix24SecurityException;
use Bitrix24\Exceptions\Bitrix24TokenIsExpiredException;
use Bitrix24\Exceptions\Bitrix24TokenIsInvalidException;
use Bitrix24\Exceptions\Bitrix24WrongClientException;

class RepositoryPrompt extends RepositoryRestAbstract
{
    /**
     * @param DtoPrompt $dtoPrompt
     * @return bool
     */
    public function register(DtoPrompt $dtoPrompt): bool
    {
        try {
            $response = $this->client->call(
                'ai.prompt.register',
                ResourcePrompt::formatForParameters($dtoPrompt),
            );
        } catch (Bitrix24Exception $e) {
            return false;
        }

        if (!empty($response['result'])) {
            return true;
        }

        return false;
    }

    public function unregister(string $code): bool
    {
        return $this->client->call(
            'ai.prompt.unregister',
            ['code' => $code]
        )['result'];
    }
}
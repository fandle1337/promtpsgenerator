<?php

namespace App\Repository\Rest;

class RepositoryAppInfo extends RepositoryRestAbstract
{
    public function getLicence(): string
    {
        $response = $this->client->call('app.info');
        return $response['LICENSE_FAMILY'] ?? str_replace($response['LANGUAGE_ID'] . '_', '', $response['LICENSE']);
    }

    public function getLanguage(): string
    {
        return $this->client->call('app.info')['LANGUAGE_ID'];
    }

}
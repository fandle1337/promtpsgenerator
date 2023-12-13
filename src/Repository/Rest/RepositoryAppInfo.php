<?php

namespace App\Repository\Rest;

class RepositoryAppInfo extends RepositoryRestAbstract
{
    private static array $appInfo = [];

    public function getInfo(): array
    {
        if (empty(static::$appInfo)) {
            $res = $this->client->call('app.info');
            static::$appInfo = $res['result'];
        }
        return static::$appInfo;
    }

    public function getAppId(): mixed
    {
        $infoCompany = $this->getInfo();
        return $infoCompany['ID'];
    }

    public function getLicence(): mixed
    {
        $infoCompany = $this->getInfo();
        return $infoCompany['LICENSE_FAMILY'] ?? str_replace($infoCompany['LANGUAGE_ID'] . '_', '', $infoCompany['LICENSE']);
    }

    public function getLanguage(): mixed
    {
        $infoCompany = $this->getInfo();
        return $infoCompany['LANGUAGE_ID'];
    }

}
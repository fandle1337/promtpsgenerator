<?php

namespace App\Controller;

use App\Dto\DtoPortal;
use App\Repository\Rest\RepositoryAppInfo;
use App\Response\Response;
use App\Service\ServicePortal;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ServerRequestInterface;
use Sw24\Sw24RestSdk\Client;
use Sw24\Sw24RestSdk\Exception\ExceptionNotValidateResponse;
use Sw24\Sw24RestSdk\Exception\ExceptionRequestFailed;

class ControllerInstall extends ControllerAbstract
{
    public function __construct(
        protected RepositoryAppInfo $repositoryAppInfo,
        protected Client            $client,
        protected ServicePortal     $servicePortal,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        $b24client = (new \Sw24\Bitrix24Auth\Bitrix24Client())->getClient();

        try {
            $this->client->callInstallApplication(
                $b24client->getDomain(),
                $_ENV['MODULE_CODE'],
                $b24client->getMemberId(),
                $b24client->getAccessToken(),
                $b24client->getRefreshToken(),
            );
        } catch (ExceptionNotValidateResponse | GuzzleException | ExceptionRequestFailed $e) {
            return Response::toArray(false);
        }

        $dtoPortal = new DtoPortal(
            null,
            $b24client->getDomain(),
            $this->repositoryAppInfo->getLanguage(),
            $this->repositoryAppInfo->getLicence(),
            $b24client->getMemberId(),
            $b24client->getAccessToken(),
            $b24client->getRefreshToken(),
            date("Y-m-d H:i:s"),
            null
        );

        $this->servicePortal->register($dtoPortal);

        $b24client->call('event.unbind', [
            'EVENT' => 'OnAppUpdate',
            'HANDLER' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . DIR_API . '/update/',
        ]);
        $b24client->call('event.bind', [
            'EVENT' => 'OnAppUpdate',
            'HANDLER' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . DIR_API . '/update/',
        ]);

        $b24client->call('event.unbind', [
            'EVENT' => 'OnAppUninstall',
            'HANDLER' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . DIR_API . '/uninstall/',
        ]);
        $b24client->call('event.bind', [
            'EVENT' => 'OnAppUninstall',
            'HANDLER' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . DIR_API . '/uninstall/',
        ]);

        return Response::toArray(true);
    }
}
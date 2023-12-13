<?php

namespace App\Controller;

use App\Repository\Storage\RepositoryPortal;
use App\Response\Response;
use Psr\Http\Message\ServerRequestInterface;

class ControllerUninstall extends ControllerAbstract
{
    public function __construct(
        protected RepositoryPortal $repositoryPortal,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {
        $b24client = (new \Sw24\Bitrix24Auth\Bitrix24Client())->getClientUnInstall();

        $portal = $this->repositoryPortal->getByDomain($b24client->getDomain());
        $this->repositoryPortal->uninstallByDomain($portal->domain);

        return Response::toArray('Uninstall is successfully don!');

    }
}
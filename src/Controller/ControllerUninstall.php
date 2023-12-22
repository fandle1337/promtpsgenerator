<?php

namespace App\Controller;

use App\Repository\Storage\RepositoryPortal;
use App\Repository\Storage\RepositoryPrompt;
use App\Response\Response;
use Psr\Http\Message\ServerRequestInterface;

class ControllerUninstall extends ControllerAbstract
{
    public function __construct(
        protected RepositoryPortal $repositoryPortal,
        protected RepositoryPrompt $repositoryPrompt,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        $b24client = (new \Sw24\Bitrix24Auth\Bitrix24Client())->getClientUnInstall();

        $dtoPortal = $this->repositoryPortal->getByDomain($b24client->getDomain());
        $this->repositoryPortal->uninstallByDomain($dtoPortal->domain);
        $this->repositoryPrompt->deleteAllByPortalId($dtoPortal->id);
        
        return Response::toArray(true);
    }
}
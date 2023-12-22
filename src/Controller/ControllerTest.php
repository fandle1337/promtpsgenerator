<?php

namespace App\Controller;

use App\Dto\DtoFilter;
use App\Repository\Rest\RepositoryFilter;
use App\Repository\Storage\RepositoryTemplate;
use App\Resource\ResourcePrompt;
use App\Response\Response;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerTest extends ControllerAbstract
{
    public function __construct(
        protected RepositoryTemplate $repositoryTemplate,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        var_dump($this->repositoryTemplate->getById(1));
        exit();

        return Response::toArray(
           '123'
        );
    }
}
<?php

namespace App\Controller;

use App\Repository\Rest\RepositoryFilter;
use App\Resource\ResourceFilter;
use App\Response\Response;

class ControllerFilterGet extends ControllerAbstract
{
    public function __construct(
        protected RepositoryFilter $repositoryFilter,
    )
    {
    }

    public function __invoke(): \Laminas\Diactoros\Response
    {
        return Response::toArray(
            ResourceFilter::toArray(
                $this->repositoryFilter->get()
            )
        );
    }
}
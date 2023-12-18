<?php

namespace App\Controller;

use App\Resource\ResourceFilter;
use App\Response\Response;
use App\Service\ServiceFilter;

class ControllerFilterGet extends ControllerAbstract
{
    public function __construct(
        protected ServiceFilter $serviceFilter,
    )
    {
    }

    public function __invoke(): \Laminas\Diactoros\Response
    {
        return Response::toArray(
            ResourceFilter::toArray(
                $this->serviceFilter->get()
            )
        );
    }
}
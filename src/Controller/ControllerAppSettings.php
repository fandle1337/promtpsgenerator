<?php

namespace App\Controller;


use App\Aggregator\AggregatorAppSettings;
use App\Resource\ResourceAppSettings;
use App\Response\Response;
use Psr\Http\Message\ServerRequestInterface;

class ControllerAppSettings extends ControllerAbstract
{
    public function __construct(
        protected AggregatorAppSettings $aggregatorAppSettings,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        return Response::toArray(
            ResourceAppSettings::toArray(
                $this->aggregatorAppSettings->make()
            )
        );
    }
}
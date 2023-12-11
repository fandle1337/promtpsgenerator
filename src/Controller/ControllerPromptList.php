<?php

namespace App\Controller;

use App\Aggregator\AggregatorFilter;
use App\Resource\ResourcePrompt;
use App\Response\Response;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerPromptList extends ControllerAbstract
{
    public function __construct(
        protected ServicePrompt    $servicePrompt,
        protected AggregatorFilter $aggregatorFilter,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {
        $dtoFilter = $this->aggregatorFilter->make(
            $this->getRequestValue($request, 'showTemplates'),
            $this->getRequestValue($request, 'category'),
        );

        return Response::toArray(
            ResourcePrompt::toArray(
                $this->servicePrompt->list($dtoFilter)
            )
        );
    }
}
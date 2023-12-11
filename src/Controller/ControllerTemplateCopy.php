<?php

namespace App\Controller;

use App\Aggregator\AggregatorPrompt;
use App\Enum\EnumResponseStatus;
use App\Response\Response;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerTemplateCopy extends ControllerAbstract
{
    public function __construct(
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {

    }
}
<?php

namespace App\Controller;

use App\Aggregator\AggregatorPrompt;
use App\Enum\EnumResponseStatus;
use App\Response\Response;
use App\Service\ServicePrompt;
use App\Service\ServiceTemplate;
use Psr\Http\Message\ServerRequestInterface;

class ControllerTemplateCopy extends ControllerAbstract
{
    public function __construct(
        protected ServiceTemplate $serviceTemplate,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {
        $templateId = $this->getRequestValue($request, 'id');

        if (!$this->serviceTemplate->copy($templateId)) {
            return Response::toArray(
                'this template is already installed',
                EnumResponseStatus::STATUS_ERROR,
                500,
            );
        }
        return Response::toArray('template is successfully installed');

    }
}
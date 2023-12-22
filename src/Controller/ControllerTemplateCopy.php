<?php

namespace App\Controller;

use App\Enum\EnumResponseStatus;
use App\Response\Response;
use App\Service\ServiceTemplate;
use Psr\Http\Message\ServerRequestInterface;

class ControllerTemplateCopy extends ControllerAbstract
{
    public function __construct(
        protected ServiceTemplate $serviceTemplate,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        $templateId = $this->getRequestValue($request, 'id');

        if (!$this->serviceTemplate->copy($templateId)) {
            return Response::toArray(
                false,
                400,
                EnumResponseStatus::STATUS_ERROR,
            );
        }
        return Response::toArray(true);

    }
}
<?php

namespace App\Controller;

use App\Enum\EnumResponseStatus;
use App\Response\Response;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerPromptDelete extends ControllerAbstract
{
    public function __construct(
        protected ServicePrompt    $servicePrompt,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        $promptId = $this->getRequestValue($request, 'id');

        if ($this->servicePrompt->delete($promptId)) {
            return Response::toArray(true);
        }
        return Response::toArray(
            false,
            400,
            EnumResponseStatus::STATUS_ERROR,
        );
    }

}
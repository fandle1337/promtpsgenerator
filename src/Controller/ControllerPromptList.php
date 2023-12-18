<?php

namespace App\Controller;

use App\Dto\DtoFilter;
use App\Resource\ResourcePrompt;
use App\Response\Response;
use App\Service\ServiceFilter;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerPromptList extends ControllerAbstract
{
    public function __construct(
        protected ServicePrompt    $servicePrompt,
        protected ServiceFilter    $serviceFilter,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        $dtoFilter = new DtoFilter(
            $this->getRequestValue($request, 'showTemplates'),
            $this->getRequestValue($request, 'category'),
        );

        $promptList = $this->servicePrompt->list($dtoFilter);
        $this->serviceFilter->set($dtoFilter);

        return Response::toArray(
            ResourcePrompt::toArray(
                $promptList
            )
        );
    }
}
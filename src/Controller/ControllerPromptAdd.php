<?php

namespace App\Controller;

use App\Aggregator\AggregatorPrompt;
use App\Enum\EnumResponseStatus;
use App\Response\Response;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerPromptAdd extends ControllerAbstract
{
    public function __construct(
        protected AggregatorPrompt $aggregatorPrompt,
        protected ServicePrompt    $servicePrompt,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {
        $dtoPrompt = $this->aggregatorPrompt->make(
            null,
            $this->getRequestValue($request, 'categories'),
            $this->servicePrompt->setCodeForPrompt(),
            $this->getRequestValue($request, 'icon'),
            $this->getRequestValue($request, 'prompt'),
            $this->getRequestValue($request, 'ru_name'),
            $this->getRequestValue($request, 'en_name'),
            $this->getRequestValue($request, 'parent_code') ?? null,
            $this->getRequestValue($request, 'sort') ?? 500,
            date('Y-m-d H:i:s'),
        );

        if ($this->servicePrompt->add($dtoPrompt)) {
            return Response::toArray('prompt is successfully added');
        }
        return Response::toArray(
            'Промпт с таким кодом уже зарегистрирован на портале.',
            EnumResponseStatus::STATUS_ERROR,
            500
        );
    }

}
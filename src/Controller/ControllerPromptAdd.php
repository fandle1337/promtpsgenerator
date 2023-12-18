<?php

namespace App\Controller;

use App\Dto\DtoPrompt;
use App\Enum\EnumResponseStatus;
use App\Exception\ExceptionPrompt;
use App\Response\Response;
use App\Service\ServicePrompt;
use Psr\Http\Message\ServerRequestInterface;


class ControllerPromptAdd extends ControllerAbstract
{
    public function __construct(
        protected ServicePrompt    $servicePrompt,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): \Laminas\Diactoros\Response
    {
        $dtoPrompt = new DtoPrompt(
            categories: $this->getRequestValue($request, 'categories'),
            code: $this->servicePrompt->setCodeForPrompt(),
            icon: $this->getRequestValue($request, 'icon'),
            prompt: $this->getRequestValue($request, 'prompt'),
            ruName: $this->getRequestValue($request, 'ru_name'),
            enName: $this->getRequestValue($request, 'en_name'),
            parentCode: $this->getRequestValue($request, 'parent_code') ?? null,
            sort: $this->getRequestValue($request, 'sort') ?? 500,
            dateCreated: date('Y-m-d H:i:s'),
            section: $this->getRequestValue($request, 'section' ?? null),
        );


        try {
            $this->servicePrompt->add($dtoPrompt);
            return Response::toArray('prompt is successfully added');

        } catch (ExceptionPrompt $e) {
            return Response::toArray(
                $e->getMessage(),
                400,
                EnumResponseStatus::STATUS_ERROR
            );
        }
    }

}
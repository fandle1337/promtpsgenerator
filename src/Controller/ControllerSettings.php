<?php

namespace App\Controller;


use Psr\Http\Message\ServerRequestInterface;

class ControllerSettings extends ControllerAbstract
{
    public function __invoke(ServerRequestInterface $request): array
    {
        return [];
    }
}
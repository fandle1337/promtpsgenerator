<?php
namespace App\Controller;


use Psr\Http\Message\ServerRequestInterface;

class ControllerApp extends ControllerAbstract
{
    public function install(ServerRequestInterface $request): array
    {
        return [];
    }
}
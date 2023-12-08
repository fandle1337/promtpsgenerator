<?php

namespace App\Controller;

use App\Repository\Storage\RepositoryPrompt;
use Psr\Http\Message\ServerRequestInterface;

class ControllerPrompt extends ControllerAbstract
{
    public function __construct(
        protected RepositoryPrompt $repositoryPrompt,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {
        return [
            [
                "code"       => 'rest_birthday',
                "translate"  => [
                    'ru' => 'Поздравление',
                    'en' => 'greetings'
                ],
                "prompt"     => 'Поздравь с днем рождения официально',
                "categories" => ['tasks', 'chat'],
                "icon"       => 'fire',
                "parentCode" => null,
                "sort"       => 100,
                "isTemplate" => false,
            ],
        ];
    }
}
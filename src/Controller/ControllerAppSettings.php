<?php

namespace App\Controller;


use App\Aggregator\AggregatorAppSettings;
use App\Resource\ResourceAppSettings;
use Psr\Http\Message\ServerRequestInterface;

class ControllerAppSettings extends ControllerAbstract
{
    public function __construct(
        protected AggregatorAppSettings $aggregatorAppSettings,
    )
    {
    }

    public function __invoke(ServerRequestInterface $request): array
    {
        var_dump(123);
        exit();
        var_dump(json_encode(
            [
                'livefeed',
                'livefeed_comments',
                'tasks',
                'tasks_comments',
                'chat',
                'mail',
                'mail_crm',
                'landing',
            ]
        ));
        exit();
        return ResourceAppSettings::toArray($this->aggregatorAppSettings->make());
    }
}
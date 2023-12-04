<?php

declare(strict_types=1);

namespace App\Provider;

use App\Middleware\MiddlewareUserAdmin;
use App\Service\ServiceUserPermissions;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * The provides method is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     */
    public function provides(string $id): bool
    {
        $services = [
//            GptClient::class
        ];

        return in_array($id, $services);
    }

    /**
     * The register method is where you define services
     * in the same way you would directly with the container.
     * A convenience getter for the container is provided, you
     * can invoke any of the methods you would when defining
     * services directly, but remember, any alias added to the
     * container here, when passed to the `provides` nethod
     * must return true, or it will be ignored by the container.
     */
    public function register(): void
    {
//        $repositoryAppOption = $this->getContainer()->get(RepositoryAppOption::class);
//
//        if($repositoryAppOption->findByOption(EnumAppOption::SERVICE_TOKEN_MODE)) {
//            if($token = $repositoryAppOption->findByOption(EnumAppOption::SERVICE_USER_TOKEN)) {
//                $this->getContainer()->add(GptClient::class, new GptClient(
//                    $token
//                ));
//
//                return;
//            }
//        }
//
//        $this->getContainer()->add(GptClient::class, new GptClient(
//            "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"
//        ));
    }

    public function boot(): void
    {
    }
}
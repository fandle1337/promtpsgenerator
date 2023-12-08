<?php
declare(strict_types=1);

use App\Controller\ControllerInstall;
use App\Controller\ControllerPrompt;
use App\Controller\ControllerSettings;
use App\Controller\ControllerUninstall;
use App\RouterFacade;

require_once dirname(__DIR__) . "/config/bootstrap.php";

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = RouterFacade::getInstance()->getRouter();

// map a route
$router->map('GET', DIR_API . '/app/settings/', ControllerSettings::class);
$router->map('POST', DIR_API . '/app/prompt/list/', ControllerPrompt::class);

$router->map('GET', DIR_API . '/install/', ControllerInstall::class);
$router->map('GET', DIR_API . '/uninstall/', ControllerUninstall::class);


$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
?>
<?php
declare(strict_types=1);

use App\Controller\ControllerPromptAdd;
use App\Controller\ControllerInstall;
use App\Controller\ControllerPromptDelete;
use App\Controller\ControllerPromptList;
use App\Controller\ControllerAppSettings;
use App\Controller\ControllerTemplateCopy;
use App\Controller\ControllerUninstall;
use App\RouterFacade;

require_once dirname(__DIR__) . "/config/bootstrap.php";

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = RouterFacade::getInstance()->getRouter();

// map a route
$router->map('GET', DIR_API . '/app/settings/', ControllerAppSettings::class);
$router->map('POST', DIR_API . '/app/prompt/list/', ControllerPromptList::class);
$router->map('POST', DIR_API . '/app/prompt/add/', ControllerPromptAdd::class);
$router->map('POST', DIR_API . '/app/prompt/delete/', ControllerPromptDelete::class);
$router->map('POST', DIR_API . '/app/prompt/copy/', ControllerTemplateCopy::class);

$router->map('GET', DIR_API . '/install/', ControllerInstall::class);
$router->map('GET', DIR_API . '/uninstall/', ControllerUninstall::class);


$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
?>
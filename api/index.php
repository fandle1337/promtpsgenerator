<?php
declare(strict_types=1);

use App\RouterFacade;
use App\Controller\ControllerApp;

require_once dirname(__DIR__) . "/config/bootstrap.php";


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);


$router = RouterFacade::getInstance()->getRouter();

// map a route
$router->map('GET', DIR_API . '/install/', [ControllerApp::class, 'install']);



$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
?>
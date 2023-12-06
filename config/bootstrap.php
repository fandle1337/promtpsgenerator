<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . "/vendor/autoload.php";

define('DIR_BX24_APP', "/b24");
define('DIR_API', "/b24/api");
define('DIR_APP', "/b24/app");
define('AUTH_CLIENT_JSON', ".auth.json");


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

\Sw24\Cache\CacheFacade::setConfig([
    "pathDirSave" => $_SERVER['DOCUMENT_ROOT'] . DIR_BX24_APP
]);

/**
 * Здесь подмена реквеста
 */
if(file_exists(dirname(__DIR__) . "/config/config.php")) {
    $_REQUEST = require_once dirname(__DIR__) . "/config/config.php";
}
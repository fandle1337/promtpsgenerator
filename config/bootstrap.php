<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('DIR_BX24_APP', $_ENV['WORK_DIRECTORY']);
define("DIR_API", $_ENV['WORK_DIRECTORY'] . "/api");
define("DIR_APP", $_ENV['WORK_DIRECTORY'] . "/app");
define("AUTH_CLIENT_JSON", ".auth.json");

require_once "database.php";


/**
 * Здесь подмена реквеста
 */
if(file_exists(dirname(__DIR__) . "/config/config.php")) {
    $_REQUEST = require_once dirname(__DIR__) . "/config/config.php";
}
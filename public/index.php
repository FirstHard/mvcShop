<?php

// Including global settings
include_once(__DIR__ . '/../Framework/config.php');
include_once(__DIR__ . '/../Framework/db_config.php');
require_once ROOT . 'vendor/autoload.php';

use Framework\Core\Db;
use Framework\Core\Auth;
use Framework\Core\Route;
use Framework\Core\ExceptionsHandler;

// Registering custom error and exception handlers
(new ExceptionsHandler())->register();

$DB = new Db();

$route = (new Route())->start();
$auth = new Auth();
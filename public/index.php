<?php

// Including global settings
include(__DIR__ . '/../Framework/config.php');
require ROOT . 'vendor/autoload.php';

use Framework\Core\Auth;
use Framework\Core\Route;
use Framework\Core\ExceptionsHandler;

// Registering custom error and exception handlers
(new ExceptionsHandler())->register();

$route = (new Route())->start();
$auth = new Auth();
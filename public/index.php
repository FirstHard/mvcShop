<?php

// Including global settings
include(__DIR__ . '/../App/config.php');
require ROOT . 'vendor/autoload.php';

use App\Core\Auth;
use App\Core\Route;
use App\Core\ExceptionsHandler;

// Registering custom error and exception handlers
(new ExceptionsHandler())->register();

$route = (new Route())->start();
$auth = new Auth();
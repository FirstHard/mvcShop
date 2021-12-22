<?php

use Framework\Core\Db;
use Framework\Core\Auth;
use Framework\Core\Router;
use Framework\Core\ExceptionsHandler;
use Framework\Controller\NotFoundController;

include_once('db_config.php');

(new ExceptionsHandler())->register();

$DB = new Db();

/* $auth = new Auth(); */

$router = (new Router())::$instance;
$controller_path = '\\Framework\\Controller\\' . $router->controller . 'Controller';
try {
    $controller = new $controller_path;
    $controller->param = $router->param;
    $controller->queries = $router->queries;
    $controller->gets = $router->gets;
} catch (ExceptionsHandler $controller_error) {
    throw new ExceptionsHandler('Wrong controller! ' . $controller_error->getMessage(), 0);
}
$action = 'action' . $router->action;
try {
    $controller->$action();
} catch (ExceptionsHandler $method_error) {
    throw new ExceptionsHandler('Wrong controller! ' . $method_error->getMessage(), 0);
}

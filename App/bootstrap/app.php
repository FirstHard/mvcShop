<?php

use App\Core\Auth;
use App\Core\Router;
use App\Core\ExceptionsHandler;
use App\Model\Page;
use App\Controller\NotFoundController;

include_once('db_config.php');

(new ExceptionsHandler())->register();

$auth = new Auth();
$page = new Page();

$queries = file_get_contents("php://input");
$router = Router::start();
$router::$queries = $queries;
$controller_path = '\\App\\Controller\\' . $router::$controller . 'Controller';
if (class_exists($controller_path)) {
    $controller = new $controller_path;
    $controller->param = $router::$param;
    $controller->queries = $queries;
    $controller->gets = $router::$gets;
    $controller->auth = $auth;
    $controller->page = $page;
    $action = 'action' . $router::$action;
    if (method_exists($controller_path, $action)) {
        $controller->$action();
    } else {
        $controller = (new NotFoundController())->actionNotFound(404);
    }
} else {
    $controller = (new NotFoundController())->actionNotFound(404);
}

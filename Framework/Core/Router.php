<?php

namespace Framework\Core;

use Framework\Controller\NotFoundController;

class Router
{
    private $uri;
    public $controller;
    public $action;
    public $gets;
    public $queries;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function start()
    {
        $parsed_url = parse_url($this->uri);
        $routes = explode('/', $parsed_url['path']);
        $controller = $routes[1] ?? 'site';
        $this->controller = ucfirst($controller);
        $action = $routes[2] ?? 'Index';
        $this->action = ucfirst($action);
        parse_str($_SERVER['QUERY_STRING'], $this->gets);
        ob_start();
        readfile("php://input");
        parse_str(ob_get_contents(), $this->queries);
        ob_end_clean();
    }
}

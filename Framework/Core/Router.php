<?php

namespace Framework\Core;

class Router
{
    private static $uri;
    public $controller = 'Site';
    public $action = 'Index';
    public $gets;
    public $queries;
    public $param;
    public static $instance;

    public function __construct()
    {
        $this::$uri = $_SERVER['REQUEST_URI'];
        $this->start();
    }

    protected function start()
    {
        $parsed_url = parse_url(htmlspecialchars($this::$uri));
        $routes = explode('/', $parsed_url['path']);
        if (!empty($routes[1])) {
            $this->controller = ucfirst(htmlspecialchars($routes[1]));
        }
        if (!empty($routes[2])) {
            $this->action = ucfirst(htmlspecialchars($routes[2]));
        }
        if (!empty($routes[3])) {
            $this->param = ucfirst(htmlspecialchars($routes[3]));
        }
        parse_str(htmlspecialchars($_SERVER['QUERY_STRING']), $this->gets);
        ob_start();
        readfile("php://input");
        parse_str(htmlspecialchars(ob_get_contents()), $this->queries);
        ob_end_clean();
        self::$instance = $this;
    }
}

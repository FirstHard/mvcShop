<?php

namespace App\Core;

class Router
{
    private static $uri;
    public static $controller = 'Site';
    public static $action = 'Index';
    public static $gets;
    public static $queries;
    public static $param;
    public static $instance = null;

    protected function __construct()
    {
        self::$uri = $_SERVER['REQUEST_URI'];
        $parsed_url = parse_url(htmlspecialchars(self::$uri));
        $routes = explode('/', $parsed_url['path']);
        if (!empty($routes[1])) {
            if ($routes[1] === 'api') {
                include ROOT . 'public/api.php';
                die;
            }
            self::$controller = ucfirst(htmlspecialchars($routes[1]));
        }
        if (!empty($routes[2])) {
            self::$action = ucfirst(htmlspecialchars($routes[2]));
        }
        if (!empty($routes[3])) {
            self::$param = ucfirst(htmlspecialchars($routes[3]));
        }
        parse_str(htmlspecialchars($_SERVER['QUERY_STRING']), self::$gets);
        return self::$instance;
    }

    public static function start()
    {
        if (self::$instance !== null) {
            return self::$instance;
        }
        return new self();
    }
}

<?php

namespace Framework\Core;

use Framework\Controller\NotFoundController;

class Route
{
    public function start()
    {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);
        $query = null;
        $query_data = [];

        if (!empty($query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY))) {
            $query_data = QueryParser::buildData($query);
        }

        // controller and default action
        $controller_name = 'Site';
        $action = 'index';
        $param = false;
        $alias = false;
        $finded_alias = false;
        // splitting the query string by route
        $routes = explode('/', $parsed_url['path']);
        // get the name of the controller
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }
        // get the name of the action
        if (!empty($routes[2])) {
            $action = $routes[2];
        }
        // get parameters
        if (!empty($routes[3])) {
            $param = $routes[3];
        }
        $controller_name = ucfirst($controller_name) . 'Controller';
        $controller_class = "Framework\\Controller\\" . $controller_name;
        $action = 'action' . ucfirst($action);
        /* if ($controller_name == 'ShopController') {
            if ($action != 'actionIndex') {
                $alias = $routes[2];
                $action = 'actionCategory';
            }
        } */
        $requested_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['escaped_url'] = htmlspecialchars($requested_url, ENT_QUOTES, 'UTF-8');
        if (!class_exists($controller_class)) {
            // Controller not found!
            $data['message'] = 'Controller not found';
            $data['code'] = 404;
            $data['status'] = 'Not Found';
            $controller = new NotFoundController();
            $controller->actionNotFound($data);
            die();
        } else {
            $controller = new $controller_class();
            if (!method_exists($controller, $action)) {
                // Method not found!
                //if ($finded_alias !== $controller->findAlias($alias)) {
                    $data['message'] = 'Method not found';
                    $data['code'] = 404;
                    $data['status'] = 'Not Found';
                    $controller = new NotFoundController();
                    $controller->actionNotFound($data);
                    die();
                //}
                //$controller->actionAlias($finded_alias);
            }
            $controller->$action($param, $query_data);
        }
    }
}

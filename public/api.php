<?php

// Including global settings
include_once(__DIR__ . '/../App/bootstrap/config.php');
include_once(ROOT . 'App/bootstrap/db_config.php');
require_once ROOT . 'vendor/autoload.php';

$api_type = 'Index';
$api_action = 'Index';
$api_param = false;
$uri = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url(htmlspecialchars($uri));
$routes = explode('/', $parsed_url['path']);
if (!empty($routes[2])) {
    $api_type = ucfirst(htmlspecialchars($routes[2]));
}
if (!empty($routes[3])) {
    $api_param = htmlspecialchars($routes[3]);
}
$api_path = '\\App\\Core\\' . $api_type . 'Api';
if (class_exists($api_path)) {
    $api = new $api_path();
    $api->param = $api_param;
    echo $api->run();
}
<?php

$getPath = strpos($_SERVER["REQUEST_URI"],  "api");
//$getPath = str_replace("/", "", $getPath);

if ($getCategory) {
    include '/api.php';
    die;
}

// Including global settings
include_once(__DIR__ . '/../App/bootstrap/config.php');
require_once ROOT . 'vendor/autoload.php';

$app = require_once ROOT . '/App/bootstrap/app.php';

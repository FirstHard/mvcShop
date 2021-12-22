<?php

// Including global settings
include_once(__DIR__ . '/../Framework/bootstrap/config.php');
require_once ROOT . 'vendor/autoload.php';

$app = require_once ROOT . '/Framework/bootstrap/app.php';

echo '<pre>';
print_r($router);
echo '</pre>';

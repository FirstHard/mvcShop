<?php

// Including global settings
include(__DIR__ . '/../App/config.php');
require_once(ROOT . 'vendor/autoload.php');

use App\TestCLass;
use App\Core\ExceptionsHandler;

(new ExceptionsHandler())->register();

try {
    $testClass = new TestCLass();
    $testClass->print();
} catch (ExceptionsHandler $e) {
    throw new ExceptionsHandler($e->getMessage(), $e->getCode());
}

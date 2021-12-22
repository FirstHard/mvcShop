<?php
// General settings
define('ROOT', __DIR__ . '/../../');
error_reporting(E_ALL | E_STRICT);
define('HOME', $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']));
define('SHOW_ERRORS', 1);
define('SHOW_EXCEPTIONS', 1);
define('LOG_PATH', ROOT . 'logs/');
define('LOG_DATE', '[' . date("Y-m-d H:i:s 'e'") . ']');
ini_set('max_execution_time', 60);
ini_set('log_errors', 'On');
ini_set('error_log', LOG_PATH . 'errors.log');
ini_set('display_errors', SHOW_ERRORS);
date_default_timezone_set("Europe/Kiev");
session_set_cookie_params(1440, '/', '', true, true);
session_start();

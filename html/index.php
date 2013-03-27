<?php
include_once 'application/Application.php';

define('APP_ROOT', dirname(__FILE__));
define('WEB_ROOT', $_SERVER['PHP_SELF']);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');

set_include_path(APP_ROOT.'/../files/PEAR' . PATH_SEPARATOR . get_include_path());
include (APP_ROOT.'/application/autoload.php');

$registry = Registry::getInstance();

$app = new Application();
$app->run();
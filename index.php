<?php
error_reporting(E_ALL | E_WARNING);

require_once 'includes.php';

$login = new Login();

$app = new Application();
$app->main();

echo $app->display();
?>
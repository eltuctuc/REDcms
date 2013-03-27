<?php
error_reporting(E_ALL | E_WARNING);

require_once 'includes.php';

$login = new Login();

Login::checkLogin();
?>
<?php
include_once 'defines.php';

include_once 'fckeditor/fckeditor_php5.php';
include_once 'ckfinder/ckfinder.php';

include_once 'core/Login.php';
include_once 'core/Application.php';
include_once 'core/Configuration.php';
include_once 'core/Database.php';
include_once 'core/Request.php';
include_once 'core/Template.php';
include_once 'core/Editor.php';
include_once 'core/Page.php';
include_once 'core/Box.php';
include_once 'core/Menu.php';
include_once 'core/Date.php';

/*
function __autoload($class_name)
{
	$path = str_replace('_','/',$class_name);
	$path = strtolower($path);

	require_once('./core/'.$path.'.php');
}
*/

function code($msg, $code=HTML_CODE)
{
	$msg = print_r($msg, true);
	
	if($code == HTML_CODE)
	{
		$msg = htmlentities($msg);
	}
	
	echo '<div class="debug"><pre>'.$msg.'</pre></div>';
}
?>
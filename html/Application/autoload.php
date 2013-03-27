<?php

function __autoload($className)
{
	$pathArray = explode('_',$className);	
	$filename = implode('/',$pathArray).'.php';
	$files = array(
		'modul'			=> 'Modul/'.$filename,
		'application'	=> 'Application/'.$filename,
	);
	
	foreach($files as $file)
	{
		if(!file_exists($file))
		{
			continue;
		}
		require_once $file;
		return true;
	}
	die('File not exists: '.APP_ROOT.'/'.$file.' - classname: '.$className);
}
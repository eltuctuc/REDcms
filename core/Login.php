<?php

class Login
{
	private static $user = 'admin';
	private static $password = 'demo';
		
	function __construct()
	{
		session_start();
	}
	
	function __destruct()
	{
	
	}
	
	static function isLogged()
	{
		if(isset($_SESSION['REDcms']) && $_SESSION['REDcms']['user'] == self::$user)
		{
			return true;
		}
		return false;
	}
	
	static function getAdminBox()
	{
		$content = '<h4>Administration</h4>';
		
		$tpl = new Template(TEMPLATEPATH);
		
		if(empty($_SESSION['REDcms']))
		{
			$tpl->load('login.tpl.html');
			$tpl->set('##URL##',		BASEURL.'/login.php');
		}
		else
		{
			$tpl->load('logout.tpl.html');
			$tpl->set('##URL##',		BASEURL.'/logout.php');
			$tpl->set('##URLPAGE##',	BASEURL.'/page/0/add');
			$tpl->set('##URLBOX##',		BASEURL.'/box/0/add');
			$tpl->set('##URLMENU##',	BASEURL.'/menu/0/add');
			$tpl->set('##USERNAME##',	$_SESSION['REDcms']['user']);
		}
		
		if(isset($_SERVER['REDIRECT_URI']))
		{
			$tpl->set('##REQUEST##',	$_SERVER['REDIRECT_URL']);
		}
		else
		{
			$tpl->set('##REQUEST##',	BASEURL);
		}
		$content .= $tpl->get();
		
		return $content;
	}
	
	static function checkLogin()
	{
		if($_POST['user'] == self::$user && $_POST['password'] == self::$password)
		{
			$_SESSION['REDcms'] = array();
			$_SESSION['REDcms']['user'] = $_POST['user'];
			$_SESSION['REDcms']['access'] = 0;
		}
		
		header('Location: '.$_POST['request']);
		exit();
	}
	
	static function logout()
	{
		$_SESSION['REDcms'] = array();
		unset($_SESSION['REDcms']);
		
		header('Location: '.$_POST['request']);
		exit();
	}
}

?>
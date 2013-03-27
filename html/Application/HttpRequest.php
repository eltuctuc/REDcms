<?php
include_once 'Interfaces/Request.php';

class HttpRequest implements Request
{
	private $parameters = array();
	
	public function __construct()
	{
		$this->parameters['url'] = '';
		$this->parameters = array_merge($this->parameters, $_REQUEST);
	}
	
	public function getParameterNames()
	{
		return array_keys($this->parameters);
	}
	
	public function issetParameter($name)
	{
		return isset($this->parameters[$name]);
	}
	
	public function getParameter($name)
	{
		if(isset($this->parameters[$name]))
		{
			return $this->parameters[$name];
		}
		return null;
	}
	
	public function getHeader($name)
	{
		$name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
		if(isset($_SERVER[$name]))
		{
			return $_SERVER[$name];
		}
		return null;
	}
	
	public function getAuthData()
	{
		if(!isset($_SERVER['PHP_AUTH_USER']))
		{
			return null;
		}
		
		return array(
					'user'		=> $_SERVER['PHP_AUTH_USER'],
					'password'	=> $_SERVER['PHP_AUTH_PW']
				);
	}
	
	public function getRemoteAddress()
	{
		return $_SERVER['REMOTE_ADDR'];
	}

	public function setParameter($name, $value='')
	{
		$this->parameters[$name] = $value;
	}
}
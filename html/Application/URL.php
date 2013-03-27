<?php
class URL
{
	private $data = array();
	
	public function __construct($url, $keys=array('lang','controll','action','id'))
	{
		$url =  explode('/',$url,count($keys));
		foreach($keys as $key)
		{
			$this->data[$key] = current($url);
			next($url);
		}
		return $this->data;
	}
	
	public function __get($key)
	{
		if(isset($this->data[$key]))
		{
			return $this->data[$key];
		}
		return null;
	}
}
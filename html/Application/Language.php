<?php
include_once 'Config.php';

class Language
{
	/**
	 * @var Config_Container
	 */
	private $data;
	
	public function __construct($lang)
	{
		$filename = APP_ROOT.'/Application/language/'.$lang.'.php';
		
		if(!file_exists($filename))
		{
			$filename = APP_ROOT.'/Application/language/en.php';
		}
		$config = new Config();
		$this->data = $config->parseConfig($filename,'phparray');
		if (PEAR::isError($root)) {
			die('Error while reading configuration: ' . $root->getMessage());
		}
		return true;
	}
	
	public function getRoot()
	{
		$root = $this->data->toArray();
		return $root['root'];
	}
}
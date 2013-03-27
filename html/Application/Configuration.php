<?php
include_once 'Config.php';

class Configuration extends Config
{
	/**
	 * construct
	 * @param string $configFile
	 * @param string $configType
	 * @return void
	 */
	public function __construct($configFile, $configType='INIFILE')
	{
		parent::Config();
		$this->parseConfig($configFile, $configType);
	}
	
	/**
	 * getArray()
	 * @return Array
	 */
	public function getArray()
	{
		return $this->getRoot()->toArray();
	}
	
	/**
	 * getRootArray()
	 * @return Array
	 */
	public function getRootArray()
	{
		$array = $this->getRoot()->toArray();
		return $array['root'];
	}
}
<?php
/*
 * Created on 10.08.2008
 * Author Enrico, <enrico@re-design.de>
 * Copyright &copy; 2008, RE-Design
 *
 * Project REDcms
 * Path core/class/
 * File configuration.php
 */

class Configuration
{
	/**
	 * @access public
	 * @var Float
	 */
	public $version = 1.0;

	/**
	 * @access private
	 * @var String
	 */
	private $file;

	/**
	 * @access private
	 * @var Array
	 */
	private $config;

	/**
	 * Constructor
	 *
	 * @access public
	 * @param String $file
	 */
	public function __construct($file) {
		$this->file = $file;
		try {
			$this->config = parse_ini_file($file, true);
		} catch (Exception $e)
		{
			die('Config-Error parseIni: '.$e.': '.$file);
		}
	}

	/**
	 * Deconstructor
	 *
	 * @access public
	 */
	public function __destruct() {}

	/**
	 * @access public
	 * @param String $key
	 * @param String $section
	 * @return String
	 */
	public function getValue($key, $section) {
		return $this->config[$section][$key];
	}

	/**
	 * @access public
	 * @param String $section
	 * @return Array
	 */
	public function getSection($section) {
		return $this->config[$section];
	}
}
?>
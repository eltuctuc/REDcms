<?php
include_once 'Interfaces/Controller.php';

abstract class ControllerCommon implements Controller
{
	/**
	 * @var MDB2_Driver_mysql
	 */
	private $db;
	
	public function __construct()
	{
		$this->db = Registry::getInstance()->getDatabase();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Controller#execute($request, $response)
	 */
	public function execute(Request $request, Response $response)
	{
	}
}
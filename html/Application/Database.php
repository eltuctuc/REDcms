<?php
include_once 'MDB2.php';

class Database
{	
	/**
	 * @static
	 * @param array $dsn
	 * @return MDB2_Driver_Common
	 */
	public static function connect($dsn)
	{
		$db = MDB2::connect($dsn);
		if (PEAR::isError($db))
		{
			die($db->getMessage());
		}
		return $db;
	}
}
<?php
include_once 'DB/Table.php';

abstract class ModelCommon extends DB_Table
{
	/**
	 * Fetchmode object
	 * ex: $object->id
	 * 
	 * @var integer
	 */
	#public $fetchmode = MDB2_FETCHMODE_OBJECT;
}
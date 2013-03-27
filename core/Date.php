<?php

class Date
{
	static $formatShort;
	static $formatLong;
	
	static function setShortFormat($format)
	{
		self::$formatShort = $format;
	}
	static function setLongFormat($format)
	{
		self::$formatLong = $format;
	}
	
	static function getShortFormat($date)
	{
		$ts = strtotime($date);
		return strftime(self::$formatShort, $ts);
	}
	
	static function getLongFormat($date)
	{
		$ts = strtotime($date);
		return strftime(self::$formatLong, $ts);
	}
}

?>
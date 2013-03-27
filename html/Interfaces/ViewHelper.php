<?php
/**
 * ViewHelper
 * @author Enrico Reinsdorf <enrico.reinsdorf@re-design.de>
 */
interface ViewHelper
{
	/**
	 * execute
	 * @param array $args
	 * @return string
	 */
	public function execute($args = array());
}
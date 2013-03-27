<?php
interface View
{
	public function __construct($templateName);
	public function __get($property);
	public function __call($methodeName, $args);
	public function assign($name, $value='');
	public function get();
}
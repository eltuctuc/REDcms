<?php
class ViewHelper_BaseUrl extends ViewHelperCommon
{
	public function execute($args=array())
	{
		$request = SessionRegistry::getInstance()->getRequest();
		#Helper::show($_SERVER);
		
		$url = 'http://' . $_SERVER['HTTP_HOST'];
		$url .= dirname($_SERVER['PHP_SELF']) . '/';
		return $url;
	}
}
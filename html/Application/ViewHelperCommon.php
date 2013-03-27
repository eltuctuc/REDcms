<?php
include_once 'Interfaces/ViewHelper.php';

class ViewHelperCommon implements ViewHelper
{
	public function execute($args = array())
	{
		return 'class ViewHelperCommon';
	}
}
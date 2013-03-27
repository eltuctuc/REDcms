<?php

class Layouter_ViewHelper_Menue extends ViewHelperCommon
{
	/**
	 * (non-PHPdoc)
	 * @see application/interfaces/ViewHelper#execute($args)
	 */
	public function execute($args = array())
	{
		#$db = Registry::getInstance()->getDatabase();
		
		#$Menue = new Menue_Content($db);
		
		#return $Menue->getMenueList($args[0]);
		return 'Not implement!';
	}
}
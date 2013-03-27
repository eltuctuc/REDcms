<?php
class Default_View
{
	/**
	 * Constructor
	 * 
	 * @access public
	 * @param string $template
	 * @return void
	 */
	public function __construct($templateName)
	{
		$this->template = APP_ROOT.'/Modul/Page/template/'.$templateName.'.php';
	}
}
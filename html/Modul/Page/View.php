<?php
class Page_View extends ViewCommon
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
<?php
class Layouter_Controller extends ControllerCommon
{
	/**
	 * @var Controller
	 */
	private $modul;
	
	public function __construct(Controller $modul)
	{
		parent::__construct();
		$this->modul = $modul;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Application/ControllerCommon#execute($request, $response)
	 */
	public function execute(Request $request, Response $response)
	{
		$content = $this->modul->execute($request, $response);
		
		$view = new Layouter_View('index');
		$view->assign('title','REDcms');
		$view->assign('content',$content);
		$view->assign('randomImage','');
		$view->assign('adminPanel','');
		
		$doc = $response->getDocument();
		$doc->addStyleSheet('Modul/Layouter/template/css/screen_design.css');
		
		$response->write($view->get());
	}
}
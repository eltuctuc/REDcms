<?php
class Page_Controller extends ControllerCommon
{
	public function execute(Request $request, Response $response)
	{
		#$response->write('Page Conntroller loaded!');
		
		$url = new URL($request->getParameter('url'));
		
		switch($url->action)
		{
			case 'overview':
				$data = $this->overview();
				break;
			case 'edit':
				$data = $this->edit();
				break;
			case 'show':
			default:
				$data = $this->show();
		}		
		
		return $data;
	}
	
	private function show()
	{
		$pageModel = new Page_Model($this->db);
		$articleModel = new Article_Model($this->db);
		
		var_dump($pageModel);
		
		$result = $pageModel->select('list');
		
		$view = new Page_View('show');
		$view->assign('title','Hello World');
		return $view->get();
	}
	
	private function overview()
	{
		$view = new Page_View('overview');
		$view->assign('title','Übersicht');
		return $view->get();
	}
	
	private function edit()
	{
		$view = new Page_View('edit');
		$view->assign('title','Bearbeitung');
		return $view->get();
	}
}
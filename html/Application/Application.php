<?php

class Application
{
	/**
	 * @var string - DefaultControllerName
	 */
	private	$defaultController;
	/**
	 * pool of prefilters
	 * @var FilterChain
	 */
	private $preFilter;
	/**
	 * pool of postfilters
	 * @var FilterChain
	 */
	private $postFilter;
	
	public function __construct()
	{
		#$this->defaultController = 'Default';
		$this->defaultController = 'Page';
		$this->preFilter = new FilterChain('preFilter');
		$this->postFilter = new FilterChain('postFilter');
		
		$this->addPreFilter(new Filter_Alias());
	}
	
	/**
	 * add filter to the prefilters
	 * @param Filter $filter
	 * @return void
	 */
	private function addPreFilter(Filter $filter)
	{
		$this->preFilter->addFilter($filter);
	}
	
	/**
	 * add filter to the postfilter
	 * @param Filter $filter
	 * @return void
	 */
	private function addPostFilter(Filter $filter)
	{
		$this->postFilter->addFilter($filter);
	}
	
	/**
	 * return the language array
	 * @param Request $request
	 * @return Language
	 */
	private function getLanguage(Request $request)
	{
		$lang = $request->getParameter('lang');
		$language = new Language($lang);
		return $language;
	}
	
	/**
	 * return the controller
	 * @param Request $request
	 * @return Controller
	 */
	private function getController(Request $request)
	{
		if($request->issetParameter('controller') && $request->getParameter('controller')!='')
		{
			$controller = ucfirst($request->getParameter('controller'));
			
			return $this->loadController($controller);
		}
		return $this->loadController($this->defaultController);
	}
	
	/**
	 * load the controller
	 * @param string $controllerName
	 * @return Controller
	 */
	private function loadController($controllerName)
	{
		$controllerName .= '_Controller';
		
		$pathArray = explode('_',$controllerName);	
		$filename = implode('/',$pathArray).'.php';
		
		if($controller = new $controllerName())
		{
			return $controller;
		}
		
		$controllerName = $this->defaultController;
		$controller = new $controllerName();
		return $controller;
	}
	
	/**
	 * run the application
	 * @return void
	 */
	public function run()
	{
		$request = new HttpRequest();
		$response = new HttpResponse();
		$config = new Configuration('configuration/application.ini');
		$root = $config->getRootArray();
		$db = Database::connect($root['Database']);
		
		$registry = Registry::getInstance();
		$registry->setConfiguration($config);
		$registry->setDatabase($db);
		
		# url = '/lang/cmd[/action[/id[/extra]]]'
		$this->preFilter->processFilters($request, $response);
		
		$lang = $this->getLanguage($request);
		
		$modul = $this->getController($request);
		
		$layouter = new Layouter_Controller($modul);
		$layouter->execute($request, $response);
		
		$this->postFilter->processFilters($request, $response);
		
		$response->addHeader('Content-Type','text/html; charset=utf-8');
		$response->flush();
	}
}
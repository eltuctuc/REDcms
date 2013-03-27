<?php
include_once 'Interfaces/Filter.php';

class Filter_Alias implements Filter
{
	/**
	 * (non-PHPdoc)
	 * @see application/interfaces/Filter#execute($request, $respone)
	 */
	public function execute(Request $request, Response $response)
	{
		$url = explode('/',$request->getParameter('url'),3);
		
		switch($url[0])
		{
			case 'en':
			case 'de':
			case 'no':
				$request->setParameter('lang',$url[0]);
				break;
			default:
				$request->setParameter('lang','de');
		}
		
		$request->setParameter('controller',$url[1]);
		$request->setParameter('query',$url);
	}
}
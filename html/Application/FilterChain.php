<?php
class FilterChain
{
	private $filters = array();
	private $name = null;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function addFilter(Filter $filter)
	{
		$this->filters[] = $filter;
	}
	
	public function processFilters(Request $request, Response $response)
	{
		#Helper::show($this->name);
		foreach($this->filters as $filter)
		{
			$filter->execute($request, $response);
		}
	}
}
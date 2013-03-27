<?php
include_once 'Interfaces/Controller.php';

class Default_Controller extends ControllerCommon
{
	public function execute(Request $request, Response $response)
	{
		return 'This is the default Conntroller!';
	}
}
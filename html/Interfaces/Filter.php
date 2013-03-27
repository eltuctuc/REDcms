<?php
interface Filter
{
	public function execute(Request $request, Response $respone);
}
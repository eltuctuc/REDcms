<?php
interface Response
{
	/**
	 * set the response status
	 * @param string $status
	 * @return void
	 */
	public function setStatus($status);
	/**
	 * add header information
	 * @param string $name
	 * @param string $value
	 * @return void
	 */
	public function addHeader($name,$value);
	/**
	 * add a string to the current body
	 * @param string $data
	 * @return void
	 */
	public function write($data);
	/**
	 * send all to the client
	 * @return void
	 */
	public function flush();
	/**
	 * get the body information
	 * @return string
	 */
	public function getBody();
	/**
	 * override the body information
	 * @param string $body
	 * @return void
	 */
	public function setBody($body);
}
<?php
include_once 'Interfaces/Response.php';

class HttpResponse implements Response
{
	/**
	 * @var string
	 */
	private $status;
	/**
	 * @var array
	 */
	private $header = array();
	/**
	 * @var string
	 */
	private $body = '';
	/**
	 * @var HTMLDocument
	 */
	public $document = null;
	
	/**
	 * Constructor
	 * @return void
	 */
	public function __construct()
	{
		$this->reset();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Response#setStatus($status)
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Response#addHeader($name, $value)
	 */
	public function addHeader($name,$value)
	{
		$this->header[$name] = $value;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Response#write($data)
	 */
	public function write($data)
	{
		$this->body .= $data;
	}
	
	/**
	 * add mixed information to the body
	 * @param mixed $data
	 * @return void
	 */
	public function addToBody($data)
	{
		$data = '<pre>'.var_export($data, true).'</pre>';
		$this->write($data);
	}
	
	/**
	 * add code information to the body
	 * @param mixed $data
	 * @return void
	 */
	public function addCodeToBody($data)
	{
		$data = var_export($data, true);
		$data = htmlentities($data);
		$data = '<pre>'.$data.'</pre>';
		$this->write($data);
	}
	
	/**
	 * get the HTMLDocument class
	 * @return HtmlDocument
	 */
	public function getDocument()
	{
		return $this->document;
	}
	
	/**
	 * set the HtmlDocument
	 * @param HtmlDocument $doc
	 * @return void
	 */
	public function setDocument(HtmlDocument $doc)
	{
		$this->document = $doc;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Response#getBody()
	 */
	public function getBody()
	{
		return $this->body;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Response#setBody($body)
	 */
	public function setBody($body)
	{
		$this->body = $body;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Interfaces/Response#flush()
	 */
	public function flush()
	{
		header('HTTP/1.0 ' . $this->status);
		
		foreach($this->header as $name=>$value)
		{
			header($name . ': ' . $value);
		}
		
		$this->document->addStyleSheet('template/css/text.css');
		$this->document->addStyleSheet('template/css/960.css');
		$this->document->addStyleSheet('template/css/reset.css');
		
		$this->document->addKeywords(array('REDcms','Enrico','Reinsdorf'));
		$this->document->addDescription('REDcms - ein kleines CMS von Enrico Reinsdorf');
		$this->document->addMetaTag('creator', 'REDcms v1.0');
		
		$this->document->setBody($this->body);
		echo $this->document->render();
		
		$this->reset();
	}
	
	/**
	 * reset all information
	 * @return void
	 */
	public function reset()
	{
		$this->status = '200 OK';
		$this->header = array();
		$this->body = null;
		$this->document = new HtmlDocument(BASE_URL);
	}
}
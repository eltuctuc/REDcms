<?php
/**
 * Enter description here...
 *
 */
class Template
{
	/**
	 * @access public
	 * @var Float
	 */
	public $version = 1.0;

	/**
	 * @access private
	 * @var String
	 */
	private $path;

	/**
	 * @access private
	 * @var String
	 */
	private $source;

	/**
	 * @access private
	 * @var String
	 */
	private $template;

	/**
	 * @access private
	 * @var Array
	 */
	private $values;

	/**
	 * Enter description here...
	 *
	 */
	const DISPLAY_HTML = true;
	/**
	 * Enter description here...
	 *
	 */
	const DISPLAY_CODE = false;
	
	/**
	 * Konstructor
	 *
	 * @access public
	 * @param String $path
	 */
	public function __construct( $path )
	{
		$this->path = $path.'/';
		$this->values = array();
	}

	/**
	 * Deconstructor
	 *
	 * @access public
	 */
	public function __destruct() {}

	/**
	 * @access public
	 * @param String $file
	 */
	public function load( $file )
	{
		$this->source = file_get_contents( $this->path.$file );
		$this->reload();
	}

	/**
	 * @access public
	 */
	public function reload()
	{
		$this->template = $this->source;
	}

	/**
	 * @access public
	 * @param String $key
	 * @param String $value
	 */
	public function set( $key, $value='' )
	{
		$this->values[$key] = $value;
	}

	/**
	 * @access private
	 */
	private function parse()
	{
		if( $this->source == null || $this->source=='' )
		{
			die('TPL-Error: file not loaded!');
		}
		
		foreach ( $this->values as $key => $value )
		{
			$this->template = str_replace( $key, $value, $this->template );
		}
		
		$this->template = ereg_replace( '##[A-Za-z0-9_]+##', '', $this->template);
	}

	/**
	 * @access public
	 * @param Booloean $sourcecode
	 * @return String
	 */
	public function get( $sourcecode=true )
	{
		if( $this->source==null || $this->source=='' )
		{
			return null;
		}
		
		$this->parse();
		
		if( !$sourcecode )
		{
			$out = '<pre>';
			$out .= htmlentities( $this->template );
			$out .= '</prev>';
		}
		else 
		{
			$out = $this->template;
		}
		return $out;
	}

	/**
	 * @access public
	 * @param Booloean $sourcecode
	 * @return String
	 */
	public function write( $sourcecode=true )
	{
		echo $this->get( $sourcecode );
	}
}

?>
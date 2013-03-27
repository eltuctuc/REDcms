<?php
include_once 'Interfaces/View.php';
/**
 * ViewCommon Klasse
 * 
 * <code>
 * require_once 'ViewCommon.php';
 *
 * $tpl = new ViewCommon('template/index.php');
 * $tpl->assign('KEYWORD', 'Hello World');
 * $tpl->render($request, $response);
 * </code>
 * 
 * @author Enrico Reinsdorf <enrico.reinsdorf@re-design.de>
 * @abstract
 * @package REDcms
 * @subpackage ViewCommon
 */
abstract class ViewCommon implements View
{
	protected $modul = null;
	/**
	 * path to template file
	 * 
	 * @access protected
	 * @var string
	 */
	protected $template = null;
	/**
	 * array with keywords
	 * 
	 * @access protected
	 * @var array
	 */
	protected $vars = array();
	/**
	 * list of helper classes
	 * 
	 * @access protected
	 * @var array
	 */
	protected $helpers = array();

	/**
	 * Constructor
	 * 
	 * @access public
	 * @param string $template
	 * @return void
	 */
	public function __construct($templateName)
	{
		$this->template = APP_ROOT.'/Modul/'.$this->modul.'/template/'.$templateName.'.php';
	}
	
	/**
	 * general getter method
	 * 
	 * get a list item form $this->vars[]
	 * 
	 * @access public
	 * @param string $property
	 * @return mixed
	 */
	public function __get($property)
	{
		if(isset($this->vars[$property]))
		{
			return $this->vars[$property];
		}
		return null;
	}
	
	/**
	 * general call method for view helper
	 * 
	 * call a viewhelper method
	 * 
	 * @access public
	 * @param string $methodName
	 * @param array $args
	 * @return string
	 */
	public function __call($methodName, $args)
	{
		$helper = $this->loadViewHelper($methodName);
		if($helper === null)
		{
			return 'Unbekannter ViewHelper ' . $methodName;
		}
		
		return $helper->execute($args);
	}
	
	/**
	 * set a keyword/value
	 * 
	 * @access public
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function assign($name, $value='')
	{
		$this->vars[$name] = $value;
	}
	
	/**
	 * get the template return
	 * 
	 * @access public
	 * @return string
	 */
	public function get()
	{
		ob_start();
		require $this->template;
		$data = ob_get_clean();

		return $data;
	}
	
	/**
	 * load a ViewHelper
	 * 
	 * @access protected
	 * @param string $helper
	 * @return ViewHelper
	 */
	protected function loadViewHelper($helper)
	{
		$helperName = ucfirst($helper);
		
		if(!isset($this->helpers[$helper]))
		{
			if($this->modul !== null)
			{
				$className = $this->modul.'_ViewHelper_' . $helperName;
			}
			else
			{
				$className = 'ViewHelper_' . $helperName;
			}
			
			$this->helpers[$helper] = new $className();
		}
		return $this->helpers[$helper];
	}
}
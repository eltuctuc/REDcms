<?php
/**
 * SessionRegistry Klasse
 * 
 * Singleton-Class
 * 
 * <code>
 * require_once 'SessionRegistry.php';
 *
 * $objekt = SessionRegistry::getInstance();
 * </code>
 * 
 * @author Enrico Reinsdorf <enrico.reinsdorf@re-design.de>
 * @package REDcms
 * @subpackage SessionRegistry
 */
class SessionRegistry
{
	/**
	 * get a instance form the class
	 * 
	 * @access public
	 * @static
	 * @return SessionRegistry
	 */
	public static function getInstance() {
		if(self::$instance == null)
		{
			self::$instance = new SessionRegistry();
		}
		return self::$instance;
	}
	
	/**
	 * Constructor
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __construct()
	{
		session_start();
		
		if(!isset($_SESSION['__registry']))
		{
			$_SESSION['__registry'] = array();
		}
	}
	
	protected function __clone(){}
	
	/**
	 * (non-PHPdoc)
	 * @see application/Registry#set($key, $value)
	 */
	public function set($key, $value)
	{
		$_SESSION['__registry'][$key] = $value;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see application/Registry#get($key)
	 */
	public function get($key)
	{
		if(isset($_SESSION['__registry'][$key]))
		{
			return $_SESSION['__registry'][$key];
		}
		return null;
	}

	/**
	 * (non-PHPdoc)
	 * @see application/Registry#remove($key)
	 */
	public function remove($key)
	{
		if(array_key_exists($key, $_SESSION['__registry']))
		{
			unset($_SESSION['__registry'][$key]);
		}
	}
}
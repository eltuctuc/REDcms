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
 * @subpackage Registry
 */
class Registry
{
	/**
	 * 
	 * @access protected
	 * @static
	 * @var Registry
	 */
	protected static $instance = null;
	
	/**
	 * get the instance of class
	 * 
	 * @access public
	 * @static
	 * @return Registry
	 */
	public static function getInstance() {
		if(self::$instance === null)
		{
			self::$instance = new Registry();
		}
		return self::$instance;
	}
	
	/**
	 * Constructor
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __construct(){}
	/**
	 * Clone
	 * 
	 * @access protected
	 * @return void
	 */
	protected function __clone(){}
	
	/**
	 * variable for all values
	 * 
	 * @access protected
	 * @var array
	 */
	protected $data = array();
	
	/**
	 * @const KEY_CONFIGURYTION
	 * @var string
	 */
	const KEY_CONFIGURYTION = 'config';
	/**
	 * @const KEY_REQUEST
	 * @var string
	 */
	const KEY_REQUEST = 'request';
	/**
	 * @const KEY_RESPONSE
	 * @var string
	 */
	const KEY_RESPONSE = 'response';
	/**
	 * @const KEY_DATABASE
	 * @var string
	 */
	const KEY_DATABASE = 'database';
	/**
	 * @const KEY_USER
	 * @var string
	 */
	const KEY_USER = 'user';
	/**
	 * @const KYE_SESSION
	 * @var unknown_type
	 */
	const KEY_SESSION = 'session';
	
	/**
	 * set a key/value
	 * 
	 * @access public
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->data[$key] = $value;
	}
	
	/**
	 * get the value of key
	 * 
	 * @access public
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		if(isset($this->data[$key]))
		{
			return $this->data[$key];
		}
		return null;
	}
	
	/**
	 * remove a key form data
	 * @param string $key
	 * @return void
	 */
	public function remove($key)
	{
		if(in_array($key, $this->data))
		{
			unset($this->data[$key]);
		}
	}

	
	/**
	 * registry the config class
	 * 
	 * @access public
	 * @param Configuration $config
	 * @return void
	 */
	public function setConfiguration(Configuration $config)
	{
		$this->set(self::KEY_CONFIGURYTION, $config);
	}
	
	/**
	 * registry the request class
	 * 
	 * @access public
	 * @param Request $request
	 * @return void
	 */
	public function setRequest(Request $request)
	{
		$this->set(self::KEY_REQUEST, $request);
	}
	
	/**
	 * registry the response class
	 * 
	 * @access public
	 * @param Response $response
	 * @return void
	 */
	public function setResponse(Response $response)
	{
		$this->set(self::KEY_RESPONSE, $response);
	}
	
	/**
	 * registry the database class
	 * 
	 * @access public
	 * @param MDB2_Driver_Common $database
	 * @return void
	 */
	public function setDatabase(MDB2_Driver_Common $database)
	{
		$this->set(self::KEY_DATABASE, $database);
	}
	
	/**
	 * registry the user class
	 * 
	 * @access public
	 * @param User $user
	 * @return void
	 */
	public function setUser(User $user)
	{
		$this->set(self::KEY_USER, $user);
	}
	
	/**
	 * registry the session class
	 * 
	 * @access public
	 * @param Session $session
	 * @return void
	 */
	public function setSession(Session $session)
	{
		$this->set(self::KEY_SESSION, $session);
	}
	
	/**
	 * remove the config class
	 * 
	 * @access public
	 * @return void
	 */
	public function removeConfiguration()
	{
		$this->remove(self::KEY_CONFIGURYTION);
	}
	
	/**
	 * remove the request class
	 * 
	 * @access public
	 * @return void
	 */
	public function removeRequest()
	{
		$this->remove(self::KEY_REQUEST);
	}
	
	/**
	 * remove the response class
	 * 
	 * @access public
	 * @return void
	 */
	public function removeResponse()
	{
		$this->remove(self::KEY_RESPONSE);
	}
	
	/**
	 * remove the database class
	 * 
	 * @access public
	 * @return void
	 */
	public function removeDatabase()
	{
		$this->remove(self::KEY_DATABASE);
	}
	
	/**
	 * remove the user class
	 * 
	 * @access public
	 * @return void
	 */
	public function removeUser()
	{
		$this->remove(self::KEY_USER);
	}
	
	/**
	 * remove the session class
	 * 
	 * @access public
	 * @return void
	 */
	public function removeSession()
	{
		$this->remove(self::KEY_SESSION);
	}
	
	/**
	 * get the config class
	 * 
	 * @access public
	 * @return Configuration
	 */
	public function getConfiguration()
	{
		return $this->get(self::KEY_CONFIGURYTION);
	}
	
	/**
	 * get the request class
	 * 
	 * @access public
	 * @return Request
	 */
	public function getRequest()
	{
		return $this->get(self::KEY_REQUEST);
	}
	
	/**
	 * get the response class
	 * 
	 * @access public
	 * @return Response
	 */
	public function getResponse()
	{
		return $this->get(self::KEY_RESPONSE);
	}
	
	/**
	 * get the database class
	 * 
	 * @access public
	 * @return MDB2_Driver_Common
	 */
	public function getDatabase()
	{
		return $this->get(self::KEY_DATABASE);
	}
	
	/**
	 * get the user class
	 * 
	 * @access public
	 * @return User
	 */
	public function getUser()
	{
		return $this->get(self::KEY_USER);
	}
	
	/**
	 * get the session class
	 * 
	 * @access public
	 * @return Session
	 */
	public function getSession()
	{
		return $this->get(self::KEY_SESSION);
	}
}
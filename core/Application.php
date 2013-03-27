<?php

/**
 * Enter description here...
 *
 */
class Application
{
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Template
	 */
	private $tpl;
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Configuration
	 */
	private $config;
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Request
	 */
	private $request;
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Database
	 */
	private $db;
	
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Sting $content
	 */
	private $content;
	
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var String $sidebar
	 */
	private $sidebar;
	
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var String $titlebar
	 */
	private $titlebar;
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Page
	 */
	private $page;
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Box
	 */
	private $box;
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @var Menu
	 */
	private $menu;
	
	
	public function __construct()
	{
		$this->init();
	}
	
	public function __destruct()
	{
	
	}

	private function init()
	{
		setlocale(LC_ALL, 'de');
		
		$this->config = new Configuration('./configuration.ini');
		
		$this->tpl = new Template(TEMPLATEPATH);
		
		$db = $this->config->getSection('Database');
		#mysql://user:pass@host/database
		$dsn = 'mysql://'.$db['user'].':'.$db['password'].'@'.$db['host'].'/'.$db['db'];
		
		$this->db = Database::connect($dsn);
		$this->db->setFetchMode(DB_FETCHMODE_OBJECT);
		
		if($this->db->isError($this->db))
		{
			die($this->db->getMessage());
		}
		
		Date::setLongFormat($this->config->getValue('dateformatlong', 'Application'));
		Date::setShortFormat($this->config->getValue('dateformatshort', 'Application'));
	}
	
	public function main()
	{
		$this->request = new Request($_GET,$_REQUEST);
		
		switch ($this->request->getMode())
		{
			case Request::MODE_BOX:
				$this->content = $this->getBox($this->request->getId());
				break;
			case Request::MODE_MENU:
				$this->content = $this->getMenu($this->request->getId());
				break;
			case Request::MODE_PAGE:
			default:
				$this->content = $this->getPage($this->request->getId());
				break;
		}
		
		$this->sidebar = $this->getSidebar($this->request->getId());
	}
	
	private function getPage($id=1)
	{
		$this->page = new Page($this->db);
		
		$content = '';
		
		switch ($this->request->getAction()) {
			case Request::ACTION_ADD:
				$content = $this->page->add();
				break;
			case Request::ACTION_EDIT:
				$content = $this->page->edit($id);
				break;
			case Request::ACTION_DELETE:
				$content = $this->page->delete($id);
				break;
			case Request::ACTION_UPDATE:
				$content = $this->page->update();
				break;
			case Request::ACTION_SHOW:
			default:
				$content = $this->page->get($id);
			break;
		}
		$this->titlebar = $this->page->getTitle();
		
		return $content;
	}
	
	private function getBox($id=1)
	{
		$this->box = new Box($this->db);
		
		$content = '';
		
		switch ($this->request->getAction()) {
			case Request::ACTION_ADD:
				$content = $this->box->add();
				break;
			case Request::ACTION_EDIT:
				$content = $this->box->edit($id);
				break;
			case Request::ACTION_DELETE:
				$content = $this->box->delete($id);
				break;
			case Request::ACTION_UPDATE:
				$content = $this->box->update();
				break;
			case Request::ACTION_SHOW:
			default:
				$content = $this->box->get($id);
			break;
		}
		$this->titlebar = $this->box->getTitle();
		return $content;
	}
	
	private function getMenu($id=1)
	{
		$this->menu = new Menu($this->db);
		
		$content = '';
		
		switch ($this->request->getAction()) {
			case Request::ACTION_ADD:
				$content = $this->menu->add();
				break;
			case Request::ACTION_EDIT:
				$content = $this->menu->edit($id);
				break;
			case Request::ACTION_DELETE:
				$content = $this->menu->delete($id);
				break;
			case Request::ACTION_UPDATE:
				$content = $this->menu->update();
				break;
			case Request::ACTION_SHOW:
			default:
				$content = $this->menu->get($id);
			break;
		}
		$this->titlebar = $this->menu->getTitle();
		return $content;
	}
	
	private function getSidebar($id=1)
	{
		$login = Login::getAdminBox();
		$navi  = $this->getMenuBox(0);
		
		$this->tpl->load('sidebar.tpl.html');
		$this->tpl->set('##NAVIGATION##',	$navi);
		$this->tpl->set('##LOGIN##',		$login);
		
		return $this->tpl->get($id);
	}
	
	private function getMenuBox($page_id=1)
	{
		$content = '<h4>Navigation</h4>';
		$menu = new Menu( $this->db );
		
		return $content.$menu->getTree( $page_id );
	}
	
	public function display()
	{
		$website = $this->config->getSection('Website');
		
		$this->titlebar = $website['Title'].' - '.$this->titlebar;
		
		$this->tpl->load('index.tpl.html');
		$this->tpl->set('##BASEURL##', BASEURL);
		$this->tpl->set('##TITLEBAR##', $this->titlebar);
		$this->tpl->set('##WEBSITETITLE##', $website['Title']);
		$this->tpl->set('##TAGLINE##', $website['Tagline']);
		$this->tpl->set('##CONTENT##', $this->content);
		$this->tpl->set('##SIDEBAR##', $this->sidebar);
		
		return $this->tpl->get();
	}
}

?>
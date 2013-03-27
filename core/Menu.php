<?php

require_once ('core/Content.php');

/**
 * Enter description here...
 *
 */
class Menu extends Content
{
	/**
	 * Enter description here...
	 *
	 * @var String
	 */
	protected $table = 'menu';
	
	/**
	 * Enter description here...
	 *
	 * @param Database $db
	 */
	function __construct($db)
	{
		parent::__construct ( $db );
	}
	
	/**
	 * Enter description here...
	 *
	 */
	function __destruct() {}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @param Integer $page_id
	 * @return String
	 */
	public function getTree($page_id)
	{
		return $this->getNavigation(0, $page_id);
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @return String
	 */
	public function add()
	{
		if(Login::isLogged())
		{	
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('menu.form.tpl.html');
			$tpl->set('##HEADLINE##',	'neuer Menüpunkt hinzufügen');
			$tpl->set('##URL##',		BASEURL.'/menu/0/update');
			$tpl->set('##REQUEST##',	$_SERVER['REDIRECT_URL']);
			$tpl->set('##ACTION##',		'add');
			
			$tpl->set('##PARENTID##',	$this->getDropDownParentID(0, 0, 'keins'));
			$tpl->set('##PAGEID##',		$this->getDropDownPageID(1));
			$tpl->set('##ACCESS##',		0);
			$tpl->set('##CHECKED##',	'selected="selected"');
			
			return $tpl->get();
		}
		return 'Nicht angemeldet!';
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @param Integer $id
	 * @return String
	 */
	public function edit($id)
	{
		if(Login::isLogged())
		{
			$menu = $this->load($id);
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('menu.form.tpl.html');
			$tpl->set('##HEADLINE##',	$menu->name.' - Menüpunkt ändern');
			$tpl->set('##URL##',		BASEURL.'/menu/'.$menu->id.'/update');
			$tpl->set('##REQUEST##',	$_SERVER['REDIRECT_URL']);
			$tpl->set('##ACTION##',		'edit');
			
			$tpl->set('##ID##',			$menu->id);
			$tpl->set('##ACTION##',		Request::ACTION_EDIT);
			$tpl->set('##NAME##',		htmlentities($menu->name));
			$tpl->set('##TITLE##',		htmlentities($menu->title));
			$tpl->set('##PARENTID##',	$this->getDropDownParentID(0, $menu->parent_id, 'keins'));
			$tpl->set('##PAGEID##',		$this->getDropDownPageID($menu->page_id));
			$tpl->set('##ACCESS##',		$menu->access);
			
			if($menu->published == 1)
			{
				$tpl->set('##CHECKED##',	'selected="selected"');
			}
			else
			{
				$tpl->set('##NOCHECKED##',	'selected="selected"');
			}
						return $tpl->get();
		}
		return 'Nicht angemeldet!';
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @param Integer $id
	 */
	public function delete($id)
	{
		if(Login::isLogged())
		{
			$query = sprintf('DELETE FROM %s WHERE id=%d', $this->table, $id);
			$res =& $this->db->query($query);
			
			if (PEAR::isError($res)) {
	    		die($res->getMessage().': '.$query);
			}
	
			header('Location: '.BASEURL);
			exit();
		}
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 */
	public function update()
	{
		if(Login::isLogged())
		{
			$query = '';
			
			switch ( $_POST['action'] )
			{
				case Request::ACTION_ADD:
					$query = sprintf('INSERT INTO %s 
									(parent_id, page_id, name, title, created, modified, published, access)
									VALUES
									(%d, %d, "%s", "%s", NOW(), NOW(), %d, %d)', 
									$this->table, $_POST['parent_id'], $_POST['page_id'], $_POST['name'],
									$_POST['title'], $_POST['published'], $_POST['access']);
					break;
				case Request::ACTION_EDIT:
					$query = sprintf('UPDATE %s SET parent_id=%d, page_id=%d, name="%s", title="%s", 
									modified=NOW(), published=%d, access=%d
									WHERE id=%d', 
									$this->table, $_POST['parent_id'], $_POST['page_id'], $_POST['name'], 
									$_POST['title'], $_POST['published'], $_POST['access'], $_POST['id']);
					break;
			}
			
			$res =& $this->db->query($query);
			
			if (PEAR::isError($res)) {
	    		die($res->getMessage().': '.$query);
			}

			header('Location: '.$_POST['request']);
			exit();
		}
	}
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @param Integer $parent_id
	 * @param Integer $page_id
	 * @return String $menu
	 */
	private function getNavigation($parent_id=0, $page_id=1)
	{
		$menuItems = $this->getMenuItems($parent_id);
		
		$menu = '<ul>';
		foreach ($menuItems as $menuItem)
		{
			if($page_id == $menuItem->page_id)
			{
				$item = sprintf('<span class="current" title="%s">%s</span>', $menuItem->title, $menuItem->name);
			} else {
				$url = sprintf(BASEURL.'/page/%d', $menuItem->page_id);
				$item  = sprintf('<a href="%s" title="%s">%s</a>', $url, $menuItem->title, $menuItem->name);
				$item .= $this->getAdminBox($menuItem->id, 'menu');
			}
			
			$menu .= '<li>';
			$menu .= $item;
			$menu .= $this->getNavigation($menuItem->id, $page_id);
			$menu .= '</li>';
		}
		$menu .= '</ul>';
		
		return $menu;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @param Integer $parent_id
	 * @return Array $menuItems
	 */
	private function getMenuItems($parent_id)
	{
		$item = null;
		$menuItems = array();
		
		$query = sprintf('SELECT * FROM %s WHERE parent_id=%d', $this->table, $parent_id);
		$res =& $this->db->query($query);
		
		if (PEAR::isError($res)) {
    		die($res->getMessage());
		}
		
		if($res->numRows() > 0)
		{
			while ($res->fetchInto($item))
			{
				/**
				 * Enter description here...
				 *
				 * @param unknown_type $page_id
				 * @return unknown
				 */
				array_push($menuItems, $item);
			}
		}
		
		$res->free();
		
		return $menuItems;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @param Integer $page_id
	 * @return String $options
	 */
	private function getDropDownPageID($page_id=0)
	{
		$options = '';
		$page = new Page($this->db);
		
		$pages = $page->getAllpages();
		
		foreach ($pages as $page) {
			$selected = ($page_id == $page->id) ? 'selected="selected" ' :'';
			$options .= sprintf('<option value="%d"%s>%s</option>', $page->id, $selected, $page->title);
		}
		
		return $options;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @param Integer $parent_id
	 * @param Integer $menu_id
	 * @param String $name
	 * @return String $options
	 */
	private function getDropDownParentID($parent_id, $menu_id, $name='')
	{
		$menuItems = $this->getMenuItems($parent_id);
		
		/*<select>
			<option>keins</option>
			<option>Seite 1</option>
			<optgroup label="Seite 1">
				<option>Seite 1</option>
				<optgroup label="Seite 1">
					<option>Seite 1</option>
					<option>Seite 2</option>
				</optgroup>
				<option>Seite 2</option>
				<option>Seite 3</option>
			</optgroup>
			<option>Seite 2</option>
		</select>*/
		$options = '';
		if($parent_id == 0)
		{
			$options .= sprintf('<option value="%d">%s</option>', 0, $name);
		}
		if(count($menuItems) >0)
		{
			foreach ($menuItems as $menuItem)
			{
				$selected = ($menu_id == $menuItem->id) ? 'selected="selected" ' :'';
				$options .= sprintf('<option value="%d" %s>%s</option>', $menuItem->id, $selected, $menuItem->name);
				$options .= $this->getDropDownParentID($menuItem->id, $menuItem->name);
			}
			if($parent_id > 0)
			{
				$options = sprintf('<optgroup label="%s">%s</optgroup>', $name, $option);
			}
		}
		
		return $options;
	}
}
?>
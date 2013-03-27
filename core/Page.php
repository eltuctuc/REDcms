<?php

require_once ('core/Content.php');

/**
 * Enter description here...
 *
 */
class Page extends Content
{
	/**
	 * Enter description here...
	 *
	 * @var String
	 */
	protected $table = 'page';

	/**
	 * Enter description here...
	 *
	 * @param Database $db
	 */
	function __construct($db) {
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
	 * @param Integer $id
	 * @return String
	 */
	public function get($id)
	{
		$page = $this->load($id);
		$this->title = $page->title;
		
		if($page->published || Login::isLogged())
		{
			$admin = $this->getAdminBox($page->id, 'page');
			$boxes = $this->getBoxes($page->id);
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load($page->template);
			$tpl->set('##ID##', $page->id);
			$tpl->set('##TITLE##', $page->title);
			$tpl->set('##ADMIN##', $admin);
			$tpl->set('##TEASER##', $page->teaser);
			$tpl->set('##BOXES##', $boxes);
			$tpl->set('##AUTHOR##', $page->author);
			$tpl->set('##MODIFIED##', Date::getLongFormat($page->modified));
			
			return $tpl->get();
		}
		return null;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access private
	 * @param Integer $id
	 * @return String $boxes
	 */
	private function getBoxes($id)
	{
		$box = new Box( $this->db );
		$boxes = '';
		
		$items = $box->getAllBoxes( $id );
		foreach( $items as $item )
		{
			if($item->published || Login::isLogged())
			{
				$admin = $this->getAdminBox( $item->id, 'box' );
						
				$tpl = new Template(TEMPLATEPATH);
				$tpl->load('box.tpl.html');
				$tpl->set('##ID##', $item->id);
				$tpl->set('##TITLE##', $item->title);
				$tpl->set('##TEASER##', $item->teaser);
				$tpl->set('##BODY##', $item->body);
				$tpl->set('##MODIFIED##', Date::getShortFormat($item->modified));
				$tpl->set('##ADMIN##', $admin);
				
				$boxes .= $tpl->get();
			}
		}
		
		return $boxes;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @return Array $pages
	 */
	public function getAllPages()
	{
		$page = new stdClass();
		$pages = array();
		
		$query = sprintf('SELECT * FROM %s ORDER BY title', $this->table);
		$res =& $this->db->query($query);
		
		if (PEAR::isError($res)) {
    		die($res->getMessage());
		}
		
		while ($res->fetchInto($page))
		{
			array_push($pages, $page);
		}
				
		return $pages;
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
			$this->title = 'Neue Seite (bearbeiten)';
			
			$teaser = new Editor('teaser');
			$teaser->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>';
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('page.form.tpl.html');
			$tpl->set('##HEADLINE##',		'neue Seite erstellen');
			$tpl->set('##URL##',			BASEURL.'/page/0/update');
			$tpl->set('##ACTION##',			Request::ACTION_ADD);
			$tpl->set('##REQUEST##',		$_SERVER['REDIRECT_URL']);
			
			$tpl->set('##AUTHOR##',			'Enrico Reinsdorf');
			$tpl->set('##TEASEREDITOR##',	$teaser->CreateHtml());
			$tpl->set('##TEMPLATE##',		'page.tpl.html');
			$tpl->set('##CHECKED##',		'selected="selected"');
			$tpl->set('##ACCESS##',			0);
			
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
			$page = $this->load($id);
			$this->title = $page->title.' (bearbeiten)';
			
			$teaser = new Editor('teaser');
			$teaser->Value = $page->teaser;
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('page.form.tpl.html');
			$tpl->set('##HEADLINE##',		$page->title.' - Seite ändern');
			$tpl->set('##URL##',			BASEURL.'/page/'.$page->id.'/update');
			$tpl->set('##REQUEST##',		$_SERVER['REDIRECT_URL']);
			
			$tpl->set('##ID##',				$page->id);
			$tpl->set('##ACTION##',			Request::ACTION_EDIT);
			$tpl->set('##TITLE##',			htmlentities($page->title));
			$tpl->set('##TEASER##',			htmlentities($page->teaser));
			$tpl->set('##TEASEREDITOR##',	$teaser->CreateHtml());
			$tpl->set('##AUTHOR##',			$page->author);
			$tpl->set('##ACCESS##',			$page->access);
			$tpl->set('##TEMPLATE##',		$page->template);
			
			if($page->published == 1)
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
			$page = $this->load($id);
			
			$query = sprintf('DELETE FROM box WHERE page_id=%d', $page->id);
			
			$res =& $this->db->query($query);
			
			if (PEAR::isError($res)) {
	    		die($res->getMessage().': '.$query);
			}
			
			$query = sprintf('DELETE FROM menu WHERE page_id=%d', $page->id);
			
			$res =& $this->db->query($query);
			
			if (PEAR::isError($res)) {
	    		die($res->getMessage().': '.$query);
			}
			
			$query = sprintf('DELETE FROM %s WHERE id=%d', $this->table, $page->id);
			
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
									(template, author, title, teaser, created, modified, published, access)
									VALUES
									("%s", "%s", "%s", "%s", NOW(), NOW(), %d, %d)', 
									$this->table, $_POST['template'], $_POST['author'], $_POST['title'],
									$_POST['teaser'], $_POST['published'], $_POST['access']);
					break;
				case Request::ACTION_EDIT:
					$query = sprintf('UPDATE %s SET template="%s", author="%s", title="%s", 
									teaser="%s", modified=NOW(), published=%d, access=%d
									WHERE id=%d', 
									$this->table, $_POST['template'], $_POST['author'], $_POST['title'], 
									$_POST['teaser'], $_POST['published'], $_POST['access'], $_POST['id']);
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
}
?>
<?php

require_once ('core/Content.php');

/**
 * Enter description here...
 *
 */
class Box extends Content
{
	/**
	 * Enter description here...
	 *
	 * @var String
	 */
	protected $table = 'box';
	
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
	 * @param Integer $id
	 * @return String
	 */
	public function get( $id )
	{
		$box = $this->load( $id );
		
		$admin = $this->getAdminBox($box->id, 'box');
		
		$tpl = new Template(TEMPLATEPATH);
		$tpl->load('teaser.box.tpl.html');
		$tpl->set('##ID##', $box->id);
		$tpl->set('##ADMIN##', $admin);
		$tpl->set('##TITLE##', $box->title);
		$tpl->set('##MODIFIED##', $box->modified);
		$tpl->set('##TEASER##', $box->teaser);
		$tpl->set('##MORE##', 'mehr');
		
		return $this->tpl->get();
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @param Integer $page_id
	 * @return Array $boxes
	 */
	public function getAllBoxes($page_id)
	{
		$item = new stdClass();
		$boxes = array();
		
		$query = sprintf('SELECT * FROM %s WHERE page_id=%d ORDER BY sorted', $this->table, $page_id);
		$res =& $this->db->query($query);
		
		if (PEAR::isError($res)) {
    		die($res->getMessage());
		}
		
		while ($res->fetchInto($item))
		{
			array_push($boxes, $item);
		}
		
		return $boxes;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @return Array $boxes
	 */
	public function getAll()
	{
		$item = new stdClass();
		$boxes = array();
		
		$query = sprintf('SELECT * FROM %s', $this->table);
		$res =& $this->db->query($query);
		
		if (PEAR::isError($res)) {
    		die($res->getMessage());
		}
		
		while ($res->fetchInto($item))
		{
			array_push($boxes, $item);
		}
		
		return $boxes;
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
			$this->title = 'Neue Box (bearbeiten)';
			
			$teaser = new Editor('teaser') ;
			$teaser->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>';
			$body = new Editor('body') ;
			$body->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>';
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('box.form.tpl.html');
			$tpl->set('##HEADLINE##',		'neue Box erstellen');
			$tpl->set('##URL##',			BASEURL.'/box/0/update');
			$tpl->set('##ACTION##',			Request::ACTION_ADD);
			$tpl->set('##REQUEST##',		$_SERVER['REDIRECT_URL']);
			
			$tpl->set('##TEASEREDITOR##'	,$teaser->CreateHtml());
			$tpl->set('##BODYEDITOR##'		,$body->CreateHtml());
			
			$tpl->set('##PAGEID##'			,$this->getDropDownPageID());
			$tpl->set('##SORTED##'			,$this->getDropDownSorted());
			
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
	public function edit($id=0)
	{
		if(Login::isLogged())
		{
			$box = $this->load($id);
			
			$this->title = $box->title.' (bearbeiten)';
			
			$teaser = new Editor('teaser') ;
			$teaser->Value = $box->teaser;
			$body = new Editor('body') ;
			$body->Value = $box->body;
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('box.form.tpl.html');
			$tpl->set('##HEADLINE##',		'neue Box erstellen');
			$tpl->set('##URL##',			BASEURL.'/box/0/update');
			$tpl->set('##ACTION##',			Request::ACTION_EDIT);
			$tpl->set('##REQUEST##',		$_SERVER['REDIRECT_URL']);
			
			$tpl->set('##ID##'				,$box->id);
			$tpl->set('##TITLE##'			,$box->title);
			$tpl->set('##TEASEREDITOR##'	,$teaser->CreateHtml());
			$tpl->set('##BODYEDITOR##'		,$body->CreateHtml());
			$tpl->set('##PAGEID##'			,$this->getDropDownPageID($box->page_id));
			$tpl->set('##SORTED##'			,$this->getDropDownSorted($box->sorted));
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
	 */
	public function delete($id=0)
	{
		if(Login::isLogged())
		{
			$box = $this->load($id);
			
			$query = sprintf('DELETE FROM %s WHERE id=%d', $this->table, $box->id);
			
			$res =& $this->db->query($query);
			
			if (PEAR::isError($res)) {
	    		die($res->getMessage().': '.$query);
			}

			header('Location: '.BASEURL.'/page/'.$box->page_id);
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
									(page_id, template, title, teaser, body, created, modified, published, access)
									VALUES
									(%d, "%s", "%s", "%s", "%s", NOW(), NOW(), %d, %d)', 
									$this->table, $_POST['page_id'], $_POST['template'], $_POST['title'],
									$_POST['teaser'], $_POST['body'], $_POST['published'], 
									$_POST['access']);
					break;
				case Request::ACTION_EDIT:
					$query = sprintf('UPDATE %s SET page_id=%d, template="%s", title="%s", 
									teaser="%s", body="%s", modified=NOW(), published=%d, access=%d
									WHERE id=%d', 
									$this->table, $_POST['page_id'], $_POST['template'], $_POST['title'], 
									$_POST['teaser'], $_POST['body'], $_POST['published'], 
									$_POST['access'], $_POST['id']);
					break;
			}
			
			$res =& $this->db->query($query);
			
			if (PEAR::isError($res)) {
	    		die($res->getMessage().': '.$query);
			}

			header('Location: '.BASEURL.'/page/'.$_POST['page_id']);
			exit();
		}
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
		
		$pages = $page->getAllPages();
		
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
	 * @param Integer $pos
	 * @return String $options
	 */
	private function getDropDownSorted($pos=0)
	{
		$all = $this->getAll();
		
		$options = '';
		for ($i=0; $i<count($all); $i++)
		{
			$selected = ($i == $pos) ? 'selected="selected" ' :'';
			$options .= sprintf('<option value="%d"%s>%d</option>', $i, $selected, $i);
		}
		return $options;
	}
}
?>
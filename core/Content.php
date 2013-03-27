<?php

/**
 * Enter description here...
 *
 */
class Content
{
	/**
	 * Enter description here...
	 *
	 * @access protected
	 * @var Database
	 */
	protected $db;
	/**
	 * Enter description here...
	 *
	 * @access protected
	 * @var String
	 */
	protected $title;
	
	/**
	 * Enter description here...
	 *
	 * @param Database $db
	 */
	function __construct($db)
	{
		$this->db = $db;
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
	 * @return String $titel
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Enter description here...
	 *
	 * @access protected
	 * @param Integer $id
	 * @return String $content
	 */
	protected function load( $id )
	{
		$content = '';
		$query = sprintf('SELECT * FROM %s WHERE id=%d LIMIT 1', $this->table, $id);
		
		$res =& $this->db->query($query);
		
		if (PEAR::isError($res)) {
    		die($res->getMessage());
		}
		
		if($res->numRows() == 0)
		{
			header('Location: '.BASEURL);
			exit();
		}
		
		$res->fetchInto($content);
		$res->free();
		
		return $content;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param Integer $id
	 * @param String $mode
	 * @return String $content
	 */
	protected function getAdminBox($id, $mode)
	{
		$content = '';
		if(isset($_SESSION['REDcms']))
		{
			$url = BASEURL.'/'.$mode.'/'.$id;
			
			$edit = '<img src="'.BASEURL.'/templates/images/icons/edit.png" width="16" height="16" alt="bearbeiten" title="bearbeiten" />';
			$delete = '<img src="'.BASEURL.'/templates/images/icons/delete.png" width="16" height="16" alt="löschen" title="löschen" />';
			
			$tpl = new Template(TEMPLATEPATH);
			$tpl->load('admin.box.tpl.html');
			$tpl->set('##MODE##',		$mode);
			$tpl->set('##URLEDIT##',	$url.'/edit');
			$tpl->set('##LINKEDIT##',	$edit);
			$tpl->set('##URLDELETE##',	$url.'/delete');
			$tpl->set('##LINKDELETE##',	$delete);
			
			$content = $tpl->get();
		}
		return $content;
	}
}
?>
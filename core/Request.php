<?php

# url?id=1&mode=page&action=show
/**
 * Enter description here...
 *
 */
class Request 
{
	/**
	 * Enter description here...
	 *
	 */
	const ACTION_ADD = 'add';
	
	/**
	 * Enter description here...
	 *
	 */
	const ACTION_EDIT = 'edit';
	
	/**
	 * Enter description here...
	 *
	 */
	const ACTION_UPDATE = 'update';
	
	/**
	 * Enter description here...
	 *
	 */
	const ACTION_DELETE = 'delete';
	
	/**
	 * Enter description here...
	 *
	 */
	const ACTION_SHOW = 'show';
	
	/**
	 * Enter description here...
	 *
	 */
	const MODE_PAGE = 'page';
	
	/**
	 * Enter description here...
	 *
	 */
	const MODE_BOX = 'box';
	
	/**
	 * Enter description here...
	 *
	 */
	const MODE_MENU = 'menu';
	
	/**
	 * Enter description here...
	 *
	 * @var String
	 */
	private $mode = '';
	
	/**
	 * Enter description here...
	 *
	 * @var Integer
	 */
	private $id = 1;
	
	/**
	 * Enter description here...
	 *
	 * @var String
	 */
	private $action = '';
	
	/**
	 * Enter description here...
	 *
	 * @var Array
	 */
	private $request = array();
	
	/**
	 * Enter description here...
	 *
	 * @param Array $get
	 * @param Array $request
	 */
	function __construct($get, $request)
	{
		$this->request = $request;
		
		if (!empty($get['mode'])) {
			switch ($get['mode']) {
				case self::MODE_BOX:
					$this->mode = self::MODE_BOX;
					break;
				case self::MODE_MENU:
					$this->mode = self::MODE_MENU;
					break;
				default:
					$this->mode = self::MODE_PAGE;
			}
		} else {
			$this->mode = self::MODE_PAGE;
		}
		
		if (!empty($get['id']) && !is_nan($get['id'])) {
			$this->id = $get['id'];
		} else {
			$this->id = 1;
		}
		
		if(!empty($get['action']))
		{
			switch ($get['action'])
			{
				case self::ACTION_ADD:
					$this->action = self::ACTION_ADD;
					break;
				case self::ACTION_EDIT:
					$this->action = self::ACTION_EDIT;
					break;
				case self::ACTION_UPDATE:
					$this->action = self::ACTION_UPDATE;
					break;
				case self::ACTION_DELETE:
					$this->action = self::ACTION_DELETE;
					break;
				case self::ACTION_SHOW:
				default:
					$this->action = self::ACTION_SHOW;
			}
		} else 
		{
			$this->action = self::ACTION_SHOW;
		}
	}
	
	/**
	 * @return String $action
	 */
	public function getAction() {
		return $this->action;
	}
	
	/**
	 * @param String $action
	 */
	public function setAction($action) {
		$this->action = $action;
	}
	
	/**
	 * @return Integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param Integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @return String $mode
	 */
	public function getMode() {
		return $this->mode;
	}
	
	/**
	 * @param String $mode
	 */
	public function setMode($mode) {
		$this->mode = $mode;
	}
}
?>
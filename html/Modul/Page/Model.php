<?php

class Page_Model extends ModelCommon
{
	/**
	 * Tablename
	 * @var string
	 */
	public $table = 'pages';
	
	/**
	 * Columns definition
	 * @var array
	 */
	public $col = array(
		
		/**
		 * @var array
		 */
		'id' => array(
			'type'		=> 'integer',
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'class' => array(
			'type'		=> 'varchar',
			'size'		=> 255,
		),
		
		/**
		 * @var array
		 */
		'title' => array(
			'type'		=> 'varchar',
			'size'		=> 255,
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'teaser' => array(
			'type'		=> 'text',
		),
		
		/**
		 * @var array
		 */
		'url' => array(
			'type'		=> 'varchar',
			'size'		=> 255
		),
		
		/**
		 * created
		 * @var array
		 */
		'created' => array(
			'type'		=> 'datetime',
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'modified' => array(
			'type'		=> 'datetime',
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'published' => array(
			'type'		=> 'boolean',
			'require'	=> true
		),
	);
    
    public $sql = array(
    	'list' => array(
    		'select'	=> '*',
    		'where'		=> 'published=1'
    	)
    );
}

class Article_Model extends ModelCommon
{
	/**
	 * Tablename
	 * @var string
	 */
	public $table = 'articles';
	
	/**
	 * Columns definition
	 * @var array
	 */
	public $col = array(
		
		/**
		 * @var array
		 */
		'id' => array(
			'type'		=> 'integer',
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'class' => array(
			'type'		=> 'varchar',
			'size'		=> 255,
		),
		
		/**
		 * @var array
		 */
		'title' => array(
			'type'		=> 'varchar',
			'size'		=> 255,
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'body' => array(
			'type'		=> 'text',
		),
		
		/**
		 * @var array
		 */
		'page_id' => array(
			'type'		=> 'integer',
		),
		
		/**
		 * @var array
		 */
		'sorted' => array(
			'type'		=> 'integer',
		),
		
		/**
		 * created
		 * @var array
		 */
		'created' => array(
			'type'		=> 'datetime',
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'modified' => array(
			'type'		=> 'datetime',
			'require'	=> true
		),
		
		/**
		 * @var array
		 */
		'published' => array(
			'type'		=> 'boolean',
			'require'	=> true
		),
    );
}
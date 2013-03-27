<?php

class HtmlDocument
{
	private $doc;
	private $doctype = '<!DOCTYPE html>';
	private $head;
	private $title = 'REDcms';
	private $base;
	private $body;
	private $styles = array();
	private $scripts = array();
	private $metatags = array();
	private $keywords = array();
	private $descriptions = array();
	
	public function __construct($baseUrl='./')
	{
		$this->doc = new DOMDocument('1.0', 'utf-8');
		$this->doc->preserveWhiteSpace = true;
		$this->head = $this->doc->createElement('head',"\n");
		$this->body = $this->doc->createElement('body',"\n");
		
		$this->base = $this->doc->createElement('base');
		$this->base->setAttribute('href',$baseUrl);
	}
	
	public function setBase($url)
	{
		$this->base->setAttribute('href',$baseUrl);		
	}
	
	public function addMetaTag($name, $content='')
	{
		$element = $this->doc->createElement('meta');
		$element->setAttribute('name',$name);
		$element->setAttribute('content',$content);
		$this->metatags[] = $element;
	}
	
	public function addStyleSheet($url, $media='all')
	{
		$element = $this->doc->createElement('link');
		$element->setAttribute('rel','stylesheet');
		$element->setAttribute('type','text/css');
		$element->setAttribute('href',$url);
		$element->setAttribute('media',$media);
		$this->styles[] = $element;
	}
	
	public function addScript($url)
	{
		$element = $this->doc->createElement('script');
		$element->setAttribute('language','JavaScript');
		$element->setAttribute('type','text/javascript');
		$element->setAttribute('src',$url);
		$this->scripts[] = $element;
	}
	
	public function addKeywords($keywords)
	{
		if(is_array($keywords))
		{
			$this->keywords = array_merge($this->keywords,$keywords);
		}
		else
		{
			$this->keywords[] = $keywords;
		}
	}
	
	public function addDescription($description)
	{
		if(is_array($description))
		{
			$this->descriptions = array_merge($this->$descriptions,$description);
		}
		else
		{
			$this->descriptions[] = $description;
		}		
	}
	
	public function setBody($source)
	{
		$fragment = $this->doc->createDocumentFragment();
		$fragment->appendXML($source);
		
		$this->body->appendChild($fragment);		
	}
	
	public function render()
	{
		/**
		 * <!DOCTYPE html>
		 * <html lang="de">
		 *   <head>
		 *     <meta charset="utf-8" />
		 *     <base href="/" />
		 *     <title>HTML5 Layout</title>
		 *     <meta name="language" content="de" />
		 *     <meta name="keywords" content="..." />
		 *     <meta name="description" content="..." />
		 *     <meta name="robots" content="index,follow" />
		 *     <meta name="creator" content="REDcms v1.0" />
		 *     <meta name="author" content="Enrico Reinsdorf" />
		 *     <link rel="stylesheet" href="css/main.css" type="text/css" />
		 *   </head>
		 *   <body>
		 *   ...
		 *   </body>
		 * </html>
		 */
		$this->head->appendChild($this->base); 
		
		$title = $this->doc->createElement('title', $this->title);
		$this->head->appendChild($title); 
		
		// Add keywords if needed
		$keywords = array_reverse($this->keywords);
		if ( is_array( $keywords ))
		{
			$keywords = implode(' ',$keywords);
		}
		$this->addMetaTag('keyword', $keywords );
		
		// Add descriptions if needed
		$description = array_reverse($this->descriptions);
		if ( is_array( $description ))
			foreach ( $description as $element )
				$this->addMetaTag('description', $element );
		
		// Add stylesheets if needed
		$metatags = array_reverse($this->metatags);
		if ( is_array( $metatags ))
			foreach ( $metatags as $element )
				$this->head->appendChild( $element );
		
		// Add stylesheets if needed
		$styles = array_reverse($this->styles);
		if ( is_array( $styles ))
			foreach ( $styles as $element )
				$this->head->appendChild( $element );
		
		// Add scripts if needed
		$scripts = array_reverse($this->scripts);
		if ( is_array( $scripts ))
			foreach ( $scripts as $element )
				$this->head->appendChild( $element );
		
		$html = $this->doc->createElement( 'html' );
		$html->setAttribute( 'lang', 'de' );
		$html->appendChild( $this->head );
		$html->appendChild( $this->body );
		
		$this->doc->appendChild($html);
		return $this->doctype . $this->doc->saveXML($html);
	}
}
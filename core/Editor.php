<?php

class Editor extends FCKeditor
{
	function __construct( $instanceName )
	{
		parent::__construct( $instanceName );
		
		$this->BasePath = BASEURL.'/fckeditor/';
		$this->ToolbarSet = 'REDcms';
		$this->Config["CustomConfigurationsPath"] = BASEURL."/templates/scripts/myEditorConfig.js";
		$this->Config['DefaultLanguage'] = 'de';
		
		$this->Height = 400;
		
		$this->Config['LinkBrowser'] = true;
		
		#$this->Config['LinkBrowserURL'] = '/REDcms/ckfinder/ckfinder.html';
		#$this->Config['ImageBrowserURL'] = '/REDcms/ckfinder/ckfinder.html?type=Images';
		#$this->Config['FlashBrowserURL'] = '/REDcms/ckfinder/ckfinder.html?type=Flash';
		
		#$this->Config['LinkUploadURL'] = '/REDcms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		#$this->Config['ImageUploadURL'] = '/REDcms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		#$this->Config['FlashUploadURL'] = '/REDcms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	}
	
	function __destruct(){}
}

?>
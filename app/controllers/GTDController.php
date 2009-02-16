<?php
class GTDController extends SiteController{
	
	function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "GTDView";
		}
		parent::__construct($view_class);
	}	
	function GTDAction() {
	//	echo 'a';	
		$this->_view->GTDOutput(1233);
		$this->_view->parse();
	}
}	
?>
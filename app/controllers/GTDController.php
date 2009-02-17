<?php
class GTDController extends SiteController{
	
	function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "GTDView";
		}
		parent::__construct($view_class);
	}	
	function GTDAction() {	
		$model = new GTDModel();
		$categories = $model->getRootCategories(1);
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$temp = $v_request->getKeys();		    	
		$this->_view->GTDOutput();
		print '<pre>';
		print_r($categories);
		print '</pre>';
		$this->_view->buildViewTreeCategories($categories);
		$this->_view->parse();
	}
	function GTDAddCategoryAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	
    	$model->addCategory(1,$request_keys['id'],$request_keys['CategoryName']);
    	$categories = $model->getRootCategories(1);
    	$this->_view->GTDOutput();
		$this->_view->buildViewTreeCategories($categories);
		$this->_view->parse();    	
    			
	}
}	
?>
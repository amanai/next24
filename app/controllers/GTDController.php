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
		$user_id = Project::getUser() -> getDbUser() -> id;
		$categories = $model->getRootCategories($user_id);
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
    	$user_id = Project::getUser() -> getDbUser() -> id;
    	$model->addCategory($user_id,$request_keys['id'],$request_keys['CategoryName']);
    	$categories = $model->getRootCategories($user_id);
    	$this->_view->GTDOutput();
		$this->_view->buildViewTreeCategories($categories);
		$this->_view->parse();    	 			
	}
	function GTDViewFoldersAction() {
		$model = new GTDModel();
		$folders = $model->getRootFolders(1);
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$temp = $v_request->getKeys();		    	
		$this->_view->GTDOutput();
		print '<pre>';
		print_r($folders);
		print '</pre>';
		$this->_view->buildViewTreeCategories($folders);
		$this->_view->parse();
	}
}	
?>
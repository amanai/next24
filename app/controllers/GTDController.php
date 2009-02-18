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
		$categories = $model->getRootCategory($user_id);		
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$temp = $v_request->getKeys();		    	
		$this->_view->GTDOutput();
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
    	$categories = $model->getRootCategory($user_id);
    	$this->_view->GTDOutput();
		$this->_view->buildViewTreeCategories($categories);
		$this->_view->parse();    	 			
	}
	function GTDAddFolderAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	
    	$user_id = Project::getUser() -> getDbUser() -> id;
    	$model->addFolder($request_keys['cid'],$request_keys['id'],$request_keys['FolderName']);
    	$folders = $model->getRootFolder($request_keys['cid']);
    	$category_name = $model->getCategoryName($request_keys['cid']); 
    	$this->_view->GTDOutputFolders($category_name);
		$this->_view->buildViewTreeFolders($folders);
		$this->_view->parse(); 		
	}
	function GTDViewFoldersAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();  	
    	$request_keys = $v_request->getKeys();			
		$folders = $model->getRootFolder($request_keys['cid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']); 	
		$this->_view->GTDOutputFolders($category_name,$request_keys['cid']);
		$this->_view->buildViewTreeFolders($folders);
		$this->_view->parse();
	}
	function GTDViewFilesAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	  	
		$files = $model->getFolderFiles($request_keys['fid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']);
		$folder_name = $model->getFolderName($request_keys['fid']); 	
		$this->_view->GTDOutputFiles($category_name,$folder_name,$request_keys['cid'],$request_keys['fid']);
		$this->_view->parse();    		
	}
}	
?>
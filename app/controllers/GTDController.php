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
    	$request_keys = $v_request->getKeys();		
		$users = $model->getUserList();  
		$this->_view->__set('users',$users);		    	
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
    	$category_name = $request_keys['CategoryName'];
    	if(HelpFunctions::isValidLogin($category_name)) {
    		$model->addCategory($user_id,$request_keys['id'],$category_name,$request_keys['secure']);
    	}	
    	$categories = $model->getRootCategory($user_id);
    	$users = $model->getUserList();  
		$this->_view->__set('users',$users);   	  
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
    	$folder_name = $request_keys['FolderName'];
    	if(HelpFunctions::isValidLogin($folder_name)) {
    		$model->addFolder($request_keys['cid'],$request_keys['id'],$folder_name,$request_keys['secure']);
    	}	
    	$folders = $model->getRootFolder($request_keys['cid']);
    	$category_name = $model->getCategoryName($request_keys['cid']); 
    	$users = $model->getUserList();    
		$this->_view->__set('users',$users);   	
    	$this->_view->GTDOutputFolders($category_name,$request_keys['cid']);   	
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
		$users = $model->getUserList();   
		$this->_view->__set('users',$users);
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
		$users = $model->getUserList();     
		$this->_view->__set('users',$users);		
		$this->_view->GTDOutputFiles($category_name,$folder_name,$request_keys['cid'],$request_keys['fid']);
		$this->_view->BuldTreeFilesView($files);	
		$this->_view->parse();    		
	}
	function GTDAddFileAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	  	  				
		$fname = $_FILES['FileName']['tmp_name'];
		$realfname = $_FILES['FileName']['name'];
		if(HelpFunctions::isValidUploadFilename($realfname)) {
			$path = 'app' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $request_keys['cid'] . DIRECTORY_SEPARATOR . $request_keys['fid'] . DIRECTORY_SEPARATOR .$realfname;
			if(!file_exists('app' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $request_keys['cid'])) {
				mkdir('app' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $request_keys['cid']);
			}
			if(!file_exists('app' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $request_keys['cid'] . DIRECTORY_SEPARATOR . $request_keys['fid'])) {
				mkdir('app' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $request_keys['cid'] . DIRECTORY_SEPARATOR . $request_keys['fid']);
			}	
			if(!file_exists($path)) {	
				move_uploaded_file($fname,$path);
				$dbpath = '#app#user_files#'.$request_keys['cid'].'#'.$request_keys['fid'].'#'.$realfname;
				$model->addFolderFile($request_keys['fid'],$realfname,$dbpath,$request_keys['secure']);
			}
		}	
		$files = $model->getFolderFiles($request_keys['fid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']);
		$folder_name = $model->getFolderName($request_keys['fid']); 
		$users = $model->getUserList();    
		$this->_view->__set('users',$users);				
		$this->_view->GTDOutputFiles($category_name,$folder_name,$request_keys['cid'],$request_keys['fid']);
		$this->_view->BuldTreeFilesView($files);		
		$this->_view->parse(); 		
	}
	public function GTDDeleteCategoryAction() {
		$model = new GTDModel();
		$user_id = Project::getUser() -> getDbUser() -> id;		
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	
		$model->deleteCategory($request_keys['cid']);
		$categories = $model->getRootCategory($user_id);   
		$users = $model->getUserList();  
		$this->_view->__set('users',$users);	   		    	
		$this->_view->GTDOutput();		
		$this->_view->buildViewTreeCategories($categories);
		$this->_view->parse(); 		
	}
	public function GTDDeleteFolderAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();  	
    	$request_keys = $v_request->getKeys();	
    	$model->deleteFolder($request_keys['fid']);		
		$folders = $model->getRootFolder($request_keys['cid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']); 
		$users = $model->getUserList();    	
		$this->_view->__set('users',$users);		
		$this->_view->GTDOutputFolders($category_name,$request_keys['cid']);		
		$this->_view->buildViewTreeFolders($folders);
		$this->_view->parse();		
	}
	public function GTDDeleteFileAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	
    	$model->deleteFile($request_keys['flid']);	  	
		$files = $model->getFolderFiles($request_keys['fid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']);
		$folder_name = $model->getFolderName($request_keys['fid']); 
		$users = $model->getUserList();    
		$this->_view->__set('users',$users);	
		$this->_view->BuldTreeFilesView($files);	
		$this->_view->GTDOutputFiles($category_name,$folder_name,$request_keys['cid'],$request_keys['fid']);		
		$this->_view->parse(); 		
	}
	public function GTDViewAnotherUserCategoriesAction() {
		$user_id = Project::getUser() -> getDbUser() -> id;
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();		
		if($user_id == $request_keys['usr']) {
			$this->GTDAction();
		}
		else {
			$model = new GTDModel();
			$categories = $model->getAnotherUserRootCategory($request_keys['usr']);	
    		$users = $model->getUserList();  
			$this->_view->__set('selected_user',$request_keys['usr']);
			$this->_view->__set('another_user',true);
			$this->_view->__set('users',$users);   	      	
    		$this->_view->buildAnotherUserViewTreeCategories($categories);    	
			$this->_view->GTDOutput();				
			$this->_view->parse(); 	
		}		
	}
	public function GTDViewAnotherUserFoldersAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();  	
    	$request_keys = $v_request->getKeys();			
		$folders = $model->getAnotherUserRootFolder($request_keys['cid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']); 	
		$users = $model->getUserList();
		$this->_view->__set('selected_user',$request_keys['usr']);
		$this->_view->__set('another_user',true);
		$this->_view->__set('users',$users);	
		$this->_view->GTDOutputFolders($category_name,$request_keys['cid']);		
		$this->_view->buildAnotherUserViewTreeFolders($folders);
		$this->_view->parse();		
	}
	public function GTDViewAnotherUserFilesAction() {
		$model = new GTDModel();
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();	  	
		$files = $model->getAnotherUserFolderFiles($request_keys['fid']);	   
		$category_name = $model->getCategoryName($request_keys['cid']);
		$folder_name = $model->getFolderName($request_keys['fid']);
		$users = $model->getUserList();   
//		print '<pre>';
//			print_r($request_keys);
//		print '</pre>';	
		$this->_view->__set('selected_user',$request_keys['usr']);
		$this->_view->__set('another_user',true);
		$this->_view->__set('users',$users);	
		$this->_view->BuldAnotherUserTreeFilesView($files);	
		$this->_view->GTDOutputFiles($category_name,$folder_name,$request_keys['cid'],$request_keys['fid']);	
		$this->_view->parse();   		
	}
	public function GTDAddSecureUserAction() {
		$model = new GTDModel();
		$user_id = Project::getUser() -> getDbUser() -> id;	
		$v_request = Project::getRequest();
    	$v_session = Project::getSession();
    	$request_keys = $v_request->getKeys();		 
		$model->addSecureUser($request_keys['id'],$request_keys['section'],$request_keys['addusr']);
		switch($request_keys['section']) {
			case 1:
				$this->GTDAction();
			break;
			case 2:
				$this->GTDViewFoldersAction();
			break;
			case 3:
				$this->GTDViewFilesAction();
			break;												    	
		}
	}
}	
?>
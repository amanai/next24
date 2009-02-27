<?php
class GroupsController extends SiteController{
	private $request;
	private $session;
	private $current_user_id;
	public function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "GroupsView";
		}
		parent::__construct($view_class);
		$this->request = Project::getRequest()->getKeys();
    	$this->session = Project::getSession()->getKeys();
    	$this->current_user_id = Project::getUser() -> getDbUser() -> id;		
	}	
	public function groupsViewAction() {	
	//	$model = new GTDModel();		 	    	
		$this->_view->groupsView();
		$this->_view->parse(); 
		
	}
	public function groupsCreateAction() {
  	 			
	}
	public function groupsAlterAction() {
		
	}
	public function groupsDeleteAction() {
		
	}
	public function subGroupViewAction() {
		
	}
	public function subGroupCreateAction() {
		
	}
	public function subGroupAlterAction() {
		
	}
	public function subGroupDeleteAction() {
		
	}
	public function topicViewAction() {
		
	}
	public function topicCreateAction() {
		
	}
	public function topicAlterAction() {
		
	}
	public function topicDeleteAction() {
		
	}
	public function messageCreateAction() {
		
	}
	public function messageAlterAction() {
		
	}
	public function messageDeleteAction() {
		
	}
	public function photoAlbumViewAction() {
		
	}
	public function photoAlbumCreateAction() {
		
	}
	public function photoAlbumAlterAction() {
		
	}
	public function photoAlbumDeleteAction() {
		
	}
	public function photoViewAction() {
		
	}
	public function photoCreateAction() {
		
	}
	public function photoAlterAction() {
		
	}
	public function photoDeleteAction() {
		
	}
}	
?>
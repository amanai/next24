<?php
class GroupsController extends SiteController{
	private $request;
	private $session;
	private $current_user_id;
	public function __construct(){
		$view_class = "GroupsView";
		parent::__construct($view_class);
		$this->request = Project::getRequest()->getKeys();
    	$this->session = Project::getSession()->getKeys();
    	$this->current_user_id = Project::getUser() -> getDbUser() -> id;		
	}	
	public function groupsViewAction() {	
		$model = new GroupsModel();
		$groups = $model->selectAllGroups();
		$this->_view->__set("groups",$groups);		
		$this->_view->__set("pid",0);	 	    	
		$this->_view->groupsView();
		$this->_view->parse(); 
		
	}
	public function groupsCreateAction() {
		$model = new GroupsModel();		
		$model->addGroup($this->request);	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'groupsView'));	   						 			
	}
	public function groupsAlterAction() {
		
	}
	public function groupsDeleteAction() {
		
	}
	public function subGroupViewAction() {
		$model = new GroupsModel();
		$sub_groups = $model->selectSubGroups($this->request['id']);	
		$this->_view->__set("sub_groups",$sub_groups);		
		$this->_view->__set("pid",$this->request['id']);	 	    	
		$this->_view->subGroupView();
		$this->_view->parse(); 		
	}
	public function subGroupCreateAction() {
		$model = new GroupsModel();
		$model->addSubGroup($this->request);	 	    	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'subGroupView').'/id:'.$this->request['pid']);	
	}
	public function subGroupAlterAction() {
		
	}
	public function subGroupDeleteAction() {
		
	}
	public function topicViewAction() {
		$model = new GroupsModel();
		$topics = $model->selectTopics($this->request['pid']);
		$this->_view->__set("tid",$this->request['tid']);
		$this->_view->__set("pid",$this->request['pid']);
		$this->_view->__set("topics",$topics);	
		$this->_view->topicsView();
		$this->_view->parse(); 			
	}
	public function topicCreateAction() {
		$model = new GroupsModel();
		$model->addTopics($this->request);	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'topicView').'/pid:'.$this->request['pid']);			
	}
	public function topicAlterAction() {
		
	}
	public function topicDeleteAction() {
		
	}
	public function messagesViewAction() {
		$model = new GroupsModel();
		$messages = $model->selectMessages($this->request['tid']);
		$this->_view->__set("tid",$this->request['tid']);
		$this->_view->__set("pid",$this->request['pid']);		
		$this->_view->__set("messages",$messages);	
		$this->_view->messagesView();
		$this->_view->parse();
		
	}
	public function messageCreateAction() {
		$model = new GroupsModel();
		$model->addMessage($this->request);
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'messagesView').'/pid:'.$this->request['pid'].'/tid:'.$this->request['tid']);
	}
	public function messageAlterAction() {
		if(!$this->request['alter']) {
			$model = new GroupsModel();
			$messages = $model->selectMessages($this->request['tid']);
			$this->_view->__set("tid",$this->request['tid']);
			$this->_view->__set("pid",$this->request['pid']);		
			$this->_view->__set("messages",$messages);
			$alter_message = $model->selectAlterMessage($this->request['tid'],$this->request['mid']);	
			$this->_view->__set("alter_message",$alter_message);	
			$this->_view->messagesView();
			$this->_view->parse();						
		}
		else {
			$model = new GroupsModel();
			$model->alterMessage($this->request);
			Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'messagesView').'/pid:'.$this->request['pid'].'/tid:'.$this->request['tid']);			
		}
	}
	public function messageDeleteAction() {
		$model = new GroupsModel();
		$model->deleteMessage($this->request['mid']);
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'messagesView').'/pid:'.$this->request['pid'].'/tid:'.$this->request['tid']);		
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
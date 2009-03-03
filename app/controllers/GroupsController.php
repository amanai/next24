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
		$user_list = $model->getUserList();
		$this->_view->__set("groups",$groups);		
		$this->_view->__set("pid",0);
		$this->_view->__set("user_list",$user_list);		 	    	
		$this->_view->groupsView();
		$this->_view->parse(); 
		
	}
	public function groupsCreateAction() {
		$model = new GroupsModel();		
		$model->addGroup($this->request);	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'groupsView'));	   						 			
	}
	public function groupsAlterAction() {
		if(!$this->request['alter']) {
			$model = new GroupsModel();
			$groups = $model->selectAllGroups();	
			$user_list = $model->getGroupUserList($this->request['id']); 
			$this->_view->__set("groups",$groups);		
			$this->_view->__set("pid",0);	
			$this->_view->__set("user_list",$user_list);
			$this->_view->__set("id",$this->request['id']);	    			
			$alter_group = $model->selectAlterGroup($this->request['id']);	
			$this->_view->__set("alter_group",$alter_group);	
			$this->_view->groupsView();
			$this->_view->parse();					
		}
		else {
			$model = new GroupsModel();
			$model->alterGroup($this->request);						
			Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'groupsView'));			
		}			
	}
	public function groupsDeleteAction() {
		$model = new GroupsModel();
		$model->deleteGroup($this->request['id']);	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'groupsView').'/id:'.$this->request['id']);		
	}
	public function subGroupViewAction() {
		$model = new GroupsModel();
		$sub_groups = $model->selectSubGroups($this->request['id']);
		$user_list = $model->getGroupUserList($this->request['id']); 
		$access_create = $model->checkAccessSubGroupCreate($this->request['id']); 	
		$this->_view->__set("user_list",$user_list);
		$this->_view->__set("sub_groups",$sub_groups);			
		$this->_view->__set("pid",$this->request['id']);
		$this->_view->__set("id",$this->request['id']);	
		$this->_view->__set("access_create",$access_create); 	    	
		$this->_view->subGroupView();
		$this->_view->parse(); 		
	}
	public function subGroupCreateAction() {
		$model = new GroupsModel();
		$model->addSubGroup($this->request);	   	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'subGroupView').'/id:'.$this->request['pid']);	
	}
	public function subGroupAlterAction() {
		if(!$this->request['alter']) {
			$model = new GroupsModel();
			$sub_groups = $model->selectSubGroups($this->request['id']);	
			$this->_view->__set("sub_groups",$sub_groups);		
			$this->_view->__set("pid",$this->request['id']);
			$this->_view->__set("id",$this->request['id']);	 	    			
			$alter_subgroup = $model->selectAlterSubGroup($this->request['pid']);	
			$this->_view->__set("alter_subgroup",$alter_subgroup);	
			$this->_view->subGroupView();
			$this->_view->parse(); 					
		}
		else {
			$model = new GroupsModel();
			$model->alterSubGroup($this->request);			
			Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'subGroupView').'/id:'.$this->request['id']);			
		}			
	}
	public function subGroupDeleteAction() {
		$model = new GroupsModel();
		$model->deleteSubGroup($this->request['pid']);	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'subGroupView').'/id:'.$this->request['id']);				
	}
	public function topicViewAction() {
		$model = new GroupsModel();
		$topics = $model->selectTopics($this->request['pid']);
		$access_mod = $model->checkAccessSubGroupMod($this->request['id'],$this->request['pid']);
		$this->_view->__set("id",$this->request['id']);
		$this->_view->__set("tid",$this->request['tid']);
		$this->_view->__set("pid",$this->request['pid']);
		$this->_view->__set("access_mod",$access_mod);
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
		if(!$this->request['alter']) {
			$model = new GroupsModel();
			$topics = $model->selectTopics($this->request['pid']);
			$this->_view->__set("tid",$this->request['tid']);
			$this->_view->__set("pid",$this->request['pid']);
			$this->_view->__set("topics",$topics);		
			$alter_topic = $model->selectAlterTopic($this->request['pid'],$this->request['tid']);	
			$this->_view->__set("alter_topic",$alter_topic);	
			$this->_view->topicsView();
			$this->_view->parse(); 						
		}
		else {
			$model = new GroupsModel();
			$model->alterTopic($this->request);
			Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'topicView').'/pid:'.$this->request['pid'].'/tid:'.$this->request['tid']);			
		}			
	}
	public function topicDeleteAction() {
		$model = new GroupsModel();
		$model->deleteTopic($this->request['tid']);	
		Project::getResponse()->redirect(Project::getRequest()->createUrl('Groups', 'topicView').'/pid:'.$this->request['pid']);			
	}
	public function messagesViewAction() {
		$model = new GroupsModel();
		$messages = $model->selectMessages($this->request['tid']);
		$access_mod_messages = $model->checkAccessMessagesMod($this->request['id'],$this->request['pid'],$this->request['tid']);
		$this->_view->__set("tid",$this->request['tid']);
		$this->_view->__set("pid",$this->request['pid']);
		$this->_view->__set("access_mod_messages",$access_mod_messages);		
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
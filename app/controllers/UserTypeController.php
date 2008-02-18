<?php
class UserTypeController extends AdminController{
	
	
		function __construct(){
			parent::__construct("AdminUserTypeView");
			
		}
		
		
		function ListAction(){
			$this -> BaseAdminData();
			$model = new UserTypeModel;
			$info = array();
			$info['group_list'] = $model -> loadAll();
			$info['edit_controller'] = null;
			$info['edit_action'] = 'Edit';
			$this -> _view -> GroupList($info);
			$this -> _view -> parse();
		}
		
		function EditAction(){
			$request = Project::getRequest();
			$this -> BaseAdminData();
			$model = new UserTypeModel;
			$data = $model -> load($request -> id);
			$this -> _view -> assign('group_info', $data);
			$this -> _view -> Edit();
			$this -> _view -> parse();
		}
		
}
?>
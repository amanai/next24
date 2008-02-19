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
			
			$info['right_controller'] = null;
			$info['right_action'] = 'Controllers';
			
			$this -> _view -> GroupList($info);
			$this -> _view -> parse();
		}
		
		function EditAction(){
			$request = Project::getRequest();
			$this -> BaseAdminData();
			$model = new UserTypeModel;
			$data = $model -> load($request -> id);
			$info = array();
			$info['edit_data'] = $data;
			$info['save_controller'] = null;
			$info['save_action'] = 'Save';
			$this -> _view -> AjaxEdit($info);
			$this -> _view -> ajax();
		}
		
		
		function SaveAction(){
			$request = Project::getRequest();
			$model = new UserTypeModel;
			$model -> load($request -> id);
			$do_save = true;
			if (!strlen(trim($request -> type_name))){
				$this -> _view -> clearFlashMessages();
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено название");
				$do_save = false;
			}
			
			if (!strlen(trim($request -> description))){
				$this -> _view -> clearFlashMessages();
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено описание");
				$do_save = false;
			}
			
			if ($do_save){
				$this -> _view -> clearFlashMessages();
				$model -> name = $request -> type_name;
				$model -> description = $request -> description;
				$id = $model -> save();
				$model = new UserTypeModel;
				$info = array();
				$info['group_list'] = $model -> loadAll();
				$info['edit_controller'] = null;
				$info['edit_action'] = 'Edit';
				$this -> _view -> AjaxGroupList($info);
			}
			$this -> _view -> ajax();
		}
		
		function ControllersAction(){
			$request = Project::getRequest();
			
			$group_model = new UserTypeModel;
			$group_data = $group_model -> load($request -> id);
			if (!count($group_data)){
				// Bad request:: group not exists
				return;
			}
			$info = array();
			$info['user_type_id'] = $request -> id;
			$controller_model = new ControllerModel;
			$info['controllers_list'] = $controller_model -> loadAll();
			$info['action_list_controller'] = null;
			$info['action_list_action'] = 'ActionList';
			
			$this -> _view -> AjaxControllerList($info);
			$this -> _view -> ajax();
		}
		
		function ActionListAction(){
			$request = Project::getRequest();
		
			$group_model = new UserTypeModel;
			$group_data = $group_model -> load($request -> gid);
			if (!count($group_data)){
				// Bad request:: group not exists
				return;
			}
			$controller_model = new ControllerModel;
			$controller_data = $controller_model -> load($request -> id);
			if (!count($controller_data)){
				// Bad request:: controller not exists
				return;
			}
			$action_model = new ActionModel;
			$list = $action_model -> getRightsByUserTypeController($request -> gid, $request -> id);
			$info = array();
			$info['user_type_id'] = $request -> gid;
			$info['controller_id'] = $request -> id;
			$info['actions_list'] = $list;
			$info['controllers_list'] = $controller_model -> loadAll();
			$info['change_access_controller'] = null;
			$info['change_access_action'] = 'ChangeAccess';
			$this -> _view -> AjaxActionList($info);
			$this -> _view -> ajax();
		}
		
		function ChangeAccessAction(){
			$request = Project::getRequest();
			
			$group_model = new UserTypeModel;
			$group_data = $group_model -> load($request -> gid);
			if (!count($group_data)){
				// Bad request:: group not exists
				return;
			}
			
			$controller_model = new ControllerModel;
			$controller_data = $controller_model -> load($request -> cid);
			if (!count($controller_data)){
				// Bad request:: controller not exists
				return;
			}
			
			$action_model = new ActionModel;
			$action_data = $action_model -> load($request -> id);
			if (!count($action_data)){
				// Bad request:: action not exists
				return;
			}
			
			$right_model = new UserRightModel;
			$right_data = $right_model -> loadByTypeControllerAction($request -> gid, $request -> cid, $request -> id);
			if (!count($right_data)){
				$right_model -> user_type_id = $request -> gid;
				$right_model -> controller_id = $request -> cid;
				$right_model -> action_id = $request -> id;
				$right_model -> access = 1;
			} else {
				$right_model -> access = 1 - (int)$right_model -> access;
			}
			$right_model -> save();
		}
}
?>
<?php
class AdminUserController extends AdminController{
	const USER_PER_PAGE = 20;
		
		
		function __construct(){
			parent::__construct("AdminUserView");
			
		}
		
		private function makeUserList(&$info){
			$request = Project::getRequest();
			$model = new UserModel;
			$pager = new DbPager($request -> pn, self::USER_PER_PAGE);
			$model -> setPager($pager);
			$info['user_list'] = $model -> loadPage();
			$info['list_pager'] = $model -> getPager();
			$info['list_controller'] = null;
			$info['list_action'] = 'List';
		}
	
		function ListAction(){
			$this -> BaseAdminData();
			$request = Project::getRequest();
			$info = array();
			$this -> makeUserList($info);
			
			$info['edit_controller'] = null;
			$info['edit_action'] = 'Edit';
			
			$this -> _view -> UserList($info);
			$this -> _view -> parse();
			
			
		}
		
		
		
		function EditAction(){
			
			
			$request = Project::getRequest();
			$this -> BaseAdminData();
			$model = new UserModel;
			$data = $model -> load($request -> id);
			$info = array();
			$info['edit_data'] = $data;
			$info['save_controller'] = null;
			$info['save_action'] = 'Save';
			
			$type_model = new UserTypeModel;
			
			$info['user_group_list'] = $type_model -> loadAll();
			
			$this -> _view -> AjaxEdit($info);
			$this -> _view -> ajax();
		}
		
		function SaveAction(){
			$request = Project::getRequest();
			$model = new UserModel;
			$model -> load($request -> id);
			$do_save = true;
			if (!strlen(trim($request -> login))){
				$this -> _view -> clearFlashMessages();
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено поле логин");
				$do_save = false;
			}
			if ($do_save){
				$this -> _view -> clearFlashMessages();
				$model -> login = $request -> login;
				$model -> user_type_id = $request -> user_group;
				$id = $model -> save();
				$model = new UserTypeModel;
				$info = array();
				$info['group_list'] = $model -> loadAll();
				$info['edit_controller'] = null;
				$info['edit_action'] = 'Edit';
				$this -> makeUserList($info);
				$this -> _view -> AjaxList($info);
			}
			$this -> _view -> ajax();
		}

		function DeleteAction(){
			die(__METHOD__);
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('AdminParameter', 'EditGroup', array('id' => $this -> controller_id)));
		}
		
		
}
?>
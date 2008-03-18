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
			foreach($info['user_list'] as &$item){
				$ban_model = new BanHistoryModel;
				if ($ban_model -> isBanned($item['id'])){
					$item['banned'] = 1;
					$item['banned_date'] = $ban_model -> banned_till;
				} else {
					$item['banned'] = 0;
				}
				
				
			}
		}
		
		function BanHistoryAction(){
			$request = Project::getRequest();
			$user_id = $request -> getKeyByNumber(0);
			$info = array();
			$ban_model = new BanHistoryModel;
			$info['ban_list'] = $ban_model -> loadUserHistory($user_id);
			
			$this -> _view -> BanHistoryList($info);
			$this -> _view -> parse();
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
			
			$ban_model = new BanHistoryModel;
			$info['banned'] = $ban_model -> isBanned($request -> id);
			if ($info['banned']){
				$info['banned_date'] = $ban_model -> banned_till;
			}
			$info['history_link'] = $request -> createUrl('AdminUser', 'BanHistory', array($request -> id));
			$this -> _view -> AjaxEdit($info);
			$this -> _view -> ajax();
		}
		
		function SaveAction(){
			$request = Project::getRequest();
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$model = new UserModel;
			$model -> load($request -> id);
			$do_save = true;
			$this -> _view -> clearFlashMessages();
			if (!strlen(trim($request -> login))){
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено поле логин");
				$do_save = false;
			}
			if ($request -> unbann){
				$ban_model = new BanHistoryModel;
				$ban_model -> unban($request -> id, $user_id);
			}
			if ($request -> bann){
				if (strlen($request -> warning)) {
					$ban_date = $request -> ban_date;
					if (strlen($ban_date) && (strtotime($ban_date) > time())) {
						$warning_model = new WarningModel;
						$warning_id = $warning_model -> add($request -> id, $request -> warning);
						$ban_model = new BanHistoryModel;
						$ban_model -> ban($request -> id, $user_id, $warning_id, $request -> ban_date);
					} else {
						$this -> _view -> addFlashMessage(FM::ERROR, "Неверная дата бана");
						$do_save = false;
					}
				} else {
					$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено предупреждение");
					$do_save = false;
				}
			}
			if ($do_save){
				$this -> _view -> clearFlashMessages();
				$model -> login = $request -> login;
				$model -> user_type_id = $request -> user_group;
				
				$ban_date = $request -> ban_date;
				if (strlen($ban_date)){
					//$ban_model = new Ban
				}
				
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
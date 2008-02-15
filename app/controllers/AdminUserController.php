<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AdminController.php');
require_once(UTILS_PATH . 'AjaxResponse.php');
require_once(UTILS_PATH . 'AjaxRequest.php');
class AdminUserController extends AdminController{
	const USER_PER_PAGE = 20;
		
		
		function BaseAdminData(){
			parent::BaseAdminData();
			$this -> view -> title = 'Пользователи';
		}
	
	
		function ListAction(){
			$this -> BaseAdminData();
			$router = getManager('CRouter');
			$this -> getUserList();
			/*if ($id > 0){
				$this -> view -> pager_params = array('id'=>$id);
			}*/
			
			
			$this -> setModel('User_types');
			$list = $this -> model -> loadAll();
			$this -> view -> content .= $this->view->render(VIEWS_PATH.'admin/users/list.tpl.php');
			$this -> view -> display();
			
			
			
			
		}
		
		
		
		function EditAction(){
			$id = (int)$this -> id;
			$response = new AjaxResponse();
			
			$response -> hide('edit_user');
			$response -> enable('users_list');
			$this -> view -> cancel_param = $response -> getResponse();
			$response -> clear();
			
			
			$this -> view -> save_param = AjaxRequest::getJsonParam('AdminUser', 'Save', array('id'=>$id, 'form_id' => 'edit_user_form'), "POST");
			$this -> setModel('Users');
			$this -> model -> setUtf8();
			$this -> model -> resetSql();
			$data = $this -> model -> getById($id);
			$this -> view -> edit_data = $data;
			
			//var_dump($data['login'], mb_detect_encoding($data['login']));die;
			
			$this -> setModel('User_types');
			$list = $this -> model -> loadAll();
			$this -> view -> user_group_list = $list;
			
			$response -> hide('user_list');
			$response -> block('edit_user', true, $this -> view -> ajaxRender(VIEWS_PATH.'admin/users/edit.tpl.php'));
			$response -> disable('users_list');
			$this -> view -> response($response);
		}
		
		function SaveAction(){
			$router = getManager('CRouter');
			$id = (int)$this -> id;
			$this -> setModel('Users');
			$this -> model -> resetSql();
			$data = $this -> model -> getById($id);
			$data['login'] = $this -> login;
			$data['user_type_id'] = (int)$this -> user_group;
			
			$this -> model -> setData($data, true);
			
			$this -> model -> save();
			
			// RESPONSE HERE
			$response = new AjaxResponse();
			$response -> hide('edit_user');
			$response -> enable('users_list');
			$this -> view -> cancel_param = $response -> getResponse();
			$response -> clear();
			
			
			$this -> getUserList();
			
			$response -> hide('edit_user');
			$response -> enable('users_list');
			$response -> block('users_list', true, $this -> view -> ajaxRender(VIEWS_PATH.'admin/users/user_list_ajax.tpl.php'));
			$this -> view -> response($response);
			/*$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('AdminParameter', 'EditGroup', array('id' => $this -> controller_id)));*/
		}
		
		private function getUserList(){
			$router = getManager('CRouter');
			$this -> setModel("Users");
			$this -> model -> resetSql();
			$number = self::USER_PER_PAGE;
			$this -> model -> limit($number, (int)$this -> pn*$number);
			$this -> model -> pager();
			$this -> model -> cols('users.*, user_types.name as group_name');
			$this -> model -> join('user_types', 'user_types.id=users.user_type_id', 'LEFT');
			$list = $this -> model -> getAll();
			foreach ($list as &$item){
				$item['delete_link'] = $router->createUrl('AdminUser', 'Delete', array('id' => $item['id']));
				$item['edit_link'] = AjaxRequest::getJsonParam('AdminUser', 'Edit', array('id'=>$item['id']));
			}
			$this -> view -> user_list = $list;
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			$this -> view -> current_controller = 'AdminUser';
			$this -> view -> current_action = 'List';
		}
		
		function DeleteAction(){
			die(__METHOD__);
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('AdminParameter', 'EditGroup', array('id' => $this -> controller_id)));
		}
		
		
}
?>
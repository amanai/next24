<?php
/**
 * Контролер администрирования системы
 */
	class AdminController extends CBaseController{


		function __construct(){
			parent::__construct("AdminView");
		}

		protected function BaseAdminData(){
			//$router = getManager('CRouter');
			$router = Project::getRequest();
			// TODO:: hardcoded menu
			$this -> _view -> assign('main_menu', array(
														array('link'=>$router -> createUrl('Admin', 'Desktop'), 'name'=>'Рабочий стол'),
														array('link'=>$router -> createUrl('AdminParameter', 'GroupList'), 'name'=>'Параметры системы'),
														array('link'=>$router -> createUrl('AdminUser', 'List'), 'name'=>'Пользователи'),
														));

			$this -> _view -> assign('title', $this -> _action_model -> page_title);
			//$session = getManager('CSession');
			// TODO:: read logged user information
		}


		public function DesktopAction(){
			$this -> BaseAdminData();
			// TODO:: get title from database
			$this -> _view -> Desktop();
			$this -> _view -> parse();
		}
		
		



		public function LoginFormAction(){
			//$session = getManager('CSession');
			$session = getManager('session');
			$user = unserialize($session->read('user'));
			if (is_array($user) && isset($user['id']) && ((int)$user['id'] > 0)){
				// User already logged -> redirect to home page of administration
				$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			}
			//$this -> view -> login_result = "";
			$this -> view -> setTemplate(VIEWS_PATH.'admin/login.tpl.php');
			$this->view->display();
		}


		public function LoginAction(){

			//$session = getManager('CSession');
			$session = getManager('session');
			$user = unserialize($session->read('user'));
			if (is_array($user) && isset($user['id']) && ((int)$user['id'] > 0)){
				// User already logged -> redirect to home page of administration
				//$router = getManager('CRouter');
				$router = getManager('router');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			} elseif (!$this -> u_login || !$this -> u_pass) {
				$router = getManager('router');
				//$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Admin', 'LoginForm'));
			}

			$this -> setModel("Users");
			$login_result = $this -> model -> login($this -> u_login, $this -> u_pass);
//var_dump($login_result);die;
			if ($login_result === false){
				$this -> view -> login_result = false;
			} else {
				//$user = getManager('CUser');
				$user = getManager('user');
				// TODO:: Бред какой-то получается!!!
				$user -> login($this -> u_login, $this -> u_pass);
				//$router = getManager('CRouter');
				$router = getManager('router');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			}



			$request_user_id = (int)$this -> id;

			$this -> view -> setTemplate(VIEWS_PATH.'admin/login.tpl.php');
			$this->view->display();
		}

		public function LogoutAction(){
			$user = getManager('CUser');
			$user -> logout();
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Admin', 'LoginForm'));
		}

	}
?>
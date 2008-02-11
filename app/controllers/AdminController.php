<?php
/**
 * Контролер администрирования системы
 */
	class AdminController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			parent::__construct($View, $params, $vars);
			$this -> view -> setTemplate(VIEWS_PATH.'admin/main.tpl.php');
		}
		
		protected function BaseAdminData(){
			// TODO:: hardcoded menu
			$this -> view -> main_menu = array(
												array('link'=>'#', 'name'=>'Каталог сложных опросов'),
												array('link'=>'#', 'name'=>'Каталог лент новостей'),
												array('link'=>'#', 'name'=>'Блоги пользователей'),
												array('link'=>'#', 'name'=>'Дневники пользователей'),
												);
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
		}
		
		
		public function DesktopAction(){
			$this -> BaseAdminData();
			$this -> view -> content .= $this->view->render(VIEWS_PATH.'admin/desktop.tpl.php');
			$this -> view -> display();
		}
		
		
		
		public function LoginFormAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			if (is_array($user) && isset($user['id']) && ((int)$user['id'] > 0)){
				// User already logged -> redirect to home page of administration
				$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			}
			
			$this -> view -> setTemplate(VIEWS_PATH.'admin/login.tpl.php');
			$this->view->display();
		}
		
		
		public function LoginAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			if (is_array($user) && isset($user['id']) && ((int)$user['id'] > 0)){
				// User already logged -> redirect to home page of administration
				$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			}
			
			$this -> setModel("Users");
			$login_result = $this -> model -> login($this -> u_login, $this -> u_pass);
			
			if ($login_result === false){
				$this -> view -> login_result = false;
			} else {
				$user = getManager('CUser');
				// TODO:: Бред какой-то получается!!!
				$user -> login($this -> u_login, $this -> u_pass);
				$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			}
			
			
			
			$request_user_id = (int)$this -> id;
			
			$this -> view -> setTemplate(VIEWS_PATH.'admin/login.tpl.php');
			$this->view->display();
		}
		
		public function LogoutAction(){
			$session = getManager('CSession');
			$session -> write('user', null);
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Admin', 'LoginForm'));
		}

	}
?>
<?php
/**
 * Контролер администрирования системы
 */
	class AdminController extends CBaseController{


		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "AdminView";
			}
			parent::__construct($view_class);
		}

		protected function BaseAdminData(){
			$router = Project::getRequest();
			// TODO:: hardcoded menu
			$this -> _view -> assign('main_menu', array(
														array('link'=>$router -> createUrl('Admin', 'Desktop'), 'name'=>'Рабочий стол'),
														array('link'=>$router -> createUrl('AdminParameter', 'GroupList'), 'name'=>'Параметры системы'),
														array('link'=>$router -> createUrl('AdminUser', 'List'), 'name'=>'Пользователи'),
														array('link'=>$router -> createUrl('UserType', 'List'), 'name'=>'Группы и права доступа'),
														array('link'=>$router -> createUrl('BlogAdmin', 'CatalogList'), 'name'=>'Блоги'),
														array('link'=>$router -> createUrl('AdminQuestionAnswer', 'Index'), 'name'=>'Вопросы-ответы'),
														array('link'=>$router -> createUrl('AdminQuestionAnswer', 'Index'), 'name'=>'Вопросы-ответы'),
														array('link'=>$router -> createUrl('AdminArticle', 'ShowTree'), 'name'=>'Статьи')
														));

			$this -> _view -> assign('title', $this -> _action_model -> page_title);
			$this -> _view -> assign('current_user', Project::getUser() -> getDbUser());
			// TODO:: read logged user information
		}


		public function DesktopAction(){
			$this -> BaseAdminData();
			// TODO:: get title from database
			$this -> _view -> Desktop();
			$this -> _view -> parse();
		}
		
		public function LoginFormAction(){
			/*
			$session = getManager('session');
			$user = unserialize($session->read('user'));
			if (is_array($user) && isset($user['id']) && ((int)$user['id'] > 0)){
				// User already logged -> redirect to home page of administration
				$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Admin', 'Desktop'));
			}
			*/
			//$this -> view -> login_result = "";
			
			$this -> _view -> Login();
			$this -> _view -> parse();
		}


		public function LoginAction(){
			$request = Project::getRequest();
			if (Project::getSecurityManager() -> login($request -> u_login, $request -> u_pass)){
				Project::getResponse() -> redirect($this -> getDefaultUrl());
			} else {
				$this -> _view -> assign('login_result', false);
				$this -> _view -> Login();
				$this -> _view -> parse();
			}
		}

		public function LogoutAction(){
			Project::getSecurityManager() -> logout();
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl(null, 'LoginForm'));
		}
		
		
		public function UserTypeAction(){
		}

	}
?>
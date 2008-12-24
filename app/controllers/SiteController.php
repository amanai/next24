<?php
/**
 * Base cobtroller for frontend controller
 */
	class SiteController extends CBaseController{
		private $_initialized=false;

		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "SiteView";
			}
			parent::__construct($view_class);
			$this->BaseSiteData();
		}

		protected function BaseSiteData(){
			if (!$this->_initialized) {
				//$this -> _view -> assign('title', $this -> _action_model -> page_title);
				$this -> _view -> assign('current_user', Project::getUser() -> getDbUser());
				
				if ((int)Project::getUser() -> getDbUser() -> id > 0){
					$this -> _view -> assign('is_logged', true);
				} else {
					$this -> _view -> assign('is_logged', false);
				}
				$this->_initialized=true;
			}
			// TODO:: read logged user information
		}

		public function HomeAction(){
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
		
		protected function checkOfficeAccess() {
			if (!Project::getUser() -> isMyArea()) Project::getResponse() -> redirect(Project::getRequest() -> createUrl("User", "Profile"));
		}
		
		public function UserTypeAction(){
		}

	}
?>
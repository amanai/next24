<?php
	class UserController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this->setModel("Users");
			parent::__construct($View, $params, $vars);
		}				
		
		public function LoginAction(){
			$userManager = getManager('CUser');
			$userManager->login($this->params['login'], $this->params['pass']);
			$router = getManager('CRouter');			
			$router->redirect($this->params['lastPath']);
		}
		
		public function LogoutAction(){
			$userManager = getManager('CUser');
			$userManager->logout();
			$router = getManager('CRouter');
			$router->redirect($router->createUrl());
		}
		
	}
?>
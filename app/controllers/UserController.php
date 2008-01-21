<?php
	class UserController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this->setModel("Users");
			parent::__construct($View, $params, $vars);
		}				
		
		public function ViewprofileAction(){
			$this->view->userData['birth_date_formatted'] = strftime("%d.%m.%Y", strtotime($this->view->userData['birth_date']));
			$this->view->userData['registration_date_formatted'] = strftime("%d.%m.%Y", strtotime($this->view->userData['registration_date']));
			$this->view->userData['gender_formatted'] = 'мужской';
			if($this->view->userData['gender_formatted'] == 1) $this->view->userData['gender_formatted'] = 'женский';
			$this->view->userData['interests'] = $this->model->getInterests($this->view->userData['id']);
			
			
			$this->model->set("userData", $this->view->userData);
			$this->view->content .= $this->view->render(VIEWS_PATH.'user/view_profile.tpl.php');
			$this->view->display();			
		}
		
		public function PhotoAlbumAction(){
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'user/view_photoalbum.tpl.php');
			$this->view->display();			
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
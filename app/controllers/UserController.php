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
			if($this->view->userData['gender'] == 1) $this->view->userData['gender_formatted'] = 'женский';
			
			
			$this->model->set("userData", $this->view->userData);
			$this->view->content .= $this->view->render(VIEWS_PATH.'user/view_profile.tpl.php');
			$this->view->display();			
		}
		
		public function EditprofileAction(){
			$this->view->userData['birth_day'] = strftime("%d", strtotime($this->view->userData['birth_date']));
			$this->view->userData['birth_month'][strftime("%m", strtotime($this->view->userData['birth_date']))] = 'selected="selected"';
			$this->view->userData['birth_year'] = strftime("%Y", strtotime($this->view->userData['birth_date']));			
			
			
			$this->view->userData['gender_formatted'][$this->view->userData['gender']] = 'checked="checked"';

			$this->setModel("Countries");
			$this->model->resetSql();
			$this->view->userData['countries'] = $this->model->getAll();
			$this->setModel("Users");				
			$this->model->set("userData", $this->view->userData);
			$this->view->content .= $this->view->render(VIEWS_PATH.'user/edit_profile.tpl.php');
			$this->view->display();				
		}
		
		public function SaveprofileAction(){
			$this->model->load($this->view->userData['id']);
			$this->model->set("email", $this->params['email']);
			$this->model->set("last_name", $this->params['last_name']);
			$this->model->set("first_name", $this->params['first_name']);
			$this->model->set("middle_name", $this->params['middle_name']);
			$this->model->set("birth_date", $this->params['birth_year'].'-'.$this->params['birth_month'].'-'.$this->params['birth_day']);
			$this->model->set("country_id", $this->params['country_id']);
			$this->model->set("city", ucfirst($this->params['city']));
			$this->model->set("gender", $this->params['gender']);
			$this->model->set("about", $this->params['about']);
			$this->model->set("interest", $this->params['interest']);
			$this->model->update();

			$this->model->resetSql();			
			$this->model->where('users.id="'.$this->view->userData['id'].'"');
			$this->model->join('user_types', "user_types.id=users.user_type_id");
			$userData = $this->model->getOne();
	
			$session = getManager('CSession');
			$userData = $session->write('user', serialize($userData));
			
			$router = getManager('CRouter');
			$router->redirect($router->createUrl("User", "Viewprofile"));
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
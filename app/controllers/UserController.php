<?php
	class UserController extends SiteController{
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "UserView";
			}
			parent::__construct($view_class);
		}
		
	  // -- BaseSiteData - определяет набор закладок, доступных на странице
		protected function _BaseSiteData(&$data) {
			$data['tab_list_name']     = "Каталог закладок";
			$data['tab_most_visit']    = "Самые посещаемые";
			$data['tab_my_list_name']  = "Мои закладки";
			$data['tab_add_bookmark']  = "Добавить закладку";
	    	$data['tab_category_edit'] = "Категория";
			parent::BaseSiteData();
		}			
		
		static public function getProfileUrl($username){
			return Project::getRequest() -> createUrl('User', 'Profile', null, $username);
		}
		
		function FillEditParams(&$info){
			$info['year_list'] = array();
			for($i = 1945; $i < 2000; $i++){
				$info['year_list'][$i] = array('id'=>$i, 'value'=>$i);
			}
			
			$info['month_list'] = array();
			for($i = 1; $i < 12; $i++){
				$info['month_list'][$i] = array('id'=>$i, 'value'=>iconv("cp1251", "UTF-8", strftime("%B", mktime(0, 0, 0, $i  , 1, 2008))));
			}
			
			$info['day_list'] = array();
			for($i = 1; $i < 31; $i++){
				$info['day_list'][] = array('id'=>$i, 'value'=>$i);
			}
			
			$country_model = new CountryModel;
			$info['country_list'] = $country_model -> loadAll();
			foreach ($info['country_list'] as &$item) {
				$item['change_country_param'] = AjaxRequest::getJsonParam("User", "ChangeCountry", array($item['id']));
			}
		}
		
		function CheckLoginAction(){
			die("!!!!");
		}
		
		function RegistrationFormAction(){			
			$request = Project::getRequest();
			
			$info = array();
			$info['save_url'] = $request -> createUrl('User', 'Registration');
			$info['validate_param'] = AjaxRequest::getJsonParam('User', 'ValidateRegistration', array('form_id' => 'register_form'), "POST");
			$info['save_param'] = AjaxRequest::getJsonParam('User', 'Registration', array('form_id' => 'register_form'), "POST");

			$this -> FillEditParams($info);
			$this -> _view -> RegistrationForm($info);
			$this -> _view -> parse();
		}
		
		function ValidateRegistrationAction($ajax = true){
			$this -> _view -> clearFlashMessages();
			$request = Project::getRequest();
			$valid = true;
			if (!$request -> login){
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено поле логин");
				$valid = false;
			} else {
				$user_model = new UserModel;
				$user_model -> loadByLogin($request -> login);
				if ($user_model -> id > 0){
					$this -> _view -> addFlashMessage(FM::ERROR, "Логин занят");
					$valid = false;
				}
			}
			
			if (!$request -> pwd){
				$this -> _view -> addFlashMessage(FM::ERROR, "Пароль не заполнен");
				$valid = false;
			}
			if (!$request -> pwd_repeat){
				$this -> _view -> addFlashMessage(FM::ERROR, "Требуется подтверждение пароля");
				$valid = false;
			}
			if ($request -> pwd && $request -> pwd_repeat){
				if ($request -> pwd != $request -> pwd_repeat){
					$this -> _view -> addFlashMessage(FM::ERROR, "Пароль и подтверждение не совпадают");
					$valid = false;
				} else {
					if (strlen($request -> pwd) < 5){
						$this -> _view -> addFlashMessage(FM::ERROR, "Пароль слишком короткий (нужно минимум 5 символов)");
					}
				}
			}
			
			if (!$request -> email){
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено поле email");
				$valid = false;
			} else {
				$user_model = new UserModel;
				$user_model -> loadByEmail($request -> email);
				if ($user_model -> id > 0){
					$this -> _view -> addFlashMessage(FM::ERROR, "Email занят");
					$valid = false;
				} else {
					$is_ok = preg_match('/^[\.\-_A-Za-z0-9]+?@[\.\-A-Za-z0-9]+?\.[A-Za-z0-9]{2,6}$/', $request -> email);
					if (!$is_ok){
						$this -> _view -> addFlashMessage(FM::ERROR, "Email неверный");
						$valid = false;
					}
				}
			}
			if ($ajax === true){
				$this -> _view -> ajax();
			}
			return $valid;
		}
		
		function RegistrationAction(){
			if ($this -> ValidateRegistrationAction(true)){
				$request = Project::getRequest();
				$user_model = new UserModel;
				$user_model -> login = $request -> login;
				$user_model -> salt = AppCrypt::generateSalt();
				$user_model -> pass = AppCrypt::getHash($request -> pwd, $user_model -> salt);
				$user_model -> email = $request -> email;
				$user_model -> first_name = $request -> name;
				$user_model -> last_name = $request -> surname;
				$user_model -> middle_name = $request -> father_name;
				$user_model -> birth_date = $request -> year . "-" . $request -> month . "-" . $request -> day;
				$user_model -> gender = (int)$request -> gender;
				$user_model -> about = $request -> about;
				$user_model -> country_id = (int)$request -> country;
				$user_model -> state_id = (int)$request -> state;
				$user_model -> city_id = (int)$request -> city;
				$user_model -> user_type_id = UserTypeModel::UNREGISTRED;
				$user_model -> reputation = 0;
				$user_model -> nextmoney = 0;
				$user_model -> registration_date = date("Y-m-d H:i:s");
				$user_model -> banned = 0;
				$user_id = (int)$user_model -> save();
				
				$separator = ";";
				if ($user_id <= 0) {
					$this -> _view -> addFlashMessage(FM::ERROR, "Ошибка регистрации!");
					$this -> _view -> ajax();
					return;
				}
				$this -> sendActivationMail($user_model, $request -> pwd);
				if (strlen($request -> interest)){
					$interest_list = explode($separator, $request -> interest);
					foreach($interest_list as $interest){
						if (strlen($interest)){
							$interest_model = new InterestModel;
							$interest_id = $interest_model -> set($interest);
							$user_interest_model = new UserInterestModel;
							$user_interest_model -> set($user_id, $interest_id);
						}
					}
				}
				Project::getAjaxResponse() -> location("User", "CompleteRegistration");
				$this -> _view -> ajax();
				
			}
		}
		
		function CompleteRegistrationAction(){
			$this -> _view -> CompleteRegistration();
			$this -> _view -> parse();
		}
		
		function sendActivationMail(UserModel $user_model, $password = null){
			if (!Project::isLocalhost()){
				$request = Project::getRequest();
				$mailer = new PHPMailer();
				$view = new MailTemplateView;
				$info = array();
				
				$info['login_name'] = $user_model -> login;
				$info['password'] = $password;
				$info['registration_url'] = $request -> createUrl('User', 'RegistrationForm');
				$info['activation_url'] = $request -> createUrl('User', 'Activation', array($user_model -> getActivationCode()));
				$info['support_email'] = $this -> getParam('support_mail');
				$view -> Activation($info);
				$bResult = $mailer -> sendMail($user_model -> email, 
										      $user_model -> last_name . " " . $user_model -> first_name . " " . $user_model -> middle_name, 
											  "Активация учетной записи Next24.ru", 
											  $view -> parse() 
											 );
			}
		}
		
		
		
		function ActivationAction(){
			$request = Project::getRequest();
			$act_code = $request -> getKeyByNumber(0);
			$user_model = new UserModel();
			$user_model -> loadByActivationCode($act_code, UserTypeModel::UNREGISTRED);
			$info = array();
			if ($user_model -> id > 0){
				$user_model -> user_type_id = UserTypeModel::REGISTRED;
				$user_model -> save();
				$info['activated'] = true;
			} else {
				$info['activated'] = false;
			}
			$this -> _view -> Activation($info);
			$this -> _view -> parse();
		}
		
		function ChangeCountryAction(){
			$request = Project::getRequest();
			$country_id = $request -> getKeyByNumber(0);
			$info = array();
			$state_model = new StateModel();
			$info['state_list'] = $state_model -> loadByCountry($country_id);
			$item['change_empty_state_param'] = AjaxRequest::getJsonParam("User", "ChangeState", array(0));
			foreach ($info['state_list'] as &$item) {
				$item['change_state_param'] = AjaxRequest::getJsonParam("User", "ChangeState", array($item['id']));
			}
			$this -> _view -> ChangeCountry($info);
			$this -> _view -> ajax();
		}
		
		function ChangeStateAction(){
			$request = Project::getRequest();
			$state_id = $request -> getKeyByNumber(0);
			$info = array();
			$state_model = new CityModel();
			$info['city_list'] = $state_model -> loadByState($state_id);
			$this -> _view -> ChangeState($info);
			$this -> _view -> ajax();
		}
		
		function ProfileEditAction(){
			$info = array();
			$this -> BaseSiteData();
			$user_model = Project::getUser() -> getDbUser();
			$user_model -> year = date("Y", strtotime($user_model -> birth_date));
			$user_model -> month = date("m", strtotime($user_model -> birth_date));
			$user_model -> day = date("d", strtotime($user_model -> birth_date));
			$info['user_model'] = $user_model;
			$this -> FillEditParams($info);
			$this -> _view -> ProfileEdit($info);
			$this -> _view -> parse();
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
			$request = Project::getRequest();
			$res = Project::getSecurityManager() -> login($request -> login, $request -> pass);
			if ($res){
				Project::getResponse() -> redirect(Project::getRequest() -> createUrl('User', 'Profile', null, $request -> login));
			} else {
				$this -> _view -> assign('login_result', false);
				$this -> _view -> Login();
				$this -> _view -> parse();
			}
			
		}
		
		public function ProfileAction(){
			$info = array();
			$user = Project::getUser() -> getShowedUser();
			$this -> BaseSiteData();
			$friend_model = new FriendModel;
			$info['friend_list'] = $friend_model -> getFriends($user -> id);
			$info['in_friend_list'] = $friend_model -> getInFriends($user -> id);
			
			$info['user_profile'] = $user -> data();
			$info['tab_list'] = TabController::getOwnTabs(true);
			$this -> _view -> Profile($info);
			$this -> _view -> parse();
			/*$this->view->userData['birth_date_formatted'] = strftime("%d.%m.%Y", strtotime($this->view->userData['birth_date']));
			$this->view->userData['registration_date_formatted'] = strftime("%d.%m.%Y", strtotime($this->view->userData['registration_date']));
			$this->view->userData['gender_formatted'] = 'мужской';
			if($this->view->userData['gender'] == 1) $this->view->userData['gender_formatted'] = 'женский';
			
			
			$this->model->set("userData", $this->view->userData);
			$this->view->content .= $this->view->render(VIEWS_PATH.'user/view_profile.tpl.php');
			$this->view->display();*/
		}
		
		public function LogoutAction(){
			Project::getSecurityManager() -> logout();
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl('Index', 'Index', null, false));
		}
		
	}
?>
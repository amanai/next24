<?php
	class UserController extends SiteController{
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "UserView";
			}
			parent::__construct($view_class);
		}		
		
		static public function getProfileUrl($username){
			return Project::getRequest() -> createUrl('User', 'Profile', null, $username);
		}
		
		function FillEditParams(){
			$request = Project::getRequest();
			
			$info=array();
			$info['year_list'] = array();
			for($i = date('Y')-100; $i < date('Y')-8; $i++){
				$info['year_list'][$i] = array('id'=>$i, 'value'=>$i);
			}
			
			$info['month_list'] = array();
			for($i = 0; $i < 12; $i++){
				$info['month_list'][$i] = array('id'=>$i, 'value'=>iconv("cp1251", "UTF-8", strftime("%B", mktime(0, 0, 0, $i  , 1, 2008))));
			}
			
			$info['day_list'] = array();
			for($i = 1; $i < 31; $i++){
				$info['day_list'][] = array('id'=>$i, 'value'=>$i);
			}
			
			$country_model = new CountryModel;
			$info['country_list'] = $country_model -> loadAll();
			$info['change_country_param'] = AjaxRequest::getJsonParam("User", "ChangeCountry", array('#id#'));
			
			if ($request->country) {
				$state_model = new StateModel();
				$info['state_list'] = $state_model -> loadByCountry($request->country);
				$info['change_state_param'] = AjaxRequest::getJsonParam("User", "ChangeState", array('#id#'));
			}
			
			if ($request->state) {
				$city_model = new CityModel();
				$info['city_list'] = $city_model -> loadByState($request->state);
			}
			
			//foreach ($info['country_list'] as &$item) {
			//	$item['change_country_param'] = AjaxRequest::getJsonParam("User", "ChangeCountry", array($item['id']));
			//}
			
			$this->_view->set($info);
		}
		
		function RegistrationFormAction(){
			if (!$this -> _view ->is_logged) {
				$mailer = new PHPMailer();
				$this-> _view -> assign('tab_list', TabController::getRegistrationTabs(true)); // Show tabs
				$this-> _view -> assign('check_login', AjaxRequest::getJsonParam("User", "CheckLogin"));
				$this-> _view -> assign('check_email', AjaxRequest::getJsonParam("User", "CheckEmail"));
				
				$this -> FillEditParams();
				$this -> _view -> RegistrationForm();
				$this -> _view -> parse();
			} else {
				Project::getResponse()->redirect(Project::getRequest()->createUrl('Index', 'Index'));
			}
		}
		
		function ValidateRegistrationAction(){
			$this -> _view -> clearFlashMessages();
			$request = Project::getRequest();
			$valid = true;
			

			$res=$this->checkLogin($request->login);
			if ($res['error']) {
				$this -> _view -> addFlashMessage(FM::ERROR, $res['message']);
				$this -> _view ->assign('login_error', true);
				$valid = false;
			}
			$res=$this->checkEmail($request->email);
			if ($res['error']) {
				$this -> _view -> addFlashMessage(FM::ERROR, $res['message']);
				$this -> _view ->assign('email_error', true);
				$valid = false;
			}
			
			if (!$request -> pwd){
				$this -> _view -> addFlashMessage(FM::ERROR, "Не заполнено поле пароль");
				$this -> _view -> assign('pass_error', true);
				$valid = false;
			} elseif (!HelpFunctions::isValidPassword($request -> pwd)) {
				$this -> _view -> addFlashMessage(FM::ERROR, "Пароль слишком короткий или содержит недопустимые символы");
				$this -> _view -> assign('pass_error', true);
				$valid = false;				
			} 
			if (!$request -> pwd_repeat){
				$this -> _view -> addFlashMessage(FM::ERROR, "Требуется подтверждение пароля");
				$this -> _view -> assign('pass_error', true);
				$valid = false;
			}
			if ($request -> pwd && $request -> pwd_repeat){
				if ($request -> pwd != $request -> pwd_repeat){
					$this -> _view -> addFlashMessage(FM::ERROR, "Пароль и подтверждение не совпадают");
					$this -> _view -> assign('pass_error', true);
					$valid = false;
				} else {
					if (strlen($request -> pwd) < 5){
						$this -> _view -> addFlashMessage(FM::ERROR, "Пароль слишком короткий (нужно минимум 5 символов)");
						$this -> _view ->assign('pass_error', true);
					}
				}
			}
			
			if (!$request->captcha) {
				$this -> _view -> addFlashMessage(FM::ERROR, "Вы должны ввести текст, который вы видите на картинке");
				$this -> _view -> assign('captcha_error', true);
				$valid = false;
			} elseif (!HelpFunctions::isValidCaptcha($request -> captcha)) {
				$this -> _view -> addFlashMessage(FM::ERROR, "Текст на картинке введен неверно, повторите еще раз");
				$this -> _view -> assign('captcha_error', true);
				$valid = false;				
			}
			
			return $valid;
		}
		
		function ValidateSaveAction(){
			$this -> _view -> clearFlashMessages();
			$request = Project::getRequest();
			$valid = true;
			
			if ($request -> pwd){
				if (!HelpFunctions::isValidPassword($request -> pwd)) {
					$this -> _view -> addFlashMessage(FM::ERROR, "Пароль слишком короткий или содержит недопустимые символы");
					$this -> _view -> assign('pass_error', true);
					$valid = false;
				}
				if (!$request -> pwd_repeat){
					$this -> _view -> addFlashMessage(FM::ERROR, "Требуется подтверждение пароля");
					$this -> _view -> assign('pass_error', true);
					$valid = false;
				}
				if ($request -> pwd && $request -> pwd_repeat){
					if ($request -> pwd != $request -> pwd_repeat){
						$this -> _view -> addFlashMessage(FM::ERROR, "Пароль и подтверждение не совпадают");
						$this -> _view -> assign('pass_error', true);
						$valid = false;
					} else {
						if (strlen($request -> pwd) < 5){
							$this -> _view -> addFlashMessage(FM::ERROR, "Пароль слишком короткий (нужно минимум 5 символов)");
							$this -> _view ->assign('pass_error', true);
						}
					}
				}
			}
			
			return $valid;
		}
		
		function checkLogin($login) {
			if (!HelpFunctions::isValidLogin($login)){
				return array('error'=>true, 'message'=>'Логин слишком короткий или содержит недопустимые символы');			
			} else {
				$user_model = new UserModel;
				$user_model -> loadByLogin($login);
				if ($user_model -> id > 0){
					return array('error'=>true, 'message'=>'Такой логин уже занят, выберите другой');	
				}
			}
			return array('error'=>false, 'message'=>'Логин доступен для регистрации');
		}
		
		function checkEmail($email) {
			if (!HelpFunctions::isValidEmail($email)){
				return array('error'=>true, 'message'=>'Email неверный');			
			} else {
				$user_model = new UserModel;
				$user_model -> loadByEmail($email);
				if ($user_model -> id > 0){
					return array('error'=>true, 'message'=>'Пользователь с таким email уже зарегистрирован на сайте');	
				}
			}
			return array('error'=>false, 'message'=>'Email доступен для регистрации');			
		}
		
		function RegistrationAction(){
			//if (true || $this -> ValidateRegistrationAction()){
			if ($this -> ValidateRegistrationAction()){
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
				$user_model -> marital_status = $request -> marital_status;
				$user_model -> icq = $request -> icq;
				$user_model -> website = $request -> website;
				$user_model -> phone = $request -> phone;
				$user_model -> mobile_phone = $request -> mobile_phone;
				$user_model -> about = $request -> about;
				
				$user_model -> books = $request -> books;
				$user_model -> films = $request -> films;
				$user_model -> musicians = $request -> musicians;
				
				$referer=new UserModel;
				$referer->loadByLogin($request->referer);
				$user_model -> referal = $referer->id?$referer->id:0;
				
				$user_model -> country_id = (int)$request -> country;
				$user_model -> state_id = (int)$request -> state;
				$user_model -> city_id = (int)$request -> city;
				$user_model -> user_type_id = UserTypeModel::REGISTRED;
				$user_model -> reputation = 0;
				
				$user_model -> rate = 0;
				$user_model -> nextmoney = 0;
				$user_model -> registration_date = date("Y-m-d H:i:s");
				$user_model -> banned = 0;
				$user_id = (int)$user_model -> save();
				
				$rate_nm = $user_model->getUserRateNMByRegistrationData($user_id);
				if ($rate_nm['nm']) $user_model -> changeUserMoney($user_id, 0, $rate_nm['nm'], 'За регистрацию');
				if ($rate_nm['rate']) $user_model -> changeUserRate($user_id, 0, $rate_nm['rate']);
				
				$separator = ",";
				if ($user_id <= 0){
					$this -> _view -> addFlashMessage(FM::ERROR, "Ошибка регистрации!");
					$this->RegistrationFormAction();
					return;
				}
				$this -> sendRegistrationMail($user_model, $request -> pwd);
				if (strlen($request -> interest)){
				    
					$interest_list = explode($separator, $request -> interest);
					foreach($interest_list as $interest){
						$interest=trim($interest);
						if (strlen($interest)){
							$interest_model = new InterestsModel;
							$interest_id = $interest_model -> set($interest);
							$user_interest_model = new UserInterestsModel;
							$user_interest_model -> set($user_id, $interest_id);
						}
					}
				}
				
				// Blog 
				$blog_model = new BlogModel;
				$blog_model -> creation_date = date("Y-m-d");
				$blog_model -> creation_ip = $_SERVER['REMOTE_ADDR'];
				$blog_model -> user_id = $user_id;
				$blog_model -> title = 'Мой блог';
				$blog_model -> access = 2;
				$blog_model -> save();
				
				Project::getResponse() -> redirect(Project::getRequest() -> createUrl("User", "CompleteRegistration"));
			} else {
				$this->RegistrationFormAction();
			}
		}
		
		function CompleteRegistrationAction(){
			$this-> _view -> assign('tab_list', TabController::getRegistrationTabs(false, false, false, true)); // Show tabs
			$this -> _view -> CompleteRegistration();
			$this -> _view -> parse();
		}
		
		function sendRegistrationMail(UserModel $user_model, $password = null){
			if (true || !Project::isLocalhost()){
				$request = Project::getRequest();
				$mailer = new PHPMailer();
				$view = new MailTemplateView;
				$info = array();
				
				$info['login_name'] = $user_model -> login;
				$info['password'] = $password;
				$info['registration_url'] = $request -> createUrl('Index', 'Index');
				$info['support_email'] = $this -> getParam('support_mail');
				$view -> Registration($info);
				
				$mailer->CharSet = "utf-8";
				$mailer->From =  $info['support_email'];
				$mailer->FromName = "Next24.ru";
				$mailer->Subject = "Регистрация на сайте Next24.ru";
				//$mailer->Subject = "Next24.ru";
				//$mailer->Body = $view -> parse();
				$mailer->Body = "Вы успешно зарегистрировались на сайте Next24.ru <br/> Login - ".$info['login_name']."<br/><hr/> e-mail поддержки: ".$info['support_email'];
				
				$mailer->IsHTML(true);
				$mailer->AddAddress($user_model -> email, $user_model -> last_name . " " . $user_model -> first_name . " " . $user_model -> middle_name);
				$bResult = $mailer->Send();
				
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
			$info['change_state_param'] = AjaxRequest::getJsonParam("User", "ChangeState", array('#id#'));
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
		
		function CheckLoginAction(){
			$request = Project::getRequest();
			$login = $request -> getKey('login');
			$res=$this->checkLogin($login);
			if ($res['error']) {
				$this -> _view -> CheckLogin('<span class="red">'.$res['message'].'</span>');
			}
			else {
				$this -> _view -> CheckLogin('<span class="green">'.$res['message'].'</span>');
			}
			$this -> _view -> ajax();
		}
		
		function CheckEmailAction(){
			$request = Project::getRequest();
			$email = $request -> getKey('email');
			$res=$this->checkEmail($email);
			if ($res['error']) {
				$this -> _view -> CheckEmail('<span class="red">'.$res['message'].'</span>');
			}
			else {
				$this -> _view -> CheckEmail('<span class="green">'.$res['message'].'</span>');
			}
			$this -> _view -> ajax();
		}
		
		public function SaveprofileAction(){
			$this->checkOfficeAccess();
		    $request = Project::getRequest();
			if ($this -> ValidateSaveAction() && $request->register){
				$user_model = Project::getUser() -> getShowedUser();
				
				$old_rate_nm = $user_model->getUserRateNMByRegistrationData($user_model->id);
				
				if ($request -> pwd){
    				$user_model -> salt = AppCrypt::generateSalt();
    				$user_model -> pass = AppCrypt::getHash($request -> pwd, $user_model -> salt);
				}
				$user_model -> first_name = $request -> name;
				$user_model -> last_name = $request -> surname;
				$user_model -> middle_name = $request -> father_name;
				
				$user_model -> birth_date = $request -> year . "-" . $request -> month . "-" . $request -> day;
				$user_model -> gender = (int)$request -> gender;
				$user_model -> marital_status = $request -> marital_status;
				$user_model -> icq = $request -> icq;
				$user_model -> website = $request -> website;
				$user_model -> phone = $request -> phone;
				$user_model -> mobile_phone = $request -> mobile_phone;
				$user_model -> about = $request -> about;
				
				$user_model -> interest = $request -> interest;
				$user_model -> books = $request -> books;
				$user_model -> films = $request -> films;
				$user_model -> musicians = $request -> musicians;
				
				$user_model -> country_id = (int)$request -> country;
				$user_model -> state_id = (int)$request -> state;
				$user_model -> city_id = (int)$request -> city;
				
				// Setting params
				$user_model->save();
				//print_r($user);
				
				$separator = ",";
				if (strlen($request -> interest)){
				    
					$interest_list = explode($separator, $request -> interest);
					foreach($interest_list as $interest){
						$interest=trim($interest);
						if (strlen($interest)){
							$interest_model = new InterestsModel;
							$interest_id = $interest_model -> set($interest);
							$user_interest_model = new UserInterestsModel;
							$user_interest_model -> set($user_id, $interest_id);
						}
					}
				}
				
				$new_rate_nm = $user_model->getUserRateNMByRegistrationData($user_model->id);
				if ($new_rate_nm['nm']-$old_rate_nm['nm'] != 0) $user_model -> changeUserMoney($user_model->id, 0, $new_rate_nm['nm']-$old_rate_nm['nm'], 'Изменение регистрационных данных');
				$user_model -> changeUserRate($user_model->id, $new_rate_nm['rate']-$old_rate_nm['rate']);				
			}
			$this -> ProfileEditAction();
			/*
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
			*/
		}
		
		
		
		public function PhotoAlbumAction(){
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'user/view_photoalbum.tpl.php');
			$this->view->display();			
		}
		
		public function LoginAction(){
		    $userModel = new UserModel();
			$request = Project::getRequest();
			$this -> _view -> clearFlashMessages();
			$res = Project::getSecurityManager() -> login($request -> login, $request -> pass);
			if ($res){
			    $user = $userModel->getUserByLogin($request -> login);	
			    $userModel->checkForUserBans($user);
				Project::getResponse() -> redirect(Project::getRequest() -> createUrl('User', 'Profile', null, $request -> login));
			} else {
			    if ($request->error == 'ban'){
			        $user = $userModel->getUserByLogin($request->login);
			        $this -> _view -> addFlashMessage(FM::ERROR, "Ваш аккаун заблокирован до ".date("Y-m-d H:i:s", $user['banned_date']));
			    }
				$this -> _view -> assign('login_result', false);
				$this -> _view -> Login();
				$this -> _view -> parse();
			}
		}
		
		
		
		public function ProfileAction(){
		    $userModel = new UserModel();
			$user = Project::getUser() -> getShowedUser();
			
			$friend_model = new FriendModel;
			$ui_model = new UserInterestsModel;
			$relation = new RelationsModel;
			
			$this -> _view -> assign('places', $user->loadGeoPlaces());
			
			$this -> _view -> assign('relations', $relation->getList());
			$this -> _view -> assign('my_relation', $relation->getRelation($this->_view->current_user->id, $user->id));
			$this -> _view -> assign('his_relation', $relation->getRelation($user->id, $this->_view->current_user->id));
			
			$this -> _view -> assign('user_default_avatar', $userModel->getUserAvatar($user->id));
			$this -> _view -> assign('friend_list', $friend_model -> getFriends($user -> id));
			$this -> _view -> assign('in_friend_list', $friend_model -> getInFriends($user -> id));
			$this -> _view -> assign('user_profile', $user -> data());
			//$this -> _view -> assign('user_interests', $ui_model -> getInterests($user -> id));
			
			$this -> _view -> assign('tab_list', TabController::getOwnTabs(true));
			$this -> _view -> Profile();
			$this -> _view -> parse();
		}
		
		function ProfileEditAction(){
			$this->checkOfficeAccess();
			
		    $userModel = new UserModel();
			$user = Project::getUser() -> getShowedUser();
			$request = Project::getRequest();
			
			$request->country = $user->country_id?$user->country_id:0;
			$request->city = $user->city_id?$user->city_id:0;
			$request->state = $user->state_id?$user->state_id:0;
			
			$this -> FillEditParams();
			
			$this -> _view -> assign('user', $user);
			$this -> _view -> assign('user_default_avatar', $userModel->getUserAvatar($user->id));
			$this -> _view -> assign('user_profile', $user -> data());
			$this -> _view -> assign('tab_list', TabController::getOwnTabs(true));
			$this -> _view -> ProfileEdit();
			
			$this -> _view -> parse();
			
		}
		
		function AvatarEditAction(){
		    $userModel = new UserModel();
		    $user = Project::getUser() -> getShowedUser();
		    $isAdmin = Project::getUser() -> isAdmin();
			$request = Project::getRequest();
			$this -> _view -> clearFlashMessages();
			$uploaddir = "app/images/avatar/";
			$noErrors = true;
			
			if ($request->avatar_action == 'create_avatar'){
			    
			    if ($userModel->getCountAllUserAvatars($user->id) > 9 && !$isAdmin){
			        $this -> _view -> addFlashMessage(FM::ERROR, "У Вас максимально разрешенное количество аватаров");
    	            $noErrors = false;
			    }
			    if (!$request->newava_name){
    			    $this -> _view -> addFlashMessage(FM::ERROR, "Введите название аватары");
    	            $noErrors = false;
			    }
			    if (!$request->_files['newava_file']['name']){
    			    $this -> _view -> addFlashMessage(FM::ERROR, "Выберите файл аватары");
    	            $noErrors = false;
			    }
			    
			    if ($noErrors){
        	        $UploadRes = $userModel -> uploadImgFile($uploaddir, $request->_files['newava_file']);
        	        if ($UploadRes['error']){
                        $this -> _view -> addFlashMessage(FM::ERROR, $UploadRes['error_message']);
                    }else{
                        if ($isAdmin && $request->is_system){
                            $userModel -> addSystemAvatar($UploadRes['file_name'], $request->newava_name);
                        }else{
                            $userModel -> addUserAvatar($user->id, $UploadRes['file_name'], $request->newava_name, 0, 0);
                        }
                        Project::getResponse()->redirect(Project::getRequest()->createUrl('User', 'AvatarEdit'));
                    }
                }
                
                
			}elseif ($request->avatar_action == 'change_avatar'){
			    $aAvatarNames = $request->avatar_names;
			    foreach ($aAvatarNames as $avatar_id=>$avatar_name){
			        $userModel->changeOneValue('avatars', $avatar_id, "av_name", $avatar_name);
			    }
			    $aAvatarsDelete = $request->avatars_delete;
			    foreach ($aAvatarsDelete as $avatar_id=>$avatar_on){
			        $userModel->delAvatar("avatars", $avatar_id, $uploaddir);
			    }
			    $avatar_default_id = $request->avatar_default;
			    if ($avatar_default_id){
			        $userModel->setDefaultAvatar($user->id, $avatar_default_id);
			    }
			    Project::getResponse()->redirect(Project::getRequest()->createUrl('User', 'AvatarEdit'));
			    
			    
			}elseif ($request->avatar_action == 'sys_avatar'){
			    $aAvatarNames = $request->avatar_names;
			    if ($aAvatarNames && $isAdmin){
    			    foreach ($aAvatarNames as $avatar_id=>$avatar_name){
    			        $userModel->changeOneValue('sys_av', $avatar_id, "av_name", $avatar_name);
    			    }
			    }
			    $aAvatarsDelete = $request->avatars_delete;
			    if ($aAvatarsDelete && $isAdmin){
    			    foreach ($aAvatarsDelete as $avatar_id=>$avatar_on){
    			        $userModel->delAvatar("sys_av", $avatar_id, $uploaddir);
    			    }
			    }
			    $avatar_check_id = $request->avatar_check;
			    $avatar = $userModel->getAvatarById($avatar_check_id, "sys_av");
			    if ($avatar_check_id && $avatar){
			        if (!$request->avatar_names[$avatar_check_id]){
        			    $this -> _view -> addFlashMessage(FM::ERROR, "Введите название выбранной системной аватары");
        	            $noErrors = false;
    			    }
    			    if ($noErrors){
    			        $userModel -> addUserAvatar($user->id, "", $request->avatar_names[$avatar_check_id], 0, $avatar_check_id);
    			    }
			    }
			    if ($noErrors){
			        Project::getResponse()->redirect(Project::getRequest()->createUrl('User', 'AvatarEdit'));
			    }
			}
			
			
			$this -> _view -> assign('user_avatars', $userModel->getAllUserAvatars($user->id));
			$this -> _view -> assign('sys_avatars', $userModel->getAllSysAvatars());
			$this -> _view -> assign('count_user_avatars', $userModel->getCountAllUserAvatars($user->id));
			$this -> _view -> assign('user_default_avatar', $userModel->getUserAvatar($user->id));
			$this -> _view -> assign('newava_name', $request->newava_name);
			$this -> _view -> assign('user_profile', $user -> data());
			$this -> _view -> assign('user', $user);
			$this-> _view -> assign('isAdmin', $isAdmin);
			$this -> _view -> assign('tab_list', TabController::getOwnTabs(true));
			$this -> _view -> AvatarEdit();
			
			$this -> _view -> parse();
		}
		
		public function MoodAction(){
		    $userModel = new UserModel();
		    $user = Project::getUser() -> getShowedUser();
		    $isAdmin = ($user->user_type_id == 1)?true:false;
			$request = Project::getRequest();
			$this -> _view -> clearFlashMessages();
			$noErrors = true;
			
			if ($request->mood_action == 'ok'){
			    if ($request->add_mood){
			        if (!$request->mood_name){
        			    $this -> _view -> addFlashMessage(FM::ERROR, "Выберите текст настроения");
        	            $noErrors = false;
    			    }
    			    if ($noErrors){
            	        $userModel->addMood($user->id, $request->mood_name);
                        Project::getResponse()->redirect(Project::getRequest()->createUrl('User', 'Mood'));
    			    }
			    }elseif ($request->change_mood){
		            $aMoodNames = $request->moods;
    			    foreach ($aMoodNames as $mood_id=>$mood_name){
    			        $userModel->changeMood($mood_id, $mood_name);
    			    }
    			    $aMoodDelete = $request->del_moods;
    			    foreach ($aMoodDelete as $mood_id=>$mood_del_val){
    			        $userModel->delMood($mood_id);
    			    }
			    }
			}
			
			$this -> _view -> assign('user_moods', $userModel->getAllUserMoods($user->id));
			$this -> _view -> assign('user_default_avatar', $userModel->getUserAvatar($user->id));
			$this -> _view -> assign('user_profile', $user -> data());
			$this -> _view -> assign('user', $user);
		    $this -> _view -> assign('isAdmin', $isAdmin);
		    $this -> _view -> assign('tab_list', TabController::getOwnTabs(true));
			$this -> _view -> MoodPage();
			
			$this -> _view -> parse();
		}
		
		public function LogoutAction(){
			Project::getSecurityManager() -> logout();
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl('Index', 'Index', null, false));
		}
		
		public function WhyPageAction(){
			$this-> _view -> assign('tab_list', TabController::getRegistrationTabs(false, true)); // Show tabs
			$this-> _view -> assign('pageContent', "Why, Why, Why, Why, Why?  Hello World!"); // Page Contenet
			$this -> _view -> ContentPage();
			$this -> _view -> parse();
		}
		
		public function LicenseAction(){
			$this-> _view -> assign('tab_list', TabController::getRegistrationTabs(false, false, true)); // Show tabs
			$this-> _view -> assign('pageContent', "License here."); // Page Contenet
			$this -> _view -> ContentPage();
			$this -> _view -> parse();
		}
		
		function RemindPasswordAction(){
		    $varTabs = array();
		    $request = Project::getRequest();
		    $this -> _view -> clearFlashMessages();
		    
		    if ($request->remind){
		        $userModel = new UserModel();
		        $noErrors = true;
		        $email = trim($request->email);
		        
		        if (!$email){
		            $this -> _view -> addFlashMessage(FM::ERROR, "Введите Email");
		            $noErrors = false;
		        }else{
		            
		            $userModel->loadByEmail($email);
		            if (!$userModel->id){
    		            $this -> _view -> addFlashMessage(FM::ERROR, "Такой Email не регистрировался");
    		            $noErrors = false;
		            }
		        }
		        
		        if ($noErrors){
		            $newPass = rand(111111, 9999999);
		            $salt = AppCrypt::generateSalt();
		            $userModel -> salt = $salt;
    				$userModel -> pass = AppCrypt::getHash($newPass, $salt);
    				$userModel -> save();
    				$mailer = new PHPMailer();
    				$mailer->CharSet = "utf-8";
    				$mailer->From = "info@next24.ru";
    				$mailer->FromName = "Next24.ru";
    				$mailer->Subject = "Восстановление пароля в системе Next24.ru ";
    				$body = "Восстановление пароля в системе Next24.ru: <br>Логин: ".$userModel->login." <br>Новый пароль: ".$newPass;
    				$alt_body = "Восстановление пароля в системе Next24.ru: \nЛогин: ".$userModel->login." \nНовый пароль: ".$newPass;
    				$mailer->Body    = $body;  
                    $mailer->AltBody = $alt_body;  
                    $mailer->AddAddress($email, $userModel->first_name." ".$userModel->middle_name." ".$userModel->last_name); 
    				$mailer->Send();
    				$this -> _view -> addFlashMessage(FM::INFO , "На указанный Email был выслан новый пароль");
		        }
		        
		    }
		    
		    
		    $varTabs[] = array('name'=>"Напоминание пароля", 'title'=>"Напоминание пароля", 'selected'=>true, 'controller_name'=>"User",  'action_name'=>"RemindPassword");
			$this-> _view -> assign('tab_list', TabController::getVariableTabs($varTabs)); // Show tabs
			$this -> _view -> RemindPassword();
			$this -> _view -> parse();
		}
		
		public function ChangeRelationAction() {
			$request = Project::getRequest();
			$relation = new RelationsModel;
			$user = Project::getUser() -> getShowedUser();

			$relation->setRelation($this->_view->current_user->id, $user->id, $request->relation_text);
			// Send message
			$m=new MessagesController();
			$m->sendMessage('Отношение','Пользователь '.$this->_view->current_user->login.' указал свое отношение к вам. Чтобы просмотреть что именно было указано, <a href="'.$request->createUrl('User', 'Profile', null, $this->_view->current_user->login).'">перейдите в профиль пользователя '.$this->_view->current_user->login.'</a>.',$this->_view->current_user->id,$user->id,0,0,0,1);
			// ------------
			
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl("User", "Profile"));
		}
		
	}
?>
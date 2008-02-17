<?php	
	class CUser extends CBaseManager implements IManager{
		public $userType;
		public $userRights = null;
		
		public function __construct(){
			$this->setModel('Users');
			$this->userType = USER_TYPE_GUEST;
			
		}

		public function initialize(IConfigParameter $configuration){
			$this->inited=true;
			//die(BACKTRACE());
			//$session = getManager('CSession');
			$session = getManager('session');
			$userData = $session->read('user');
			$userData = @unserialize($userData);

			if(!isset($userData) || !is_array($userData)){
				$this->userType = USER_TYPE_GUEST;
				$this->userRights = $this->getRights();
				$session->write('user', serialize(array('user_type_id'=>$this->userType, 'rights'=>$this->userRights)));
			} else {
				$this->userType = $userData['user_type_id'];
				$this->userRights = $userData['rights'];
			}
			parent::init();
		}
		
		public function getRights(){
			if(is_null($this->userRights)){
				$this->userRights = $this->model->getRights($this->userType);
			}

			return $this->userRights;
		}
		
		public function login($login, $pass){
			$userData = $this->model->loginUser($login, $pass);
			if($userData){
				//$session = getManager('CSession');
				$session = getManager('session');
				$session->write('user', serialize($userData));
				$this->userRights = $userData['rights'];
				$this->userType = $userData['user_type_id'];
			} else {
				$flashMessage = getManager('CFlashMessage');
				$flashMessage->setMessage("Логин данные неправильные", FLASH_MSG_TYPES::$error);
			}
		}
		
		public function logout(){
			$session = getManager('CSession');
			$userData = unserialize($session->read('user')); 
			$flashMessage = getManager('CFlashMessage');
			$flashMessage->setMessage("Досвидания ".$userData['first_name'].' '.$userData['last_name'].'!', FLASH_MSG_TYPES::$error);
			
			$this->userType = USER_TYPE_GUEST;
			$this->userRights = $this->getRights();
			$session->write('user', serialize(array('user_type_id'=>$this->userType, 'rights'=>$this->userRights)));
			
		}
	}
?>
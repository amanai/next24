<?php	
	class CUser extends CBaseManager{
		public $userType;
		public $userRights = null;
		
		public function __construct(){
			$this->setModel('Users');
		}

		public function init(){
			$session = getManager('CSession');
			$userData = $session->read('user');
			$userData = unserialize($userData);
			
			if(!isset($userData) || !is_array($userData)){
				$this->userType = USER_TYPE_GUEST;
				$this->userRights = $this->getRights();
				$session->write('user', serialize(array('user_type_id'=>$this->userType, 'rights'=>$this->userRights)));
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
				$session = getManager('CSession');
				$session->write('user', serialize($userData));
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
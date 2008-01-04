<?php	
	class CUser extends CBaseManager{
		public $userType;
		public $userRights = null;
		

		public function init(){
			$session = getManager('CSession');
			$userData = $session->read('user');

			if(!isset($userData) || !is_array($userData)){
				$this->userType = USER_TYPE_GUEST;
				$this->userRights = $this->getRights();
				$session->write('user', serialize(array('type'=>$this->userType, 'rights'=>$this->userRights)));
			}
			parent::init();
		}
		
		public function getRights(){
			if(is_null($this->userRights)){
				$tmp = MySql::query_row("SELECT rights FROM user_types WHERE id='" . $this->userType . "'");
				$this->userRights = $tmp['rights'];
			}
			return $this->userRights;
		}
	}
?>
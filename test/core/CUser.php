<?php	
	class CUser {
		public $userType;
		
		public function __construct(){
			$this->userType = USER_TYPE_GUEST;
		}
	}
?>
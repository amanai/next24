<?php
class AppAuth{
	private $_accessList = array();
	private $_subactions = array();
		function __construct($autorization){
			$this -> init($autorization);
			
		}
		
		function init($autorization){
			if ($autorization -> needAutorization() === true){
				$type = Project::getUser() -> getDbUser() -> getUserType();
			} else {
				$this -> _guest = true;
				$type = new UserTypeModel;
			}
			// TODO:: need adding cache
			$right_model = new UserRightModel;
			$list = $right_model -> loadByUserType($type -> id);
			foreach($list as $item){
				$controller_id = (int)$item['controller_id'];
				$action_id = (int)$item['action_id'];
				$subaction_id = (int)$item['subaction_id'];
				if (!isset($this -> _accessList[$controller_id])){
					$this -> _accessList[$controller_id] = array();
				}
				if (!isset($this -> _accessList[$controller_id][$action_id]) && ($subaction_id === 0) && ((int)$item['access'] > 0)){
					$this -> _accessList[$controller_id][$action_id] = true;
				}
				
				if ($subaction_id > 0){
					if (!isset($this -> _subactions[$action_id])){
						$this -> _subactions[$action_id] = array();
					}
					if ((int)$item['access'] > 0){
						$this -> _subactions[$action_id][$subaction_id] = true;
					}
				}
			}
		}
		
		/**
		 * Check access to the controler, action, subaction
		 * @return bool false - permission denied, true - access enabled
		 */
		public function checkAccess($controller_id, $action_id, $subaction_id = 0){
			$controller_id = (int)$controller_id;
			$action_id = (int)$action_id;
			$subaction_id = (int)$subaction_id;
			$access = false;
			// TODO::need writing to acceess log info with access errors
			if (isset($this -> _accessList[$controller_id])){
				if (isset($this -> _accessList[$controller_id][$action_id])){
					if ($subaction_id === 0){
						$access = true;
					} else{
						if (isset($this -> _accessList[$controller_id][$action_id][$subaction_id])){
							$access = true;
						}
					}
				}
			}
			return $access;
		}
}
?>

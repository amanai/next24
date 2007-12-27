<?php
	include CORE_PATH.'action_list.php';

	class CRightsManager {
		private $forbiddenName;
		public function __construct(){
			
		}
		
		public function checkAccess($controllerName, $actionName, $subactionName=''){
			$user = getManager('CUser');
			$userType = $user->userType;
			
			$allowed = true;
			$allowed &= $this->checkController($controllerName, $userType);
			($allowed)?$allowed &= $this->checkAction($controllerName, $actionName, $userType):'';
			
			if(!$allowed){
				$flashMessage = getManager('CFlashMessage');
				$flashMessage->setMessage("������ �������� (".$this->forbiddenName.")", FLASH_MSG_TYPES::$error);
				return false;
			}
			
			($allowed && $subactionName)?$allowed &= $this->checkSubaction($controllerName, $actionName, $subactionName, $userType):'';
			return $allowed;
		}
		
		
		private function checkController($controllerName, $userType){
			global $actionList;
			$rez = in_array($userType, $actionList[$controllerName]['allow']);
			(!$rez)?$this->forbiddenName='���������� '.$controllerName:'';
			return $rez;
		}
		
		private function checkAction($controllerName, $actionName, $userType){
			global $actionList;
			$rez = in_array($userType, $actionList[$controllerName]['actions'][$actionName]['allow']);
			(!$rez)?$this->forbiddenName='���� '.$ationName:'';
			return $rez;
		}
		
		private function checkSubaction($controllerName, $actionName, $subactionName, $userType){
			global $actionList;
			$rez = in_array($userType, $actionList[$controllerName]['actions'][$actionName]['subactions'][$subactionName]);
			(!$rez)?$this->forbiddenName='�������'.$subactionName:'';
			return $rez;
		}
		
	}
?>
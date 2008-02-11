<?php
	class CRightsManager extends CBaseManager {
		private $forbiddenName;
		
		public function checkAccess($controllerName, $actionName, $subactionName=''){
			$user = getManager('CUser');
			$userRights = unserialize($user->getRights());
			
			if(isset($userRights[$controllerName])){				
				if(isset($userRights[$controllerName][$actionName])){					
					if(!strlen($subactionName) || in_array($subactionName, $userRights[$controllerName][$actionName])){
						return true;
					} else{						
						return false;
					}
				} else {
					// TODO:: hardcoded admin controller name
					if ($controllerName == 'AdminController'){
						$router = getManager('CRouter');
						$router -> redirect($router -> createUrl('Admin', 'LoginForm'));
					}
					$flashMessage = getManager('CFlashMessage');
					$flashMessage->setMessage("Доступ запрещен (Екшн ".$actionName.")", FLASH_MSG_TYPES::$error);
					return false;
				}
			} else {
				// TODO:: hardcoded admin controller name
				if ($controllerName == 'AdminController'){
					$router = getManager('CRouter');
					$router -> redirect($router -> createUrl('Admin', 'LoginForm'));
				}
				$flashMessage = getManager('CFlashMessage');
				$flashMessage->setMessage("Доступ запрещен (Контроллер ".$controllerName.")", FLASH_MSG_TYPES::$error);
				return false;
			}
		}
		
		
		private function checkController($controllerName, $userType){
			global $actionList;
			$rez = in_array($userType, $actionList[$controllerName]['allow']);
			(!$rez)?$this->forbiddenName='Контроллер '.$controllerName:'';
			return $rez;
		}
		
		private function checkAction($controllerName, $actionName, $userType){
			global $actionList;
			$rez = in_array($userType, $actionList[$controllerName]['actions'][$actionName]['allow']);
			(!$rez)?$this->forbiddenName='Екшн '.$ationName:'';
			return $rez;
		}
		
		private function checkSubaction($controllerName, $actionName, $subactionName, $userType){
			global $actionList;
			$rez = in_array($userType, $actionList[$controllerName]['actions'][$actionName]['subactions'][$subactionName]);
			(!$rez)?$this->forbiddenName='Субекшн'.$subactionName:'';
			return $rez;
		}
		
	}
?>
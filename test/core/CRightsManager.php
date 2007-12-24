<?php
	class CRightsManager {
		public function __construct(){
			
		}
		
		public function checkAccess($controllerName, $ationName){
			if(1){
				return true;
			} else {
				$flashMessage = getManager('CFlashMessage');
				$flashMessage->setMessage("Доступ запрещен", FLASH_MSG_TYPES::$error);
			}
		}
	}
?>
<?php
	class CFlashMessage {
		public function __construct(){
			
		}
		
		public function setMessage($msg, $type){
			$session = getManager('CSession');
			$session->set("FLASH_MSG_".$type, $msg);
		}
		
		public function displayAll(){			
			$msgTypes = get_class_vars('FLASH_MSG_TYPES');
			$session = getManager('CSession');
			foreach($msgTypes as $type){
				$msg = $session->get("FLASH_MSG_".$type);
				if($msg) $this->renderMsg($msg, $type);
				$session->clear("FLASH_MSG_".$type);
			}
		}
		
		/**
		 * TODO: сделать рендер через базовый контроллер
		 */
		private function renderMsg($msg, $type){
			$color = FLASH_MSG_TYPES::$colors[$type];
			echo '<div style="color:'.$color.'">'.$msg.'</div>';
		}
	}
?>
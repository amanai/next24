<?php
	session_start();
	class CApp {
		public $manages = array();
		
		public function __construct(){
			$managersNames = array(
				'CSession',
				'CFlashMessage',
				'CRouter',
				'CRightsManager',
			);
			
			foreach ($managersNames as $managerName){
				if(file_exists(CORE_PATH.$managerName.'.php')){
					require_once(CORE_PATH.$managerName.'.php');					
				}
			}
			
			foreach ($managersNames as $managerName){
				if(class_exists($managerName)){
					$this->manages[$managerName] = new $managerName();
				}
			}
		}

		
		public function run(){
			$this->manages['CRouter']->route();
			$this->manages['CFlashMessage']->displayAll();
			
			echo 'url examples - <br/><br/>';
			echo $this->manages['CRouter']->createUrl() .'<br/>';
			echo $this->manages['CRouter']->createUrl('contrl') .'<br/>';
			echo $this->manages['CRouter']->createUrl('contrl', 'action') .'<br/>';
			echo $this->manages['CRouter']->createUrl('contrl', 'action', "par1").'<br/>';
			echo $this->manages['CRouter']->createUrl('contrl', 'action', array("par1"=>"aaa")).'<br/>';
		}
		
		/**
		 * TODO: добавить проверку на инициализацию менеджера, писать в ерроры ели менеджера нет или не проиничен
		 */
		public function getManager($name){
			if(isset($this->manages[$name])){
				return $this->manages[$name];
			} else {
				return null; 
			}
		}
	}
?>
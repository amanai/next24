<?php
	class CApp {
		public $manages = array();
		
		public function __construct(){
			$managersNames = array(
				'CLog',
				'CErrorHandler',
				'CSession',
				'CFlashMessage',
				'CRouter',
				'CRightsManager',
				'CBaseController',
				'CUser',
			);

			//static classes
			require_once(CORE_PATH.'MySql.php');
			MySql::initDb();
			
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
			$this->manages['CLog']->init(BASE_PATH.'log', 'log_', 'LOG', 'oneFile', "counter");

			$this->manages['CSession']->init();
			
			session_set_save_handler(
				array($this->manages['CSession'], 'demand_session'), 
				array($this->manages['CSession'], 'close'), 
				array($this->manages['CSession'], 'get_var'), 
				array($this->manages['CSession'], 'set_var'), 
				array($this->manages['CSession'], 'logout'), 
				array($this->manages['CSession'], 'killold'));
			
			$this->manages['CRouter']->route();
			$this->manages['CFlashMessage']->displayAll();
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
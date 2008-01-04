<?php
	require_once(MANAGER_PATH.'CBaseManager.php');
	require_once(MANAGER_PATH.'CBaseController.php');
	require_once(MANAGER_PATH.'CBaseView.php');
	require_once(MANAGER_PATH.'CBaseModel.php');
	
	class CApp {
		public $manages = array();
		
		private $managersNames = array();
			
		public function __construct(){
			$this->managersNames = array(
				'CLog',
				'CErrorHandler',
				'CSession',
				'CFlashMessage',
				'CRouter',
				'CRightsManager',
				'CUser',
			);

			//static classes
			require_once(UTILS_PATH.'MySql.php');
			MySql::initDb();
			
			foreach ($this->managersNames as $managerName){
				if(file_exists(MANAGER_PATH.$managerName.'.php')){
					require_once(MANAGER_PATH.$managerName.'.php');					
				}
			}
			
			foreach ($this->managersNames as $managerName){				
				if(class_exists($managerName)){
					$this->manages[$managerName] = new $managerName();
				}
			}			
		}

		
		public function run(){	
			$this->manages['CLog']->init(BASE_PATH.'log', 'log_', 'LOG', 'oneFile', "counter");
			$this->manages['CErrorHandler']->init();
			$this->manages['CSession']->init();
			$this->manages['CFlashMessage']->init();
			$this->manages['CRouter']->init();
			$this->manages['CRightsManager']->init();
			$this->manages['CUser']->init();
			
			$this->manages['CRouter']->route();			
			$this->manages['CFlashMessage']->displayAll();
		}
		
		/**
		 * TODO: добавить проверку на инициализацию менеджера, писать в ерроры ели менеджера нет или не проиничен
		 */
		public function getManager($name){				
			if(isset($this->manages[$name]) ){
				if (!$this->manages[$name]->inited){
					throw new Exception('Manager Not Inited ('.$name.')');
				}
				return $this->manages[$name];
			} else {
				return null; 
			}
		}
	}
?>
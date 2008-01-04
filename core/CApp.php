<?php
	require_once(CORE_PATH.'CBaseManager.php');

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
				'CBaseController',
				'CUser',
			);

			//static classes
			require_once(CORE_PATH.'MySql.php');
			MySql::initDb();
			
			foreach ($this->managersNames as $managerName){
				if(file_exists(CORE_PATH.$managerName.'.php')){
					require_once(CORE_PATH.$managerName.'.php');					
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
			$this->manages['CUser']->init();
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
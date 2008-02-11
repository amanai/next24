<?php
	require_once(CORE_PATH.'CFormData.php');
	require_once(MANAGER_PATH.'CBaseManager.php');
	require_once(MANAGER_PATH.'CBaseModel.php');

	class CApp {
		public $manages = array();
		
		private $managersNames = array();
			
		public function __construct(){
			$this->managersNames = array(
				'CParams',
				'CLog',
				'CErrorHandler',
				'CSession',
				'CFlashMessage',
				'CRouter',
				'CRightsManager',
				'CUser',
			);

			//static classes
			require_once(UTILS_PATH."MySql.php");
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

			$this->manages['CParams']->init();
			$this->manages['CLog']->init(BASE_PATH.'log', 'log_', 'LOG', 'oneFile', "counter");
			$this->manages['CErrorHandler']->init();
			$this->manages['CSession']->init();
			$this->manages['CFlashMessage']->init();
			$this->manages['CRouter']->init();
			$this->manages['CRightsManager']->init();
			$this->manages['CUser']->init();
				
			require_once(MANAGER_PATH.'CBaseController.php');	
			require_once(MANAGER_PATH.'CBaseView.php');

			$this->manages['CRouter']->route();			
			//$this->manages['CFlashMessage']->displayAll();

		}
		
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
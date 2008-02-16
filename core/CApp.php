<?php
	require_once(CORE_PATH.'CFormData.php');
	require_once(MANAGER_PATH.'CBaseManager.php');
	require_once(MANAGER_PATH.'CBaseModel.php');
	
	require_once(CORE_PATH.'ApplicationManager.php');

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
					Project::set($managerName, new $managerName());
				}
			}			
		}
		
		public function init($configFile){
			if (!file_exists($configFile) || !is_file($configFile)){
				die("Missing main configuration file");
			}
			$xml = simplexml_load_file($configFile);
			foreach ($xml->module as $module) {
				$configuration = new ConfigParameter($module->asXML());
				$class = $configuration -> get('class');
				if (!$class){
					die("Module has no class");
				}
				$module_id = $configuration -> get('id');
				if (!$module_id){
					die("Module has no ID");
				}
				if (Project::exists($module_id)){
					die("Module id already busy:".$module_id);
				}
				$module = new $class;
				$module -> init($configuration);
				//var_dump($module_id, $class);echo '<br>';
				Project::set($module_id, $module);
				unset($module);
			}
		}

		
		public function run(){	
			
			/*$this->manages['CParams']->init();
			$this->manages['CLog']->init(BASE_PATH.'log', 'log_', 'LOG', 'oneFile', "counter");
			$this->manages['CErrorHandler']->init();
			$this->manages['CSession']->init();
			$this->manages['CFlashMessage']->init();
			$this->manages['CRouter']->init();
			$this->manages['CRightsManager']->init();
			$this->manages['CUser']->init();
			*/
			require_once(MANAGER_PATH.'CBaseController.php');	
			require_once(MANAGER_PATH.'CBaseView.php');

			Project::get('router') -> route();
			//$this->manages['CRouter']->route();			
			//$this->manages['CFlashMessage']->displayAll();

		}
		
		public function getManager($name){
			
			$manager = Project::get($name);
			// TODO:: add manager interface checking
			if(is_object($manager) ){
				if (!$manager->inited){
					echo BACKTRACE();
					die('Manager Not Inited ('.$name.')');
					throw new Exception('Manager Not Inited ('.$name.')');
				}
				return $manager;
			} else {
				return null;
			}
							
			/*if(isset($this->manages[$name]) ){
				if (!$this->manages[$name]->inited){
					throw new Exception('Manager Not Inited ('.$name.')');
				}
				return $this->manages[$name];
			} else {
				return null; 
			}*/
		}
	}
?>
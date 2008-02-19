<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'exceptions' . DIRECTORY_SEPARATOR . 'AppException.php');
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'ConfigParameter.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ApplicationManager.php');	
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'NamespaceManager.php');

class CApp {
	private $_request_complete = false;
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
					// TODO:: write to log file
					//die("Module id already busy:".$module_id);
				}
				$module = new $class;
				$module -> initialize($configuration);
				//var_dump($module_id, $class);echo '<br>';
				if ($module -> setToRegistry() === true){
					Project::set($module_id, $module);
				}
				unset($module);
			}
		}

		
		public function run(){
			
			$autorize = Project::getSecurityManager() -> getAutorize(); 
			$controller_class = $autorize -> getController() -> name;
			$controller = new $controller_class;
			$controller -> init($autorize -> getController(), $autorize -> getAction());
			$action_function = $autorize -> getAction() -> name . 'Action';
			$controller -> $action_function();
			$this -> _request_complete = true;
			return $controller;
		}
		
		public function complete($controller){
			if ($this -> _request_complete === true){
				Project::getResponse() -> write($controller -> getContent());
			} else {
				// TODO:: here bad request page
				die("Request not completed");
			}
		}
	}
?>
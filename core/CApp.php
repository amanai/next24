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
				Project::set($module_id, $module);
				unset($module);
			}
		}

		
		public function run(){
			$request = Project::getRequest();
			$controller_key = $request -> getController();
			$controller_model = new ControllerModel;
			$controller_model -> loadByKey($controller_key);
			if ($controller_model -> id > 0){
				$controller_class = $controller_model -> name;
			} else {
				// TODO:: use different configurations for admin and frontend
				$controller_model -> loadDefault($admin = true);
				if ($controller_model -> id > 0){
					$controller_class = $controller_model -> name;
				} else {
					// TODO:: redirect where? no default controller
					die("No default controller!!!!!!! What to do, if we have no default controller");
					throw new ConfigurationException("Can't load default controller:request_key=".$controller_key);
				}
			}
			$controller = new $controller_class;
			$reflection = new ReflectionClass($controller_class);
			
			
			
			$action = $request -> getAction();
			$has_action = false;
			if ($action){
				$action_function = $action . 'Action';
				if ($reflection -> hasMethod($action_function)){
					$has_action = true;
				}
			}
			
			$action_model = new ActionModel;
			if ($has_action === false){
				$action_model -> loadDefault($controller_model -> id);
				if ($action_model -> id <= 0){
					// TODO:: redirect where or what to show? no default action for controller
					throw new InvalidActionException("Can't load default action for controller:ID=".$controller_model -> id.";class=".$controller_class);
				}
				$action_function = $action_model -> name . 'Action';
				if ($reflection -> hasMethod($action_function)){
					$has_action = true;
				}
			}
			
			if ($has_action === false){
				// TODO:: no request action and default action: what to do? may be redirect to default action of default controller or show:: page is not aviable or moved to another place
				// may by header 404 to own document?
				throw new InvalidActionException("Default action not exists at controller controller:ID=".$controller_model -> id.";class=".$controller_class.";action_id=".$action_model -> id.";action_name=".$action_function);
			}
			
			$controller -> init($controller_model, $action_model);
			$controller -> $action_function();
			
			
			$this -> _request_complete = true;
			
	
			//Project::get('router') -> route();
			//$this->manages['CRouter']->route();			
			//$this->manages['CFlashMessage']->displayAll();
			
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
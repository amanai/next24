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
			//$x = setlocale(LC_TIME, 'ru_RU.CP1251', 'ru_RU.cp1251', 'Russian_Russia.1251');
			$x = setlocale(LC_ALL, 'rus_RUS.65001', 'rus_RUS.65001', 'Russian_Russia.65001');
			
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
			setcookie('PHPSESSID',session_id(),null,null,Project::getUser() -> getDbUser() -> login.'.next24.home');
			
			$controller -> $action_function();
			$this -> _request_complete = true;
			
			// Сохраняем время пользователя на серваке
			$user = Project::getUser() -> getDbUser();
			if ($user->id){
			    $userModel = new UserModel();
			    $userModel->refreshUsersOnline();
			    if (!$userModel->isUserOnline($user->id)){
			        $userModel->addUserOnline($user->id);
			    }else{
			        $userModel->updateUserOnline($user->id);
			    }
			    $userModel = new UserModel();
			    $user = $userModel->getUserById($user->id);	
			    $userModel->checkForUserBans($user);
			}
			// END Сохраняем время пользователя на серваке
			
			
			
			return $controller;
		}
		
		public function complete($controller){
			if ($this -> _request_complete === true){
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Дата в прошлом
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Pragma: no-cache"); // HTTP/1.1
				header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
				echo $controller -> getContent();
				//Project::getResponse() -> write($controller -> getContent());
			} else {
				// TODO:: here bad request page
				die("Request not completed");
			}
		}
	}
?>
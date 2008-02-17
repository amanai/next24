<?php
	
	class CRouter extends CBaseManager implements IManager{
		
		private $path;
		
		private $controllerName;
		private $actionName;
		private $params;

		public function __construct(){
			$this->path = isset($_REQUEST['_path'])?$_REQUEST['_path']:DEFAULT_CONTROLLER;
		}
		
		function initialize(IConfigParameter $configuration){
			$this -> inited = true;
		}

		public function route(){
			$actionArr = explode("/", $this->path);

			$this->controllerName = $this->getControllerName($actionArr);
			$this->actionName = $this->getActionName($actionArr);
			$this->params = $this->getParams($actionArr, $_POST);

			//$rightsManager = getManager('CRightsManager');
			$rightsManager = getManager('rm');
			if(!$rightsManager->checkAccess($this->controllerName, $this->actionName)){return;}

			//$session = getManager('CSession');
			$session = getManager('session');
			$session->write('LAST_PATH', $_SERVER['REQUEST_URI']);
						
			$controllerName = $this->controllerName;
			$actionName = $this->actionName;
			
			$controller = new $controllerName(null, $this->params);
			$controller->initCommonData();		
			$controller->$actionName();			
		}

		
		public function redirect($path){
			header("Location: ".$path);
			exit;
		}
		
		public function createUrl($controller=null, $action=null, $params=null){
			$rez = '';
			if(is_null($controller)){
				return BASE_URL.DEFAULT_CONTROLLER;
			} else {
				$rez = $controller;
			}
			if(is_null($action)){
				return BASE_URL.$rez.'/'.DEFAULT_ACTION;
			} else {
				$rez .= '/'.$action;
			}
			
			if(is_null($params)){
				return BASE_URL.$rez;
			} else {
				if(is_array($params)){
					$tmp = '';
					foreach($params as $key=>$val){
						$tmp .= '/'.$key.':'.$val;
					}
					return BASE_URL.$rez.'/'.$tmp;
				} else {
					return BASE_URL.$rez.'/'.$params;
				}
			}
		}
		
		
		private function getControllerName($params){
			if (isset($params[0]) && strlen(trim($params[0]))){				
				if(file_exists(CONTROLLERS_PATH.ucwords($params[0]).'Controller.php')){
					require_once(CONTROLLERS_PATH.ucwords($params[0]).'Controller.php');
					return ucwords($params[0]).'Controller';
				} else {
					$flashMessage = getManager('CFlashMessage');
					$session = getManager('CSession');

					$flashMessage->setMessage("Страница не существует", FLASH_MSG_TYPES::$error);
					$lastPath = $session->read('LAST_PATH');
					if($lastPath){
						$this->redirect($lastPath);
					} else {
						require_once(CONTROLLERS_PATH.DEFAULT_CONTROLLER.'Controller.php');
						return DEFAULT_CONTROLLER.'Controller';
					}
				}
			} else {
				require_once(CONTROLLERS_PATH.DEFAULT_CONTROLLER.'Controller.php');
				return DEFAULT_CONTROLLER.'Controller';
			}
		}

		private function getActionName($params){
			if(isset($params[1]) && strlen(trim($params[1]))){
				$actionName = ucwords($params[1]);
				$meth = get_class_methods($this->controllerName);
				if(in_array($actionName.'Action', $meth)) {
					return ucwords($actionName).'Action';
				} else {
					$flashMessage = getManager('CFlashMessage');
					$session = getManager('CSession');
					$flashMessage->setMessage("Действие не существует", FLASH_MSG_TYPES::$error);
					$lastPath = $session->read('LAST_PATH');
					if($lastPath){
						$this->redirect($lastPath);
					} else {
						return DEFAULT_ACTION.'Action';
					}					
					return DEFAULT_ACTION.'Action';
				}
			} else {
				return DEFAULT_ACTION.'Action';
			}
		}	
		
		private function getParams($getParams, $postParams){
			$pars = array_slice($getParams, 2);
			$rez = array();
			foreach($pars as $par){
				list($name, $val) = explode(':',$par);
				$rez[$name] = $val;
			}
			
			foreach($postParams as $name=>$par){
				$rez[$name] = $par;
			}
			return $rez;
		}
	}
?>
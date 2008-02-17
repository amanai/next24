<?php

class AppAutorization extends ApplicationManager implements IManager{
	private $_needAutorization = false;
	private $_login_controller;
	private $_login_action;
	
	private $_current_controller;
	private $_current_action;
	private $_current_subactions;

			function initialize(IConfigParameter $configuration){
				
				$need = $configuration -> get('autorization');
				if ($need === true){
					$this -> _needAutorization = true;
				} else {
					$this -> _needAutorization = false;
				}
				
				$this -> _login_controller = $configuration -> get('login_controller');
				$this -> _login_action = $configuration -> get('login_action');
				
				$this -> _common_config($configuration);
			}
			
			private function setData($controller_model, $action_model){
				$this -> _current_controller = $controller_model;
				$this -> _current_action = $action_model;
			}
			
			public function getController(){
				return $this -> _current_controller;
			}
			
			public function getAction(){
				return $this -> _current_action;
			}
			
			function procees($auth){
				
				$request = Project::getRequest();
				
				
				$request_controller = $request -> getController();
				$request_action = $request -> getAction();
				
				$controller_model = new ControllerModel;
				$controller_model -> loadByKey($request_controller);
				$load_default = false;
				if ($controller_model -> id > 0){
					// Requested controller exists at list
					$reflection = new ReflectionClass($controller_model -> name);
					$action_model = new ActionModel;
					$action_model -> loadByKey($request_action);
					if (($action_model -> id > 0) && $reflection -> hasMethod($request_action . 'Action')){
						// Request action exists at database list and controller has method for it
						if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
							// We have access for requested controller and action
							$this -> setData($controller_model, $action_model);
						} else {
							$this -> accessLog(__METHOD__, __LINE__, "No access to requested action of requested controller: requested controller - ".$request_controller.";requested action - ".$request_action);
							// No access to action, try to get default action for this controller
							$action_model = new ActionModel;
							$action_model -> loadDefault($controller_model -> id);
							if (($action_model -> id > 0) && $reflection -> hasMethod($action_model -> name . 'Action')){
								// Default action is defined and exists
								if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
									// We have access for requestd controller and default action
									$this -> setData($controller_model, $action_model);
								} else {
									// No access to default action
									$this -> accessLog(__METHOD__, __LINE__, "No access to default action of requested controller: requested controller - ".$request_controller.";requested action - ".$request_action); 
									$load_default = true;
								}
							} else {
								// No exists default action for requested controller
								$this -> accessLog(__METHOD__, __LINE__, "No exists default action for requested controller: requested controller - ".$request_controller.";requested action - ".$request_action.";default action - ".$action_model -> name);
								$load_default = true;
							}
						}
					} else {
						// No exists action, try to get default action for this controller
						$action_model = new ActionModel;
						$action_model -> loadDefault($controller_model -> id);
						if (($action_model -> id > 0) && $reflection -> hasMethod($action_model -> name . 'Action')){
							// Default action is defined and exists
							if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
								// We have access for requestd controller and default action
								$this -> setData($controller_model, $action_model);
							} else {
								// No access to default action of requested controller
								$this -> accessLog(__METHOD__, __LINE__, "No access to default action for requested controller: requested controller - ".$request_controller.";requested action - ".$request_action.";default action - ".$action_model -> name);
								$load_default = true;
							}
						} else {
							// No default action for requested controller
							$this -> accessLog(__METHOD__, __LINE__, "No default action for requested controller: requested controller - ".$request_controller.";requested action - ".$request_action);
							$load_default = true;
						}
					}
				} else {
					// Requested controller not exists at list
					$this -> accessLog(__METHOD__, __LINE__, "Requested controller not exists: requested controller - ".$request_controller);
					$load_default = true;
				}
				
				$get_login = false;
				if ($load_default === true){
					// Load default controller and action
					$controller_model = new ControllerModel;
					// TODO:: how to check, if we need default admin or user controller? 
					$controller_model -> loadDefault($admin = false);
					if ($controller_model -> id > 0){
						// Default controller exists and load default action of it
						$reflection = new ReflectionClass($controller_model -> name);
						$action_model = new ActionModel;
						$action_model -> loadDefault($controller_model -> id);
						if (($action_model -> id > 0) && $reflection -> hasMethod($action_model -> name . 'Action')){
							// Default action exists
							if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
								// Has access to default
								$this -> setData($controller_model, $action_model);
							} else {
								// No access to default controller and action, so get login
								$this -> accessLog(__METHOD__, __LINE__, "No access to default controller and action, so get login: default controller - ".$controller_model -> name.";default action - ".$action_model -> name);
								$get_login = true;
							}
						} else {
							// Default action not exists at default controller
							$this -> accessLog(__METHOD__, __LINE__, "No default action at default controller: default controller - ".$controller_model -> name.";default action - ".$action_model -> name);
							$get_login = true;
						}
					} else {
						// Default controller not exists
						$this -> accessLog(__METHOD__, __LINE__, "Default controller not exists: default controller - ".$controller_model -> name);
						$get_login = true;
					}
				}
				
				if ($get_login === true){
					$controller_model = new ControllerModel;
					$controller_model -> loadByKey($this -> _login_controller);
					if ($controller_model -> id > 0){
						// Login controller exists at database list
						$reflection = new ReflectionClass($controller_model -> name);
						$action_model = new ActionModel;
						$action_model -> loadByKey($this -> _login_action);
						if (($action_model -> id > 0) && $reflection -> hasMethod($action_model -> name . 'Action')){
							// Login action exists at login controller
							$this -> setData($controller_model, $action_model);
						} else {
							throw new SecurityException('Critical security error: login action not defined at configuration');
						}
					} else {
						throw new SecurityException('Critical security error: login controller not defined at configuration');
					}
				}
			}
			
			private function accessLog($method, $line, $str){
				if ( ($logger = Project::get($this -> _config -> get('logger_id'))) !== null){
					$logger -> writeLog($method."::".$line."::".$str);
				}
			}
			
			function needAutorization(){
				return $this -> _needAutorization;
			}
			
			function getLoginService(){
				return $this -> _login_service;
			}
			
			function getDefaultService(){
				return $this -> _default_service;
			}
}
?>

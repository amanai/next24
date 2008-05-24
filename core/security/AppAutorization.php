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
				$load_default = false;
				$request_action = $request -> getAction();
				$action_model = new ActionModel;
				$action_model -> loadByRequestKey($request_action);
				if ((int)$action_model -> id > 0){
					// requested action exists
					$controller_model = new ControllerModel;
					$controller_model -> load($action_model -> controller_id);
					if ((int)$controller_model -> id > 0){
						// controller exists
						$reflection = new ReflectionClass($controller_model -> name);
						if ($reflection -> hasMethod($action_model -> name . 'Action')){
							// Action exists at controller
							if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
								// Have access to requested action
								$this -> setData($controller_model, $action_model);
							} else {
								$this -> accessLog(__METHOD__, __LINE__, "No access to requested action: requested action - ".$request_action.";controller - ".$controller_model -> name);
								// No access to action. try to get default action of controller
								$action_model = new ActionModel;
								$action_model -> loadDefault($controller_model -> id);
								if ($action_model -> id > 0){
									// Action exists at database
									if ($reflection -> hasMethod($action_model -> name . 'Action')){
										// Action method exists at controller class
										if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
											// Have access to default action of requested controller (by requested action)
											$this -> setData($controller_model, $action_model);
										} else {
											// No access to default action : try to load default controller and action
											$this -> accessLog(__METHOD__, __LINE__, "No access to default action of requested action's controller: default action - ".$action_model -> name.";controller - ".$controller_model -> name);
											$load_default = true;
										}
									} else {
										// Default action not exists at controller
										$this -> accessLog(__METHOD__, __LINE__, "Default action method not exists at controller class: default action - ".$action_model -> name.";controller - ".$controller_model -> name);
										$load_default = true;
									}
								} else {
									// Default action not exists at database (default in controller of requested action)
									$this -> accessLog(__METHOD__, __LINE__, "Default action not exists at database: controller - ".$controller_model -> name);
									$load_default = true;
								}
							}
						} else {
							// No access to requested action:: get default action of this controller
							$this -> accessLog(__METHOD__, __LINE__, "Requested action method not exists at controller class: default action - ".$action_model -> name.";controller - ".$controller_model -> name);
							$action_model = new ActionModel;
							$action_model -> loadDefault($controller_model -> id);
							if ($action_model -> id > 0){
								// Action exists at database
								if ($reflection -> hasMethod($action_model -> name . 'Action')){
									// Action method exists at controller class
									if ($auth -> checkAccess($controller_model -> id, $action_model -> id) === true){
										// Have access to default action of requested controller (by requested action)
										$this -> setData($controller_model, $action_model);
									} else {
										// No access to default action : try to load default controller and action
										$this -> accessLog(__METHOD__, __LINE__, "No access to default action of requested action's controller: default action - ".$action_model -> name.";controller - ".$controller_model -> name);
										$load_default = true;
									}
								} else {
									// Default action not exists at controller
									$this -> accessLog(__METHOD__, __LINE__, "Default action method not exists at controller class: default action - ".$action_model -> name.";controller - ".$controller_model -> name);
									$load_default = true;
								}
							} else {
								// Default action not exists at database (default in controller of requested action)
								$this -> accessLog(__METHOD__, __LINE__, "Default action not exists at database: controller - ".$controller_model -> name);
								$load_default = true;
							}
						}
					} else {
						// Controller not exists
						$load_default = true;
						$this -> accessLog(__METHOD__, __LINE__, "Controller not exists at database: requested action - ".$request_action);
					}
				} else {
					// Requested action not exists
					$load_default = true;
					$this -> accessLog(__METHOD__, __LINE__, "Requested action not exists at database: requested action - ".$request_action);
				}
				
				$get_login = false;
				if ($load_default === true){
					// Load default controller and action
					$controller_model = new ControllerModel;
					// TODO:: how to check, if we need default admin or user controller? 
					$controller_model -> loadDefault($admin = true);
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
						$action_model -> loadByKey($controller_model -> id, $this -> _login_action);
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

				Project::getRequest() -> setController($controller_model -> request_key);
				if (($controller_model -> id > 0) && ($action_model -> id > 0)){
					if ( $action_model -> request_key != $request_action ){
						//var_dump($get_login, $load_default,$controller_model -> name, $request_controller, $action_model -> name, $request_action);die;
						if ($get_login || $load_default){
							// If controllers is not equal to requested
							$url = Project::getRequest() -> createUrl($controller_model -> request_key, $action_model -> name);
							// TODO:: check, if it's ajax request, then change location!!!
							//Project::getAjaxResponse() -> location($url);
							Project::getResponse() -> redirect($url);
						}
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

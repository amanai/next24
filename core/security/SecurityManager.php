<?php
if (class_exists('SecurityManager')) die();

class SecurityManager extends ApplicationManager implements IManager{
	private $_autorization;
	private $_auth;
	
			function initialize(IConfigParameter $configuration){
				$this -> _autorization = new AppAutorization();
				$this -> _autorization -> initialize($configuration);
				$user_class = $configuration -> get('user', false);
				if (!$user_class){
					$user_class = 'AppUser';
				}
				Project::getSession() -> open();
				Project::setUser(new $user_class($this -> _autorization));
				$this -> _auth = new AppAuth($this -> _autorization);
				Project::setSecurityManager($this);
				$this -> _autorization -> procees($this -> _auth);
			}
			
			function getAuth(){
				return $this -> _auth;
			}
			
			function getAutorize(){
				return $this -> _autorization;
			}
			
			function login($login, $pwd){
				$user_model = Project::getUser() -> login($login, $pwd);
				if ( $user_model !== false){
					// Set current user as logged
					Project::getUser() -> setIsLogged($user_model);
					// Reinit user rights and access list
					$this -> _auth -> init($this -> _autorization);
					return true;
				} else {
					return false;
				}
			}
			
			function logout(){
				Project::getUser() -> setIsGuest();
				$this -> _auth -> init($this -> _autorization);
			}
}
?>
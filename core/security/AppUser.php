<?php
class AppUser{
	private $_guest;
	private $_dbUser;
			function __construct(IManager $autorization){
				$this -> _dbUser = new UserModel();
				if ($autorization -> needAutorization() === true){
					$session = Project::getSession();
					$logged = $session -> getKey('logged', false);
					if ($logged) {
						$this -> _guest = false;
						$this -> _dbUser -> load($session -> getKey('logged_user_id'));
					} else {
						$this -> _guest = true;
					}
				} else {
					$this -> _guest = true;
				}
			}
			
			function isGuest(){
				return $this -> _guest;
			}
			
			function setIsLogged($dbUser){
				$session = Project::getSession();
				$session -> add('logged', true);
				$session -> add('logged_user_id', (int)$dbUser -> id);
				$this -> _guest = false;
			}
			
			function logout(){
				$session = Project::getSession();
				$session -> clear();
				$this -> _guest = true;
			}
			
			function getDbUser(){
				return $this -> _dbUser;
			}
}
?>

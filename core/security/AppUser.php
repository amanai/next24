<?php
class AppUser{
	private $_guest;
	private $_dbUser;
	private $_showed_user;
	private $_is_my_area = false;
	private $_is_friend = false;
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
				
				
				$username = Project::getRequest() -> getUsername();
				$this -> _showed_user = new UserModel;
				if ($username){
					$this -> _showed_user -> loadByLogin($username);
					if ((int)$this -> _showed_user -> id > 0){
						if ($this -> _showed_user -> id == $this -> _dbUser -> id){
							$this -> _is_my_area = true;
							$this -> _is_friend = true;
						} else {
							$friend_model = new FriendModel;
							$friend_id = (int)$friend_model -> isFriend($this -> _showed_user -> id, $this -> _dbUser -> id);
							if ($friend_id == $this -> _dbUser -> id){
								$this -> _is_friend = true;
							}
						}
					}
				}
			}
			
			function isGuest(){
				return $this -> _guest;
			}
			
			function setIsGuest(){
				$session = Project::getSession();
				$session -> clear();
				$this -> _guest = true;
				$this -> _dbUser =  new UserModel;
			}
			
			function setIsLogged($dbUser){
				$session = Project::getSession();
				$session -> add('logged', true);
				$session -> add('logged_user_id', (int)$dbUser -> id);
				$this -> _guest = false;
				$this -> _dbUser = $dbUser;
			}
			
			function login($user, $pwd){
				$res = $this -> _dbUser -> login($user, $pwd);
				if ($res){
					return $this -> _dbUser;
				} else {
					return false;
				}
			}
			
			function getDbUser(){
				return $this -> _dbUser;
			}
			
			/**
			 * True only if showed subdomain is for current logged user
			 */
			function isMyArea(){
				return $this -> _is_my_area;
			}
			
			function getShowedUser(){
				return $this -> _showed_user;
			}
			
			function isFriend(){
				return $this -> _is_friend;
			}

}
?>

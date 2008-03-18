<?php
class UserModel extends BaseModel{
		function __construct(){
			parent::__construct('users');
		}
		
		function login($login, $pwd){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE login=? AND pass=?", $login, $pwd);
			if (count($result) > 0){
				$this -> bind($result);
				return true;
			} else {
				return false;
			}
		}
		
		/** 
		 * Get user group object
		 * */
		function getUserType(){
			$o = new UserTypeModel();
			if ($this -> user_type_id > 0){
				$o -> load($this -> user_type_id);
			}
			return $o;
		}
		
		function loadByLogin($login){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE login=? LIMIT 1", $login);
			$this -> bind($result);
		}
		
		function &getBlog(){
			$blog_model = new BlogModel;
			$blog_model -> loadByUserId($this -> id);
			return $blog_model;
		}
		
		function ban($user_id){
			Project::getDatabase() -> selectRow("UPDATE ".$this -> _table." SET banned=1 WHERE id=?d ", (int)$user_id);
		}
		
		function unban($user_id){
			Project::getDatabase() -> selectRow("UPDATE ".$this -> _table." SET banned=0 WHERE id=?d ", (int)$user_id);
		}
}
?>
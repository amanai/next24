<?php
class UserRightModel extends BaseModel{
	
		function __construct(){
			parent::__construct('user_right');
		}
		
		function loadByUserType($user_type_id){
			$DE = Project::getDatabase();
			return $DE -> select("SELECT * FROM ".$this -> _table." WHERE user_type_id=?d", (int)$user_type_id);
		}
		
		function loadControllersByUserType($user_type_id){
			$DE = Project::getDatabase();
			$sql = "SELECT " .
										" ur.id as id, " .
										" ur.controller_id as controller_id, " .
										" CAST(ur.access AS UNSIGNED) as access, " .
										" c.name as name " .
								" FROM ".$this -> _table." as ur " .
								" INNER JOIN controller c ON c.id = ur.controller_id " .
								" WHERE " .
									" ur.user_type_id=?d " .
									" GROUP BY ur.controller_id";
			return $DE -> select($sql, (int)$user_type_id);
		}
		
		function loadByTypeControllerAction($user_type_id, $controller_id, $action_id){
			$DE = Project::getDatabase();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE user_type_id = ?d AND controller_id=?d AND action_id = ?d", (int)$user_type_id, (int)$controller_id, (int)$action_id);
			$this -> bind($result);
			return $result;	
		}
}
?>
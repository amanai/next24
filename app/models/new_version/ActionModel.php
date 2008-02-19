<?php
class ActionModel extends BaseModel{
		function __construct(){
			parent::__construct('action');
		}
		
		function loadByKey($controller_id, $key){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE LOWER(name)=LOWER(?) AND controller_id=?d LIMIT 1", $key, (int)$controller_id);
			$this -> bind($result);
			return $result;
		}
		
		function loadDefault($controller_id){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE controller_id=?d AND `default` = 1", (int)$controller_id);
			$this -> bind($result);
			return $result;
		}
		
		function getRightsByUserTypeController($user_type_id, $controller_id){
			$DE = Project::getDatabase();
			$sql = "SELECT " .
										" a.id as id, " .
										" a.`default` as `default`, " .
										" a.page_title as page_title, " .
										" CAST(ur.access AS UNSIGNED) as access, " .
										" a.name as name " .
								" FROM ".$this -> _table." as a " .
								" LEFT JOIN user_right ur ON ur.controller_id = a.controller_id AND ur.user_type_id = ?d AND action_id = a.id" .
								" WHERE " .
									" a.controller_id = ?d " .
									" GROUP BY a.id";
			return $DE -> select($sql, (int)$user_type_id, (int)$controller_id);
		}
}
?>
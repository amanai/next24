<?php
class UserRightModel extends BaseModel{
	
		function __construct(){
			parent::__construct('user_right');
		}
		
		function loadByUserType($user_type_id){
			$DE = Project::getDatabase();
			return $DE -> select("SELECT * FROM ".$this -> _table." WHERE user_type_id=?d", (int)$user_type_id);
		}
}
?>
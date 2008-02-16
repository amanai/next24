<?php
class ControllerModel extends BaseModel{
		function __construct(){
			parent::__construct('controller');
		}
		
		function loadByKey($key){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE LOWER(request_key)=LOWER(?) LIMIT 1", $key);
			$this -> bind($result);
			return $result;
		}
		
		function loadDefault($admin = true){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE default=1 AND admin=?d LIMIT 1", $admin);
			$this -> bind($result);
			return $result;
		}
}
?>
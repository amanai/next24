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
}
?>
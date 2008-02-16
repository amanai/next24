<?php
class ActionModel extends BaseModel{
		function __construct(){
			parent::__construct('action');
		}
		
		function loadDefault($controller_id){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE controller_id=?d AND default=1 LIMIT 1", $controller_id);
			$this -> bind($result);
			return $result;
		}
}
?>
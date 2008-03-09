<?php
class ParamGroupModel extends BaseModel{
		function __construct(){
			parent::__construct('param_group');
		}
		
		
		function loadAll(){
			$DE = Project::getDatabase();
			$sql = "SELECT " .
					" pg.id as id," .
					" c.name as label," .
					" c.id as controller_id," .
					" count(p.id) as count_param," .
					" c.description as controller_description  " .
				   " FROM controller as c " .
				   " LEFT JOIN param_group pg ON LOWER(c.name) = LOWER(pg.label) " .
				   " LEFT JOIN param p ON p.param_group_id=pg.id " .
				   " GROUP BY c.id ";
			
			return $DE -> select($sql);
		}
		
		function loadByLabel($label){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE label = ?", $label);
			$this -> bind($result);
			return $result;
		}
}
?>
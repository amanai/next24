<?php
class StateModel extends BaseModel{
		function __construct(){
			parent::__construct('regions');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}
		
		function loadByCountry($country_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE country_id=?d ORDER BY name", (int)$country_id);
		}
		function getStateNameById($id) {
			return Project::getDatabase() -> selectCell("SELECT name FROM ".$this -> _table." WHERE id=?d ORDER BY name", (int)$id);
		}
}
?>
<?php
class CityModel extends BaseModel{
		function __construct(){
			parent::__construct('city');
		}
		
		function loadAll(){
			return parent::loadAll('title');
		}
		
		function loadByState($state_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE state_id=?d ORDER BY title", (int)$state_id);
		}
		
		
}
?>
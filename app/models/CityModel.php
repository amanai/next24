<?php
class CityModel extends BaseModel{
		function __construct(){
			parent::__construct('cities');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}
		
		function loadByState($state_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE region_id=?d ORDER BY name", (int)$state_id);
		}
		
		function loadByCountry($country_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE country_id=?d ORDER BY name", (int)$country_id);
		}
		
}
?>
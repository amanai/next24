<?php
class StateModel extends BaseModel{
		function __construct(){
			parent::__construct('state');
		}
		
		function loadAll(){
			return parent::loadAll('title');
		}
		
		function loadByCountry($country_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE country_id=?d ORDER BY title", (int)$country_id);
		}
}
?>
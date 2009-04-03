<?php
class CountryModel extends BaseModel{
		function __construct(){
			parent::__construct('countries');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}
		function getCountryNameById($id) {
			return Project::getDatabase() -> selectCell("SELECT name FROM ".$this -> _table." WHERE id=?d ORDER BY name", (int)$id);
		}
}
?>
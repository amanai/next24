<?php
class GeoSubtypeModel extends BaseModel{
		function __construct(){
			parent::__construct('geo_subtypes');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}		
		
		function loadByType($geo_type_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE geo_type_id=?d ORDER BY name", (int)$geo_type_id);
		}
}
?>
<?php
class GeoPlaceModel extends BaseModel{
		function __construct(){
			parent::__construct('geo_places');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}		
		
		function load($geo_subtype_id, $city_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE geo_subtype_id=?d AND city_id=?d ORDER BY name", (int)$geo_subtype_id, (int)$city_id);
		}
		
		function loadById($id) {
			$result=Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE `id`=?d ORDER BY name", (int)$id);
			$this->bind($result[0]);
		}
}
?>
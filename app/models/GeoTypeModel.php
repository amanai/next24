<?php
class GeoTypeModel extends BaseModel{
		function __construct(){
			parent::__construct('geo_types');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}		
}
?>
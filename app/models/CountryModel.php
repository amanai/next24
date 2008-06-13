<?php
class CountryModel extends BaseModel{
		function __construct(){
			parent::__construct('countries');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}
}
?>
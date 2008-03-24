<?php
class CountryModel extends BaseModel{
		function __construct(){
			parent::__construct('country');
		}
		
		function loadAll(){
			return parent::loadAll('title');
		}
}
?>
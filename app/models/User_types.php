<?php
	class User_types extends CBaseModel{
		
		function loadAll(){
			$this -> resetSql();
			return $this -> getAll();
		}
	}
?>

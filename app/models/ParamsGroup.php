<?php
	class ParamsGroup extends CBaseModel{
		
		function __construct($id = null){
				$this -> tableName = 'params_group';
				parent::__construct($id);
			}
		
		
	}
?>
<?php
class BlogTree extends CBaseModel{
			function __construct($id = null){
				$this -> tableName = 'ub_tree';
				parent::__construct($id);
			}
	}
?>
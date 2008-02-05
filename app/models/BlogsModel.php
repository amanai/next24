<?php
class BlogsModel extends CBaseModel{
			function __construct($id = null){
				$this -> tableName = 'blogs';
				parent::__construct($id);
			}
	}
?>
<?php
class BlogsCatalog extends CBaseModel{
			function __construct($id = null){
				$this -> tableName = 'blogs_catalog';
				parent::__construct($id);
			}
	}
?>
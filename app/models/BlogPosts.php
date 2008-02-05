<?php
class BlogPosts extends CBaseModel{
			function __construct($id = null){
				$this -> tableName = 'blog_posts';
				parent::__construct($id);
			}
	}
?>
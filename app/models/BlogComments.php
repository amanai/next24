<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CommentModel.php');
class BlogComments extends CommentModel{
			function __construct($id = null){
				$this -> tableName = 'blog_comments';
				parent::__construct('blog_post_id', $id);
			}
	}
?>
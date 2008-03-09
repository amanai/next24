<?php
class BlogCommentModel extends CommentModel{
	
		
		function __construct($id = 0){
			parent::__construct('blog_comment', 'blog_post_id', $id);
			
			
		}
		
}
?>
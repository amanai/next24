<?php
class BlogCommentModelSocieties extends CommentModel{	
		function __construct($id = 0){
			parent::__construct('blog_comment_societies', 'blog_id', $id);		
		}	
}
?>
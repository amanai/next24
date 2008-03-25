<?php 

class ArticleCommentModel extends CommentModel {
	
	
	function __construct($id = 0){
		parent::__construct('article_comment', 'article_id', $id);
	}
	
}

?>
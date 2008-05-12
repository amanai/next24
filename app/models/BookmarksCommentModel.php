<?php 
/*
  Модель: добавления комментария для Закладок
*/
class BookmarksCommentModel extends CommentModel {
	
	
	function __construct($id = 0){
		parent::__construct('bookmarks_comments', 'bookmark_id', $id);
	}
	
}

?>
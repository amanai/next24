<?php 
/*
  Модель: добавления комментария для Соц.позиции
*/
class SocialCommentModel extends CommentModel {
	
	
	function __construct($id = 0){
		parent::__construct('social_comments', 'social_pos_id', $id);
	}
	
}

?>
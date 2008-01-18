<?php

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CommentModel.php');

class PhotoCommentModel extends CommentModel{
	
		
		function __construct($id = null){
			parent::__construct('photo_id', $id);
			$this -> tableNameDB = 'photo_comments';
		}
		
}
?>
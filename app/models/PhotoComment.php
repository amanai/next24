<?php

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CommentModel.php');

class PhotoComment extends CommentModel{
	
		
		function __construct($id = null){
			$this -> tableName = 'photo_comments';
			parent::__construct('photo_id', $id);
			
		}
		
}
?>
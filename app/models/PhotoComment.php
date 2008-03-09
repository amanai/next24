<?php

class PhotoComment extends CommentModel{
	
		
		function __construct($id = 0){
			parent::__construct('photo_comment', 'photo_id', $id);
			
			
		}
		
}
?>
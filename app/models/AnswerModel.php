<?php 

class AnswerModel extends CommentModel {
	
	
	function __construct($id = 0){
		parent::__construct('answers', 'question_id', $id);
		//$this->tableName = 'answers';
	}
	
}

?>
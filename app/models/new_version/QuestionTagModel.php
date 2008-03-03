<?php

class QuestionTagModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('question_tags');
	}
	
	public function loadByCat($catId) {
		$sql = "SELECT ".
					"question_tags.* ".
					"FROM question_tags ".
					"JOIN qq_tags ".
					"ON qq_tags.question_tag_id = question_tags.id ".
					"WHERE qq_tags.cat_id = ?d ".
					"GROUP BY question_tags.id";
		return Project::getDatabase()->select($sql, $catId);
	}
	
}

?>
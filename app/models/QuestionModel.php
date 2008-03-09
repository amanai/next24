<?php

class QuestionModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('questions');
	}
	
	public function loadWhere($catId = null, $tagId = null, $userId = null) {
		$sql = "SELECT ".
					 "questions.`id`,". 
					 "questions.`questions_cat_id`,".
					 "questions.`a_count`,".
					 "questions.`q_text`,".
					 "questions.`user_id`,". 
					 "questions.`creation_date`,".
					 "users.`login` ".
					 "FROM questions ".
					 "LEFT JOIN users ".
					 "ON questions.`user_id` = users.`id` ";
					 if($tagId !== null) {
					 	$sql.=  "JOIN qq_tags ".
					 			"ON qq_tags.`question_id` = questions.`id` ".
					 			"JOIN question_tags ".
					 			"ON question_tags.`id` = qq_tags.`question_tag_id` ".
					 			"WHERE question_tags.`id` = ?d";
					 	($catId !== null) ? $sql.=" AND questions.questions_cat_id = ?d" : "";
					    ($userId !== null) ? $sql.=" AND questions.user_id = ?d" : "";
					 } else {
					 	if ($catId !== null) {
					 		$sql.=" WHERE questions.questions_cat_id = ?d";	
					 		($userId !== null) ? $sql.=" AND questions.user_id = ?d" : "";
					 	} else {
					 		if($userId !== null) {
					 			$sql.=" WHERE questions.user_id = ?d";
					 		}
					 	}
					 }
					 $sql.=" ORDER BY questions.`creation_date` DESC LIMIT ?d, ?d";
				//die($sql);
		$this->checkPager();
		$params = array();
		$params[] = $this->_countRecords;
		$params[] = $sql;
		if($tagId !== null) $params[] = $tagId;
		if($catId !== null) $params[] = $catId;
		if($userId !== null) $params[] = $userId;
		$params[] = $this->_pager->getStartLimit();
		$params[] = $this->_pager->getPageSize();
		$result = call_user_func_array(array(Project::getDatabase(), 'selectPage'), $params);
		//$this->updatePagerAmount();
		return $result;
	}

	public function loadQuestion($id) {
		$id = (int)$id;
		$sql = "SELECT ".
					 "questions.`id`,". 
					 "questions.`questions_cat_id`,".
					 "questions.`a_count`,".
					 "questions.`q_text`,".
					 "questions.`user_id`,". 
					 "questions.`creation_date`,".
					 "users.`login` ".
					 "FROM questions ".
					 "LEFT JOIN users ".
					 "ON questions.`user_id` = users.id ".
					 "WHERE questions.`id` = ?d";
		$result = Project::getDatabase()->selectRow($sql, $id);
		$this->bind($result);
		return $result;
	}	
}

?>
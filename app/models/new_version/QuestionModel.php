<?php

class QuestionModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('questions');
	}
	
	public function loadAll() {
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
					 "ON questions.`user_id` = users.`id` LIMIT ?d, ?d";
		$this->checkPager();
		$result = Project::getDatabase()->selectPage($this->_countRecords, $sql, $this->_pager->getStartLimit(), $this->_pager->getPageSize());
		$this->updatePagerAmount();
		return $result;
	}
	
	public function loadByCat($catId) {
		$catId = (int)$catId;
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
					 "ON questions.`user_id` = users.`id` ".
					 "WHERE questions.`questions_cat_id` = ?d LIMIT ?d, ?d";
		$this->checkPager();
		$result = Project::getDatabase()->selectPage($this->_countRecords, $sql, $catId, $this->_pager->getStartLimit(), $this->_pager->getPageSize());
		$this->updatePagerAmount();
		return $result;					
	}
	
	public function loadByTag($tagId) {
		$tagId = (int)$tagId;
		$sql = "SELECT ". 
					"questions.`id`,". 
					"questions.`questions_cat_id`,".
					"questions.`a_count`,".
					"questions.`q_text`,".
					"questions.`user_id`,". 
					"questions.`creation_date`,".
					"users.`login` ".
					"FROM questions ".
					"JOIN qq_tags ".
					"ON qq_tags.`question_id` = questions.`id` ".
					"JOIN question_tags ".
					"ON question_tags.`id` = qq_tags.`question_tag_id` ".
					"JOIN users ".
					"ON questions.`user_id` = users.`id` ".
					"WHERE question_tags.`id` = ?d LIMIT ?d, ?d";
		$this->checkPager();
		$result = Project::getDatabase()->selectPage($this->_countRecords, $sql, $tagId, $this->_pager->getStartLimit(), $this->_pager->getPageSize());
		$this->updatePagerAmount();
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
		return Project::getDatabase()->selectRow($sql, $id);
	}
	
	
	
}

?>
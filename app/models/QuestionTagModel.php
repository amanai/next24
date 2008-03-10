<?php

class QuestionTagModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('question_tags');
	}
	
	public function loadWhere($catId = null, $tagName = null, $questionId = null, $userId = null) {
		$catId = (int)$catId;
		$tagName = (int)$tagName;
		$questionId = (int)$questionId;
		$userId = (int)$userId;
		$sql =  "SELECT ".
				"t.id, t.name ".
				"FROM question_tags AS t ".
				"JOIN qq_tags AS qt ON qt.question_tag_id = t.id ".
				"JOIN questions AS q ON q.id = qt.question_id ";
				($catId > 0) ? $sql.="WHERE q.questions_cat_id=?d " . (($tagName > 0) ? "AND LOWER(t.name)=LOWER(?s)" : "") . (($questionId > 0) ? "AND qt.question_id = ?d" : "") : (($tagName > 0) ? $sql.="WHERE LOWER(t.name)=LOWER(?s)" : ($questionId > 0) ? $sql.="WHERE qt.question_id = ?d" : "");
		$params = array();
		$params[] = $sql;
		if($catId > 0) $params[] = $catId;
		if($tagName > 0) $params[] = $tagName;
		if($questionId > 0) $params[] = $questionId;
		$result = call_user_func_array(array(Project::getDatabase(), 'select'), $params);	
		return $result;
	}
	
	public function loadByName($tagName) {
		$sql = "SELECT * FROM question_tags WHERE LOWER(question_tags.name) = LOWER(?s)";
		$result =  Project::getDatabase()->selectRow($sql, $tagName);
		$this->bind($result);
		return $result;
	}
	
	
	/********************
	/* Используется для формирования облака тегов, выбирает кол-во вопросов по тегу 
	/* и имя тега, передается ид категории
	/********************/
	
	public function loadTags($catId) {
		$sql = "select  count(qt.question_tag_id) as count, t.name as name from question_tags as t join qq_tags as qt on qt.question_tag_id = t.id join questions as qs on qs.id = qt.question_id where qs.questions_cat_id = ?d group by qt.question_tag_id";
		return Project::getDatabase()->select($sql, $catId);
	}
	
	
}

?>
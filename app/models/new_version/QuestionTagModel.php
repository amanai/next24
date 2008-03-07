<?php

class QuestionTagModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('question_tags');
	}
	
	public function loadWhere($catId = null, $tagName = null) {
		$sql =  "SELECT ".
				"t.id, t.name ".
				"FROM question_tags AS t ".
				"JOIN qq_tags AS qt ON qt.question_tag_id = t.id ".
				"JOIN questions AS q ON q.id = qt.question_id ";
				($catId !== null) ? $sql.="WHERE q.questions_cat_id=?d " . (($tagName !== null) ? "AND LOWER(t.name)=LOWER(?s)" : "") : (($tagName !== null) ? $sql.="WHERE LOWER(t.name)=LOWER(?s)" : "");
		$sql.=  " LIMIT 1";
		$params = array();
		$params[] = $sql;
		if($catId !== null) $params[] = $catId;
		if($tagName !== null) $params[] = $tagName;
		$result = call_user_func_array(array(Project::getDatabase(), 'selectRow'), $params);	
		//die($sql);
		$this->bind($result);
		return $result;
	}
	
	
	/********************
	/* Используется для формирования облака тегов, выбирает кол-во вопросов по тегу 
	/* и имя тега, передается ид категории
	/********************/
	
	public function loadTags($catId) {
		$sql = "select  count(qt.question_tag_id) as count,t.id, t.name as name from question_tags as t join qq_tags as qt on qt.question_tag_id = t.id join questions as qs on qs.id = qt.question_id where qs.questions_cat_id = ?d group by qt.question_tag_id";
		return Project::getDatabase()->select($sql, $catId);
	}
	
	
}

?>
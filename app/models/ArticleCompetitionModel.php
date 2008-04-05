<?php

class ArticleCompetitionModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('article_copetition');
	}
	
	public function selectEndCompetition() {
		$sql = "SELECT * FROM $this->_table a WHERE a.`data_end` <= curdate();";
		return Project::getDatabase()->select($sql);
	}
	
	public function loadWhere($articleTreeId, $dataBegin = null, $dataEnd = null) {
		$sql = "SELECT * FROM $this->_table a WHERE a.`article_tree_id` = ?d ";
		$dataBegin !== null ? $sql .= "AND a.`data_begin` >= $dataBegin AND a.`data_end` < $dataBegin " : "";
		$dataEnd !== null ? $sql .= "AND a.`data_end` <= $dataEnd AND a.`data_begin` > $dataEnd" : "";
		return Project::getDatabase()->select($sql, $articleTreeId); 
	}
	
	
}

?>
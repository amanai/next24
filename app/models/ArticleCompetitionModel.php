<?php

class ArticleCompetitionModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('article_competition');
	}
	
	public function selectEndCompetition() {
		$sql = "SELECT * FROM $this->_table a WHERE a.`data_end` <= curdate();";
		return Project::getDatabase()->select($sql);
	}
	
	public function loadWhere($articleTreeId, $dataBegin = null, $dataEnd = null) {
		$sql = "SELECT * FROM $this->_table a WHERE a.`id_article_tree` = ?d ";
		$dataBegin !== null ? $sql .= "AND ((a.`data_begin` <= '$dataBegin' AND a.`data_end` > '$dataBegin') " : "";
		$dataEnd !== null ? $sql .= "OR (a.`data_end` >= '$dataEnd' AND a.`data_begin` < '$dataEnd'))" : ")";
		//die($sql);
		return Project::getDatabase()->select($sql, $articleTreeId); 
	}
	
	
}

?>
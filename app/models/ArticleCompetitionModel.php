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
		//TODO:
	}
	
	
}

?>
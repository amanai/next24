<?php

class ArticleVoteModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("article_votes");
	}
	
	public function loadByArticleUser($articleId, $userId) {
		$articleId = (int)$articleId;
		$userId = (int)$userId;
		$sql = "SELECT * FROM $this->_table WHERE article_id = ?d AND user_id = ?d";
		$result = Project::getDatabase()->selectRow($sql, $articleId, $userId);
		$this->bind($result);
		return $result;
	}
	
}
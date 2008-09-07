<?php

class ArticleVoteModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("article_votes");
	}
	
	public function loadByArticleUser($articleId, $userId) {
		$articleId = (int)$articleId;
		$userId = (int)$userId;
		$sql = 	"SELECT * FROM $this->_table ";
		$articleId > 0 ? $sql .= "WHERE article_id = ?d AND user_id = ?d" : $sql .= "WHERE user_id = ?d";
		$params = array();
		$params[] = $sql;
		$articleId > 0 ? $params[] = $articleId : "";
		$params[] = $userId;
		$result = call_user_func_array(array(Project::getDatabase(), 'select'), $params);
		$this->bind($result);
		return $result;
	}
	
	public function loadByArticleId($articleId) {
		$articleId = (int)$articleId;
		$sql = "SELECT * FROM $this->_table WHERE article_id = ?d";
		return Project::getDatabase()->select($sql, $articleId);
	}
	
	public function deleteByArticleId($articleId) {
		$articleId = (int)$articleId;
		$sql = "DELETE FROM $this->_table WHERE article_id = ?d";
		return Project::getDatabase()->query($sql, $articleId);
	}
	
	public function rateByArticleId($articleId) {
		$articleId = (int)$articleId;
		$sql = "SELECT AVG(vote) as vote_result FROM article_votes WHERE article_id = ?d";
		return Project::getDatabase()->selectRow($sql, $articleId);
	}
	
}
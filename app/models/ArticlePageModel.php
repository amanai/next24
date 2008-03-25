<?php

class ArticlePageModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("article_pages");
	}
	
	public function loadByArticleId($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM article_pages WHERE article_id = ?d";
		return Project::getDatabase()->select($sql, $id);
	}
	
}

?>
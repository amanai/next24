<?php

class ArticleModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("articles");
	}
	
	public function loadByParentId($id) {
		$id = (int)$id;
		$sql =  "SELECT ".
				"a.`id`, ".
				"a.`articles_tree_id`, ".
				"a.`user_id`, ".
				"a.`title`, ".
				"a.`allowcomments`, ".
				"a.`rate_status`, ".
				"a.`rate`, ".
				"a.`votes`, ".
				"a.`comments`, ".
				"a.`views`, ".
				"a.`creation_date` ".
				"FROM articles a ".
				"LEFT JOIN users u ".
				"ON a.`user_id` = u.`id` ".
				"WHERE a.`articles_tree_id` = ?d";
		return Project::getDatabase()->select($sql, $id);
	}
	
	public function loadWhere($userId, $sortName, $sortOrder) {
		$userId = (int)$userId;
		$sortName == null ? $sortName = 'a.creation_date' : "";
		$sortOrder == null ? $sortOrder = 'DESC' : "";
		$sql = "SELECT ".
				"a.`id`, ".
				"a.`articles_tree_id`, ".
				"a.`user_id`, ".
				"a.`title`, ".
				"a.`allowcomments`, ".
				"a.`rate_status`, ".
				"a.`rate`, ".
				"a.`votes`, ".
				"a.`comments`, ".
				"a.`views`, ".
				"a.`creation_date`, ".
				"u.`login`, ".
				"at.`name` ".
				"FROM articles a ".
				"LEFT JOIN users u ".
				"ON a.`user_id` = u.`id` ".
				"LEFT JOIN articles_tree at ".
				"ON a.`articles_tree_id` = at.`id` ";
				$userId > 0 ? $sql .= "WHERE a.`user_id` = ?d " : "";
				$sql .= "ORDER BY $sortName $sortOrder  LIMIT ?d, ?d ";
		$params = array();
		$params[] = $this->_countRecords;
		$params[] = $sql;
		if($userId > 0) $params[] = $userId;
		$params[] = $this->_pager->getStartLimit();
		$params[] = $this->_pager->getPageSize();
		$result = call_user_func_array(array(Project::getDatabase(), 'selectPage'), $params);
		echo $sql;
		//$this->updatePagerAmount();
		return $result;
	}
	
	public function loadArticle($id) {
		$id = (int)$id;
		$sql = "SELECT ".
				"a.`id`, ".
				"a.`articles_tree_id`, ".
				"a.`user_id`, ".
				"a.`title`, ".
				"a.`allowcomments`, ".
				"a.`rate_status`, ".
				"a.`rate`, ".
				"a.`votes`, ".
				"a.`comments`, ".
				"a.`views`, ".
				"a.`creation_date`, ".
				"u.`login`, ".
				"at.`name` ".
				"FROM articles a ".
				"LEFT JOIN users u ".
				"ON a.`user_id` = u.`id` ".
				"LEFT JOIN articles_tree at ".
				"ON a.`articles_tree_id` = at.`id` ".
				"WHERE a.`id` = ?d";
		$result = Project::getDatabase()->selectRow($sql, $id);
		$this->bind($result);
		return $result;
	}
	
}

?>
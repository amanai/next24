<?php

class ArticleModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("articles");
	}
	
	public function loadByParentId($id, array $status, $userId = 0) {
		$id = (int)$id;
		$userId = (int)$userId;
		$str = "a.`rate_status` = ?d ";
		for($i = 0;$i<count($status)-1;$i++) $str .= "OR a.`rate_status` = ?d ";
			
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
				"a.`creation_date`, ".
				"u.`login` ".
				"FROM articles a ".
				"LEFT JOIN users u ".
				"ON a.`user_id` = u.`id` ";
				$id > 0 ? $sql .= "WHERE a.`articles_tree_id` = ?d AND ($str)" : $sql .= "WHERE ($str)";
				$userId > 0 ? $sql .= "AND a.`user_id` = ?d" : "";
		$params = array();
		$params[] = $sql;
		$id > 0 ? $params[] = $id : "";
		$params = array_merge($params, $status);
		$userId > 0 ? $params[] = $userId : "";
		return call_user_func_array(array(Project::getDatabase(), 'select'), $params);
	}
	
	public function loadWhere($userId, $sortName = null, $sortOrder = null) {
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
		//echo $sql;
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
	
	public function getFullPathById($id) {
		$sql = "CALL sp_get_path_by_key($id, @path);";
		Project::getDatabase()->query($sql);
		$sql = "SELECT @path as full_path";
		$result = Project::getDatabase()->selectRow($sql);
		return $result;
	}
	
	//в среду 18.00
	public function CompetitionStage1() {
		$sql = 	"UPDATE $this->_table SET `rate_status` = ".ARTICLE_COMPETITION_STATUS::IN_RATE.
				" WHERE `rate_status` = ".ARTICLE_COMPETITION_STATUS::NEW_ARTICLE;
		return Project::getDatabase()->query($sql);
	}
	
	//в пятницу в 18.00
	public function CompetitionStage2() {
		$sql =  "UPDATE $this->_table SET `rate_status` = ".ARTICLE_COMPETITION_STATUS::EDITED.
				" WHERE `rate_status` = ".ARTICLE_COMPETITION_STATUS::IN_RATE." ORDER BY `votes` ".
				"TOP 5";
		Project::getDatabase()->query($sql);
		$sql =  "DELETE FROM $this->_table ".
				"WHERE `rate_status` = ".ARTICLE_COMPETITION_STATUS::IN_RATE;
		return Project::getDatabase()->query($sql);
	}
	
	//в понедельник в 00.00
	public function CompetitionStage3() {
		$sql =  "UPDATE $this->_table SET `rate_status` = ".ARTICLE_COMPETITION_STATUS::SHOW_IN_CATALOG.
				" WHERE `rate_status` = ".ARTICLE_COMPETITION_STATUS::WINNER;
		Project::getDatabase()->query($sql);
		echo $sql;
		$sql =  "UPDATE $this->_table SET `rate_status` = ".ARTICLE_COMPETITION_STATUS::WINNER.
				" WHERE `rate_status` = ".ARTICLE_COMPETITION_STATUS::COMPLETE.
				" OR `rate_status` = ".ARTICLE_COMPETITION_STATUS::EDITED;
		echo $sql;
		return Project::getDatabase()->query($sql);
	}
}

?>
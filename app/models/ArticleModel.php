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
		$result = array();
		if ($id > 0) {
			$sql = 	"SELECT a.`id` ".
					"FROM articles_tree a ".
					"JOIN articles_tree b ".
					"ON a.`key` LIKE CONCAT(b.`key`, '%') ".
					"WHERE b.`id` = ?d";
			$result = Project::getDatabase()->select($sql, $id);
			foreach ($result as $val)$res[] = (int)$val['id'];
			$str2 = "a.`articles_tree_id` = ?d ";
			for($i = 0;$i<count($res)-1;$i++) $str2 .= "OR a.`articles_tree_id` = ?d ";
		}
			
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
				"u.`login`, ".
				"AVG(v.vote) as vote_result ".
				"FROM articles a ".
				"LEFT JOIN users u ".
				"ON a.`user_id` = u.`id` ".
				"LEFT JOIN article_votes v ".
				"ON a.`id` = v.`article_id` ";
				$id > 0 ? $sql .= "WHERE ($str2) AND ($str) GROUP BY a.`id`" : $sql .= "WHERE ($str) GROUP BY a.`id`";
				$userId > 0 ? $sql .= "AND a.`user_id` = ?d GROUP BY a.`id`" : "";
		$params = array();
		$params[] = $sql;
		$id > 0 ? $params = array_merge($params, $res) : "";
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
				"LIMIT 5";
		Project::getDatabase()->query($sql);
		$sql = "DELETE FROM subject_votes";
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
		$sql =  "UPDATE $this->_table SET `rate_status` = ".ARTICLE_COMPETITION_STATUS::WINNER.
				" WHERE `rate_status` = ".ARTICLE_COMPETITION_STATUS::COMPLETE.
				" OR `rate_status` = ".ARTICLE_COMPETITION_STATUS::EDITED;
		return Project::getDatabase()->query($sql);
	}
}

?>
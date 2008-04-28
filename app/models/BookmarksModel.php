<?php

class BookmarksModel extends BaseModel {

  public function __construct() {
    parent::__construct('bookmarks'); // - имя таблицы
  }

  public function loadByUserId($user_id = 0){
    $sql = "
    SELECT
        bookmarks.`id`,
        bookmarks.`user_id`,
        bookmarks.`bookmarks_tree_id`,
        bookmarks.`url`,
        bookmarks.`title`,
        bookmarks.`description`,
        bookmarks.`is_public`,
        bookmarks.`creation_date`,
        bookmarks.`views`,
        users.`login`
    FROM bookmarks
      LEFT JOIN users
      ON bookmarks.`user_id` = users.`id`
    WHERE bookmarks.`user_id` = ?d ";
    $result = Project::getDatabase() -> selectRow($sql, $user_id);
    $this -> bind($result);
    return $result;
  }

  public function loadBySection($bookmarks_tree_id = 0){
    $sql = "SELECT ".
        " bookmarks.`id`,".
        " bookmarks.`user_id`,".
        " bookmarks.`bookmarks_tree_id`,".
        " bookmarks.`url`,".
        " bookmarks.`title`,".
        " bookmarks.`description`,".
        " bookmarks.`is_public`,".
        " bookmarks.`creation_date`,".
        " bookmarks.`views`,".
        " users.`login` ".
    " FROM bookmarks ".
    " LEFT JOIN users ".
    " ON bookmarks.`user_id` = users.`id` ".
    " WHERE bookmarks.`bookmarks_tree_id` = ?d ";
    $result = Project::getDatabase() -> selectRow($sql, $bookmarks_tree_id);
    $this -> bind($result);
    return $result;
  }

/*
	public function loadWhere($catId = null, $tagId = null, $userId = null) {
		$catId = (int)$catId;
		$tagId = (int)$tagId;
		$userId = (int)$userId;
		$sql = "SELECT ".
					 "bookmarks.`id`,".
					 "bookmarks.`user_id`,".
					 "bookmarks.`bookmarks_tree_id`,".
					 "bookmarks.`url`,".
					 "bookmarks.`title`,".
					 "bookmarks.`description`,".
					 "bookmarks.`is_public`,".
					 "bookmarks.`creation_date`,".
					 "bookmarks.`views`,".
					 "users.`login` ".
					 "FROM bookmarks ".
					 "LEFT JOIN users ".
					 "ON bookmarks.`user_id` = users.`id` ";
					 if($tagId > 0) {
					 	//$sql.=  "JOIN bookmarks_tags ".
					 	//		"ON bookmarks_tags.`id` = bookmarks.`***` ".
					 	//		"WHERE bookmarks_tags.`id` = ?d";
					 	($catId > 0) ? $sql.=" AND questions.questions_cat_id = ?d" : "";
					    ($userId > 0) ? $sql.=" AND questions.user_id = ?d" : "";
					 } else {
					 	if ($catId > 0) {
					 		$sql.=" WHERE questions.questions_cat_id = ?d";
					 		($userId > 0) ? $sql.=" AND questions.user_id = ?d" : "";
					 	} else {
					 		if($userId > 0) {
					 			$sql.=" WHERE questions.user_id = ?d";
					 		}
					 	}
					 }
					 $sql.=" ORDER BY questions.`creation_date` DESC LIMIT ?d, ?d";
				//die($sql);
		$this->checkPager();
		$params = array();
		$params[] = $this->_countRecords;
		$params[] = $sql;
		if($tagId > 0) $params[] = $tagId;
		if($catId > 0) $params[] = $catId;
		if($userId > 0) $params[] = $userId;
		$params[] = $this->_pager->getStartLimit();
		$params[] = $this->_pager->getPageSize();
		$result = call_user_func_array(array(Project::getDatabase(), 'selectPage'), $params);
		//$this->updatePagerAmount();
		return $result;
	}

	public function loadQuestion($id) {
		$id = (int)$id;
		$sql = "SELECT ".
					 "questions.`id`,".
					 "questions.`questions_cat_id`,".
					 "questions.`a_count`,".
					 "questions.`q_text`,".
					 "questions.`user_id`,".
					 "questions.`creation_date`,".
					 "users.`login` ".
					 "FROM questions ".
					 "LEFT JOIN users ".
					 "ON questions.`user_id` = users.id ".
					 "WHERE questions.`id` = ?d";
					 //die($sql);
		$result = Project::getDatabase()->selectRow($sql, $id);
		$this->bind($result);
		return $result;
	}
    */
}

?>
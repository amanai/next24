<?php
/*
  Класс BookmarksModel - Модель для модуля Закладки (Bookmarks)
  Содержит функции, работающие непосредственно с данными из БД
*/

class BookmarksModel extends BaseModel {

  public function __construct() {
    parent::__construct('bookmarks'); // - передаем параметром имя таблицы
    // конструктор родителя содержит базовые функции по работе с БД:
    // _caches, load($id), loadAll, loadPage, delete($id), count(), save(),
    // __get($var), __set($var, $val), bind($result), data(), setPager, getPager(),
    // updatePagerAmount(), getCountRecords(), clear()
    //print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';
  }

  public function loadWhere($categoryID = null){
    $categoryID = (int)$categoryID;
    $v_sql_where = " 1=1 ";
    if ($categoryID > 0) {
      $v_sql_where .= ' and bm.`bookmarks_tree_id`='.$categoryID;
    }
    $v_sql_order = "bm.`creation_date`";
    if ($v_userId != 0) { $v_sql_where .= " and bm.`user_id` = ?d "; }
    $sql = "
    SELECT
        bm.`id`,
        bm.`user_id`,
        bm.`bookmarks_tree_id`,
        bm.`url`,
        bm.`title`,
        bm.`description`,
        IF (CHAR_LENGTH(bm.`description`)<=25, bm.`description`, CONCAT( LEFT(bm.`description`, 25), '...')) as description_cut,
        bm.`is_public`,
        bm.`creation_date`,
        bm.`views`,
        users.`login`,
        IF (bmt_pr.`name` is null, bmt_ch.`name`, CONCAT(bmt_pr.`name`, ' -><br />',bmt_ch.`name`)) as bookmark_category,
        count(bm_com.`id`) as count_comments
    FROM bookmarks bm
    LEFT JOIN users
      ON bm.`user_id` = users.`id`
    LEFT JOIN bookmarks_tree bmt_ch
      ON bm.`bookmarks_tree_id` = bmt_ch.`id`
    LEFT JOIN bookmarks_tree bmt_pr
      ON bmt_ch.`parent_id` = bmt_pr.`id`
    LEFT JOIN bookmarks_comments bm_com
      ON bm.`id` = bm_com.`bookmark_id` 
    WHERE ".$v_sql_where."
    GROUP BY bm.`id`
    ORDER BY ".$v_sql_order."
    LIMIT ?d, ?d  
    ";

    //$result = Project::getDatabase() -> selectRow($sql, $user_id);
    //$result = Project::getDatabase() -> select($sql, $v_userId);
    //$this -> bind($result); ??? - не знаю надо ли или это только для selectRow
		$result = Project::getDatabase() -> 
        selectPage( $this -> _countRecords, 
                    $sql, 
										$this -> _pager -> getStartLimit(), 
                    $this -> _pager -> getPageSize() /* limit params */
                    );
		$this -> updatePagerAmount();
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
  
  // -- Выборка для самых посещаемых закладок. Критерий: 10 самых посещаемых
  //  $p_count - количество строк из запроса, самых посещаемых
  public function loadMostVisit($p_count = 10) {
    $sql = "
    SELECT
        bm.`id`,
        bm.`user_id`,
        bm.`bookmarks_tree_id`,
        bm.`url`,
        bm.`title`,
        bm.`description`,
        IF (CHAR_LENGTH(bm.`description`)<=25, bm.`description`, CONCAT( LEFT(bm.`description`, 25), '...')) as description_cut,
        bm.`is_public`,
        bm.`creation_date`,
        bm.`views`,
        users.`login`,
        IF (bmt_pr.`name` is null, bmt_ch.`name`, CONCAT(bmt_pr.`name`, ' -><br />',bmt_ch.`name`)) as bookmark_category,
        count(bm_com.`id`) as count_comments
    FROM bookmarks bm
    LEFT JOIN users
      ON bm.`user_id` = users.`id`
    LEFT JOIN bookmarks_tree bmt_ch
      ON bm.`bookmarks_tree_id` = bmt_ch.`id`
    LEFT JOIN bookmarks_tree bmt_pr
      ON bmt_ch.`parent_id` = bmt_pr.`id`
    LEFT JOIN bookmarks_comments bm_com
      ON bm.`id` = bm_com.`bookmark_id` 
    GROUP BY bm.`id`
    ORDER BY bm.`views` DESC
    LIMIT 0, ?d
    ";
    $result = Project::getDatabase() -> select($sql, $p_count);
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
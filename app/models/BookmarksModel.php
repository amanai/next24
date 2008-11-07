<?php
/*
  Класс BookmarksModel - Модель для модуля Закладки (Bookmarks)
  Содержит функции, работающие непосредственно с данными из БД
*/

class BookmarksModel extends BaseModel {
  const C_MAX_LENGTH_TITLE = 50; // -- Длина строк поля TITLE, выше которой строка обрезается
  const C_MAX_LENGTH_URL   = 30; // -- Длина строк поля URL, выше которой строка обрезается

  public function __construct() {
    parent::__construct('bookmarks'); // - передаем параметром имя таблицы
                  // конструктор родителя содержит базовые функции по работе с БД:
                  // _caches, load($id), loadAll, loadPage, delete($id), count(), save(),
                  // __get($var), __set($var, $val), bind($result), data(), setPager, 
                  // getPager(), updatePagerAmount(), getCountRecords(), clear()
  }
                                      
  /**
   Выборка списка закладок. Формируется с Pager (страничной листалкой) 
     $p_categoryID - ID категории
     $p_userID - ID пользователя (для "Каталог закладок" $p_userID=null, "Мои закладки" - $p_userID>0)
     $p_tagID - ID выбранного тега
     $p_show_only_public - Показывать только публичные закладки (true), все (false)
  */
  public function loadBookmarksList($p_categoryID = null, $p_userID = null, $p_tagID = null, $p_show_only_public = false){
    $v_categoryID = (int)$p_categoryID;
    $v_userID     = (int)$p_userID;
    $v_tagID      = (int)$p_tagID;
    $v_show_only_public = (boolean)$p_show_only_public;
    $v_sql_where = " 1=1 ";
    $v_sql_tag   = '';
    if ($v_categoryID > 0)   { $v_sql_where .= ' and bm.`bookmarks_tree_id`='.$v_categoryID; }
    if ($v_categoryID == -1) { $v_sql_where .= ' and bm.`bookmarks_tree_id`=0'; }
    if ($v_userID > 0)     { $v_sql_where .= " and bm.`user_id`=".$v_userID; }
    if ($v_tagID > 0)      { 
      $v_sql_tag = " RIGHT JOIN bookmarks_tags_links bm_tl ON bm.`id` = bm_tl.`bookmarks_id` "; 
      $v_sql_where .= " and bm_tl.`bookmarks_tags_id` = ".$v_tagID;
    }   
    if ($v_show_only_public == true) { $v_sql_where .= " and bm.`is_public` = 1"; }
    $sql = "
    SELECT
        bm.`id`,
        bm.`user_id`,
        bm.`bookmarks_tree_id`,
        bm.`url`,
        bm.`title`,
        bm.`description`,
        IF (CHAR_LENGTH(bm.`title`)<=".self::C_MAX_LENGTH_TITLE.", bm.`title`, CONCAT( LEFT(bm.`title`, ".self::C_MAX_LENGTH_TITLE."), '...')) as title_cut,
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
      ON bm.`id` = bm_com.`bookmark_id`".$v_sql_tag.
    "WHERE ".$v_sql_where."
    GROUP BY bm.`id`
    ORDER BY bm.`creation_date` DESC
    LIMIT ?d, ?d  
    ";

    //$result = Project::getDatabase() -> select($sql, $v_userId);
		$result = Project::getDatabase() -> 
        selectPage( $this -> _countRecords, 
                    $sql, 
										$this -> _pager -> getStartLimit(), 
                    $this -> _pager -> getPageSize() /* limit params */
                    );
		$this -> updatePagerAmount();
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
        IF (CHAR_LENGTH(bm.`title`)<=".self::C_MAX_LENGTH_TITLE.", bm.`title`, CONCAT( LEFT(bm.`title`, ".self::C_MAX_LENGTH_TITLE."), '...')) as title_cut,
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
    WHERE bm.`is_public` = 1
    GROUP BY bm.`id`
    ORDER BY bm.`views` DESC
    LIMIT 0, ?d
    ";
    $result = Project::getDatabase() -> select($sql, (int)$p_count);
    return $result;
  }

  // -- Выборка категории, которая открыта и получение ID предка
  // id=8 parent_id=2 name='Авто -> Автомобили'
  // Предполагаем, что входящий параметр точно является ID дочерним
  public function loadCategoryByChildID($p_category_childID) {
    $sql = "
    SELECT 
      bmt_ch.`id`, 
      bmt_ch.`parent_id`, 
      CONCAT( bmt_pr.`name`, ' -> ', bmt_ch.`name` ) name  
    FROM `bookmarks_tree` bmt_ch LEFT JOIN `bookmarks_tree` bmt_pr
      ON bmt_ch.`parent_id` = bmt_pr.`id`  
    WHERE bmt_ch.`id` = ?d ";
    $result = Project::getDatabase()->select($sql, $p_category_childID);
    return $result;
  }
  
  // -- Выборка 1 строки конкретной закладки
  // Используется для просмотра закладки BookmarksViewAction
  public function loadBookmarkRow($p_id = 0) {
    $v_id = (int)$p_id;
    $sql = "
    SELECT
        bm.`id`,
        bm.`user_id`,
        bm.`bookmarks_tree_id`,
        bm.`url`,
        IF (CHAR_LENGTH(bm.`url`)<=".self::C_MAX_LENGTH_URL.", bm.`url`, CONCAT( LEFT(bm.`url`, ".self::C_MAX_LENGTH_URL."), '...')) as url_cut,
        bm.`title`,
        bm.`description`,
        IF (CHAR_LENGTH(bm.`title`)<=".self::C_MAX_LENGTH_TITLE.", bm.`title`, CONCAT( LEFT(bm.`title`, ".self::C_MAX_LENGTH_TITLE."), '...')) as title_cut,
        bm.`is_public`,
        bm.`creation_date`,
        bm.`views`,
        users.`login`,
        IF (bmt_pr.`name` is null, bmt_ch.`name`, CONCAT(bmt_pr.`name`, ' -> ',bmt_ch.`name`)) as bookmark_category
    FROM bookmarks bm
    LEFT JOIN users
      ON bm.`user_id` = users.`id`
    LEFT JOIN bookmarks_tree bmt_ch
      ON bm.`bookmarks_tree_id` = bmt_ch.`id`
    LEFT JOIN bookmarks_tree bmt_pr
      ON bmt_ch.`parent_id` = bmt_pr.`id`
    WHERE bm.`id` = ?d
    ";
    $result = Project::getDatabase() -> selectRow($sql, $v_id);
    $this -> bind($result); // - пока не знаю надо ли или это только для selectRow
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
<?php
/*
  Модель: Tегов закладок
*/

class BookmarksTagModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('bookmarks_tags');
	}
	
  /** Выборка тегов для: категории, пользователя, закладки
   $p_categoryID - ID категории
   $p_userID - ID пользователя: используется для вкладки "Мои закладки", фильтр по userID
   $p_bookmarkID - ID закладки
  */
  public function loadTagsWhere($p_categoryID = null, $p_userID = null, $p_bookmarkID = null) {
    $v_categoryID = (int)$p_categoryID;
    $v_userID     = (int)$p_userID;
    $v_bookmarkID = (int)$p_bookmarkID;
    $v_sql_where  = '';
    if ($v_categoryID > 0) $v_sql_where .= ' and b.`bookmarks_tree_id` = '.$v_categoryID;
    if ($v_userID > 0)     $v_sql_where .= ' and b.`user_id` = '.$v_userID;
    if ($v_bookmarkID > 0) $v_sql_where .= ' and b.`id` = '.$v_bookmarkID;

    $sql = "
    SELECT DISTINCT bm_t.`id`, bm_t.`name` as tag_name 
    FROM bookmarks_tags_links bm_tl, bookmarks b, bookmarks_tags bm_t
    WHERE bm_tl.`bookmarks_id` = b.`id` 
      and bm_tl.`bookmarks_tags_id` = bm_t.`id` ".$v_sql_where."
    ORDER BY tag_name      
    ";
    $result = Project::getDatabase() -> select($sql);
    return $result;
  }
  
  /** 
  * Выборка имени тега по ID 
  */
  public function loadTagNameByID($p_id) {
    $v_id = (int)$p_id;
    $sql = "SELECT bt.`id`, bt.`name` FROM bookmarks_tags bt WHERE bt.`id` = ?d";
    $result = Project::getDatabase() -> selectRow($sql, $v_id);
    return $result;
  }
  
  /**
  *  Выборка строки Тега по Имени
  */
  public function loadTagByName($p_tag_name){
    $sql = "SELECT * FROM bookmarks_tags WHERE LOWER(bookmarks_tags.`name`) = LOWER(?s)";
    $result =  Project::getDatabase()->selectRow($sql, $p_tag_name);
    $this->bind($result);
    return $result;
  }  
  
  /**
  *  Удаление тегов из `bookmarks_tags_links` по ID закладки
  * $p_bookmark_id - ID закладки
  */
  public function deleteTagsLinkByBookmarkID($p_bookmark_id) {
    $v_bookmark_id = (int)$p_bookmark_id;
    $sql = "DELETE FROM bookmarks_tags_links WHERE bookmarks_id = ?d";
    Project::getDatabase()->query($sql, $v_bookmark_id);
  }
  
  /**  Вставка записи в таблицу `bookmarks_tags_links`
   * $p_bookmark_id - ID закладки
   * $p_tag_id      - ID тега
  */
  public function insertTagLink($p_bookmark_id, $p_tag_id) {
    $v_bookmark_id = (int)$p_bookmark_id;
    $v_tag_id      = (int)$p_tag_id;
    if (($v_bookmark_id >0) and ($v_tag_id > 0)) {
      $sql = "INSERT INTO `bookmarks_tags_links` VALUES (null, ?d, ?d)";
      Project::getDatabase()->query($sql, $v_bookmark_id, $v_tag_id);
    }
  }
  
	/*
	public function loadByName($tagName) {
		$sql = "SELECT * FROM question_tags WHERE LOWER(question_tags.name) = LOWER(?s)";
		$result =  Project::getDatabase()->selectRow($sql, $tagName);
		$this->bind($result);
		return $result;
	}
	
	
	// Используется для формирования облака тегов, выбирает кол-во вопросов по тегу 
	// и имя тега, передается ид категории

	public function loadTags($catId) {
		$sql = "select  count(qt.question_tag_id) as count, t.id, t.name as name from question_tags as t join qq_tags as qt on qt.question_tag_id = t.id join questions as qs on qs.id = qt.question_id where qs.questions_cat_id = ?d group by qt.question_tag_id";
		return Project::getDatabase()->select($sql, $catId);
	}
  */
	
	
}

?>
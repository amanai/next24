<?php
/*
  Класс SocialModel - Модель для модуля Социальные позиции (разделы)
  Содержит функции, работающие непосредственно с данными из БД
*/

class SocialModel extends BaseModel {
  const C_MAX_LENGTH_NAME = 50; // -- Длина строк поля NAME, выше которой строка обрезается

  public function __construct() {
    parent::__construct('social_pos'); // - передаем параметром имя таблицы
  }
                                      
  /**
   Выборка списка соц.позиций. Формируется с Pager (страничной листалкой) 
     $p_categoryID - ID категории
     $p_userID - ID пользователя (для "Каталог соц.позиций" $p_userID=null, "Мои соц.позиции" - $p_userID>0)
  */
  public function loadSocialPosList($p_categoryID = null, $p_userID = null, $p_str_find = null, $p_sort_rating = null){
    $v_categoryID = (int)$p_categoryID;
    $v_userID     = (int)$p_userID;
    $v_sql_where = " 1=1 ";
    $v_sql_order = ' ORDER BY avg_rating DESC, sp.`creation_date` DESC ';
    if ($v_categoryID > 0)   { 
    	$sql = "SELECT count(*) as cnt_cat FROM social_tree where parent_id = $v_categoryID";  
		$res = Project::getDatabase()->selectCell($sql);
		if($res) {$v_sql_where .= ' and sp.`social_tree_id` in (SELECT id FROM social_tree where parent_id = '.$v_categoryID.')';}    	
    	else {$v_sql_where .= ' and sp.`social_tree_id`='.$v_categoryID; }     	 
    }
    if ($v_categoryID == -1) { $v_sql_where .= ' and sp.`social_tree_id`=0'; }
    if ($v_userID > 0)       { $v_sql_where .= ' and sp.`user_id`='.$v_userID; }
    if ($p_str_find != null ){ $v_sql_where .= ' and lower(sp.`name`) like lower("%'.$p_str_find.'%")'; }
    if ($p_sort_rating == 'ASC' ) { $v_sql_order = ' ORDER BY avg_rating ASC '; }
    if ($p_sort_rating == 'DESC' ) { $v_sql_order = ' ORDER BY avg_rating DESC '; }
    $sql = "
    SELECT
        sp.`id`,
        sp.`user_id`,
        sp.`social_tree_id`,
        sp.`name`,
        sp.`id_product`,
        sp.`Xcoord`,
        sp.`Ycoord`,
        sp.`Zoom`,
        prod.`full_name`,
        IF (CHAR_LENGTH(sp.`name`)<=".self::C_MAX_LENGTH_NAME.", sp.`name`, CONCAT( LEFT(sp.`name`, ".self::C_MAX_LENGTH_NAME."), '...')) as name_cut,
        sp.`creation_date`,
        users.`login`,
        IF (spt_pr.`name` is null, spt_ch.`name`, CONCAT(spt_pr.`name`, ' -><br />',spt_ch.`name`)) as social_category,
        spc.avg_rating,
        count(sp_com.`id`) as count_comments
    FROM social_pos sp
    LEFT JOIN users
      ON sp.`user_id` = users.`id`
    LEFT JOIN social_tree spt_ch
      ON sp.`social_tree_id` = spt_ch.`id`
    LEFT JOIN social_tree spt_pr
      ON spt_ch.`parent_id` = spt_pr.`id`
    LEFT JOIN social_comment sp_com
      ON sp.`id` = sp_com.`social_id`
    LEFT JOIN (
      SELECT 
        spcv.`social_pos_id`, 
        sum(spcv.`votes_sum`) as votes_sum, 
        sum(spcv.`votes_count`) as votes_count,
        sum(spcv.`votes_sum`/spcv.`votes_count`)/count(*) as avg_rating
      FROM social_pos_criteria_votes spcv
      GROUP BY spcv.`social_pos_id`
      ) spc
      ON sp.`id` = spc.`social_pos_id`
    LEFT JOIN `social_products_places` prod on sp.`id_product` = prod.`id`  
    WHERE ".$v_sql_where."
    GROUP BY sp.`id` 
    ".$v_sql_order."
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

  /**
  * Выборка последних 10 добавленных позиций.
  * $p_count - количество последне добавленных позиций
  */
  public function loadLastAddPos($p_count = 10) {
//        IF (sct_pr.`name` is null, sct_ch.`name`, CONCAT(sct_pr.`name`, ' -><br />',sct_ch.`name`)) as social_category,

    $sql = "
    SELECT
        sp.`id`,
        sp.`user_id`,
        sp.`social_tree_id`,
        sp.`name`,
        sp.`creation_date`,
        users.`login`,
        IF (sct_pr.`name` is null, sct_ch.`name`, CONCAT(sct_pr.`name`, ' -> ',sct_ch.`name`)) as social_category,
        spc.avg_rating,
        count(sc_com.`id`) as count_comments
    FROM social_pos sp
    LEFT JOIN users
      ON sp.`user_id` = users.`id`
    LEFT JOIN social_tree sct_ch
      ON sp.`social_tree_id` = sct_ch.`id`
    LEFT JOIN social_tree sct_pr
      ON sct_ch.`parent_id` = sct_pr.`id`
    LEFT JOIN social_comment sc_com
      ON sp.`id` = sc_com.`social_id` 
    LEFT JOIN (
      SELECT 
        spcv.`social_pos_id`, 
        sum(spcv.`votes_sum`) as votes_sum, 
        sum(spcv.`votes_count`) as votes_count,
        sum(spcv.`votes_sum`/spcv.`votes_count`)/count(*) as avg_rating
      FROM social_pos_criteria_votes spcv
      GROUP BY spcv.`social_pos_id`
      ) spc
      ON sp.`id` = spc.`social_pos_id`
    WHERE 1=1
    GROUP BY sp.`id`
    ORDER BY sp.`creation_date` DESC
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
      sct_ch.`id`, 
      sct_ch.`parent_id`, 
      CONCAT( sct_pr.`name`, ' -> ', sct_ch.`name` ) name  
    FROM `social_tree` sct_ch LEFT JOIN `social_tree` sct_pr
      ON sct_ch.`parent_id` = sct_pr.`id`  
    WHERE sct_ch.`id` = ?d ";
    $result = Project::getDatabase()->select($sql, $p_category_childID);
    return $result;
  }
  
  /**
  *  Выборка 1 строки конкретной соц.позиции
  * Используется для просмотра закладки SocialViewAction
  */
  public function loadSocialRows($p_id = 0) {
    $v_id = (int)$p_id;
    $sql = "
    SELECT
        sp.`id`,
        sp.`user_id`,
        sp.`social_tree_id`,
        sp.`name`,
        IF (CHAR_LENGTH(sp.`name`)<=".self::C_MAX_LENGTH_NAME.", sp.`name`, CONCAT( LEFT(sp.`name`, ".self::C_MAX_LENGTH_NAME."), '...')) as name_cut,
        sp.`creation_date`,
        users.`login`,
        IF (spt_pr.`name` is null, spt_ch.`name`, CONCAT(' ▪ <a href=\"".Project::getRequest() -> createUrl('Social', 'SocialMainList', null, false)."/',spt_pr.`id`,'\">',spt_pr.`name`, '</a> » <a href=\"".Project::getRequest() -> createUrl('Social', 'SocialMainList', null, false)."/',sp.`social_tree_id`,'/\">',spt_ch.`name`,'</a> » ',sp.`name`)) as social_category,
        sc.`id` as criteria_id,
        sc.`name` as criteria_name,
        spcv.`votes_sum`,
        spcv.`votes_count`,
        spcv.`votes_sum`/spcv.`votes_count` as votes_avg,
        spc.avg_rating
    FROM social_pos sp
    LEFT JOIN users
      ON sp.`user_id` = users.`id`
    LEFT JOIN social_tree spt_ch
      ON sp.`social_tree_id` = spt_ch.`id`
    LEFT JOIN social_tree spt_pr
      ON spt_ch.`parent_id` = spt_pr.`id`
    LEFT JOIN `social_tree_criteria` stc
      ON sp.`social_tree_id` = stc.`social_tree_id`
    LEFT JOIN `social_criteria` sc
      ON stc.`social_criteria_id` = sc.`id`
    LEFT JOIN `social_pos_criteria_votes` spcv
      ON spcv.`social_criteria_id` = sc.`id` and spcv.`social_pos_id` = sp.`id`
    LEFT JOIN (
      SELECT 
        spcv2.`social_pos_id`, 
        sum(spcv2.`votes_sum`) as votes_sum, 
        sum(spcv2.`votes_count`) as votes_count,
        sum(spcv2.`votes_sum`/spcv2.`votes_count`)/count(*) as avg_rating
      FROM social_pos_criteria_votes spcv2
      GROUP BY spcv2.`social_pos_id`
      ) spc
      ON spc.`social_pos_id` = sp.`id`
    WHERE sp.`id` = ?d
    ";
    $result = Project::getDatabase() -> select($sql, $v_id);
//    $result = Project::getDatabase() -> selectRow($sql, $v_id);
    $this -> bind($result); // - пока не знаю надо ли или это только для selectRow
    return $result;
  }
  
  /**
  * Выборка 'social_tree_criteria'
  */
  public function loadTreeCriteria(){
    $sql = "
    SELECT 
      stc.`id`,  
      stc.`social_tree_id`,
      st.`name` as social_tree_name,
      stc.`social_criteria_id`,
      sc.`name` as social_criteria_name
      FROM `social_tree_criteria` stc, `social_tree` st, `social_criteria` sc
     WHERE stc.`social_tree_id` = st.`id`
       and stc.`social_criteria_id` = sc.`id`
     ORDER BY stc.`social_tree_id`, stc.`social_criteria_id` ";
    $result = Project::getDatabase() -> select($sql, $v_id);
    $this -> bind($result);
    return $result;
  }
  
  /**
  * Выборка `social_tree` - ID и Name категорий
  */
  public function loadCategories(){
    $sql = "
      SELECT *  FROM `social_tree` st
       WHERE st.`parent_id` >0
       ORDER BY st.`name` ";
    $result = Project::getDatabase() -> select($sql);
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
  public function getProductPlaces() {
  	$sql = "SELECT id AS ARRAY_KEY_1,full_name FROM social_products_places ORDER BY id"; 
  	$result = Project::getDatabase() -> select($sql);	
  	return $result;
  }
}

?>
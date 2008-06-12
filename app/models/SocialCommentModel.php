<?php 
/*
  Модель: добавления комментария для Соц.позиции
*/
class SocialCommentModel extends CommentModel {
	
	
	function __construct($id = 0){
		parent::__construct('social_comments', 'social_pos_id', $id);
	}
  
  /**
  * Функция возвращает количество строк в таблице в зависимости от условия WHERE
  * Необходима для определения наличия комментариев к соц.позиции для конкретного пользователя
  */
  public function GetCountRecComment($p_user = 0, $p_social_pos_id = 0) {
    if (((int)$p_user == 0) or ($p_social_pos_id == 0)) { return 0; }
    $sql = "
      SELECT count(*) as cnt 
      FROM `social_comments` s 
      WHERE s.`user_id`=?d and s.`social_pos_id`=?d
    ";
    $result = Project::getDatabase() -> select($sql, (int)$p_user, (int)$p_social_pos_id);
    return $result[0]['cnt'];
  }
	
}

?>
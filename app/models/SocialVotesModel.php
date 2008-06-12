<?php
/**
  Модель: Голоса за позиции, для предотвращения повторного голосования
*/

class SocialVotesModel extends BaseModel {
  public function __construct() {
    parent::__construct('social_votes');
  }

  /**
  * Функция возвращает количество строк в таблице в зависимости от условия WHERE
  * Необходима для определения наличия голосования к соц.позиции-критерию для конкретного пользователя
  * $p_user - ID user
  * $p_social_pos_id - ID соц.позиции
  */
  public function GetCountRecVotes($p_user = 0, $p_social_pos_id = 0) {
    if (((int)$p_user == 0) or ($p_social_pos_id == 0)) { return 0; }
    $sql = "
      SELECT count(*) as cnt 
      FROM `social_votes` s 
      WHERE s.`user_id`=?d and s.`social_pos_id`=?d
    ";
    $result = Project::getDatabase() -> select($sql, (int)$p_user, (int)$p_social_pos_id);
    return $result[0]['cnt'];
  }

}

?>
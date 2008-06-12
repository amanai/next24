<?php
/**
  Модель: Таблица связи позиции(social_pos) с критерием(social_criteria) и голосами по критерию
*/

class SocialPosCriteriaVoteModel extends BaseModel {
  public function __construct() {
    parent::__construct('social_pos_criteria_votes');
  }

  /**
  * Читает строку таблицы "social_pos_criteria_votes"
  * $p_spos_id        - ID Соц. позиции
  * $p_scriteria_id - ID Критерия
  */
  public function GetIDBy($p_spos_id = 0, $p_scriteria_id = 0) {
    $v_spos_id = (int)$p_spos_id;
    $v_scriteria_id = (int)$p_scriteria_id;
    $sql = "
      SELECT *
        FROM `social_pos_criteria_votes` s
       WHERE s.`social_pos_id` = ?d and s.`social_criteria_id` = ?d";
    $result = Project::getDatabase() -> select($sql, $v_spos_id, $v_scriteria_id);
    return $result[0]['id'];
  }
}

?>
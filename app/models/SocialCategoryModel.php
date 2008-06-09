<?php
/**
  Модель: Каталог категорий Соц.Позиций
  На основе получаемых данных строится дерево категорий Соц.Позиций
*/

class SocialCategoryModel extends BaseModel {
  public function __construct() {
    parent::__construct('social_tree');
  }

  /** 
    Для дерева категорий определена сортировка в алфавитном порядке:
     как в родительских категориях(level_item=0), так и в дочерних (level_item=1)
  */
  public function loadCategoryList(){
    $sql = "
      SELECT
        st.*,
        IF (st.`parent_id`=0, 0, 1) level_item,
        IF (st.`parent_id`=0, st.`name`, CONCAT(st1.`name`, '_', st.`name`)) field_order
      FROM `social_tree` st LEFT JOIN `social_tree` st1 ON st.`parent_id` = st1.`id`
      ORDER BY field_order
    ";
    $result = Project::getDatabase() -> select($sql);
    return $result;
  }

}

?>
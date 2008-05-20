<?php
/**
  Модель: Каталог-Закладок
  На основе получаемых данных строится дерево Каталога закладок
*/

class BookmarksCategoryModel extends BaseModel {
  /**
  * parent::__construct('bookmarks_tree'); - передаем параметром имя таблицы
  */
  public function __construct() {
    parent::__construct('bookmarks_tree');
  }

  /** 
    Для дерева категорий определена сортировка в алфавитном порядке:
     как в родительских категориях(level_item=0), так и в дочерних (level_item=1)
  */
  public function loadCategoryList(){
    $sql = "
      SELECT
        bt.*,
        IF (bt.`parent_id`=0, 0, 1) level_item,
        IF (bt.`parent_id`=0, bt.`name`, CONCAT(bt1.`name`, '_', bt.`name`)) field_order
      FROM `bookmarks_tree` bt LEFT JOIN `bookmarks_tree` bt1 ON bt.`parent_id` = bt1.`id`
      WHERE bt.`active` = 1
      ORDER BY field_order
    ";
    $result = Project::getDatabase() -> select($sql);
    return $result;
  }

}

?>
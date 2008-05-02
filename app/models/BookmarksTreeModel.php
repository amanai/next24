<?php
/*
  Класс BookmarksTreeModel - Модель для модуля Закладки (Bookmarks), раздела Каталог закладок
  На основе получаемых данных строится дерево Каталога закладок
  Содержит функции, работающие непосредственно с данными из БД
*/

class BookmarksTreeModel extends BaseModel {

  public function __construct() {
    parent::__construct('bookmarks_tree'); // - передаем параметром имя таблицы
    // конструктор родителя содержит базовые функции по работе с БД:
    // _caches, load($id), loadAll, loadPage, delete($id), count(), save(),
    // __get($var), __set($var, $val), bind($result), data(), setPager, getPager(),
    // updatePagerAmount(), getCountRecords(), clear()
    //print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';
  }

// Для дерева категорий определена сортировка в алфавитном порядке как в
//   родительских категориях(level_item=0), так и в дочерних (level_item=1)
  public function loadSortedAll(){
    $sql = "
      SELECT
        bt.*,
        IF (bt.`parent_id`=0, 0, 1) level_item,
        IF (bt.`parent_id`=0, bt.`name`, CONCAT(bt1.`name`, '_', bt.`name`)) field_order
      FROM `bookmarks_tree` bt LEFT JOIN `bookmarks_tree` bt1 ON bt.`parent_id` = bt1.`id`
      ORDER BY field_order
    ";
    $result = Project::getDatabase() -> select($sql);
    return $result;
  }

}

?>
<?php
/*
  ����� BookmarksTreeModel - ������ ��� ������ �������� (Bookmarks), ������� ������� ��������
  �� ������ ���������� ������ �������� ������ �������� ��������
  �������� �������, ���������� ��������������� � ������� �� ��
*/

class BookmarksTreeModel extends BaseModel {

  public function __construct() {
    parent::__construct('bookmarks_tree'); // - �������� ���������� ��� �������
    // ����������� �������� �������� ������� ������� �� ������ � ��:
    // _caches, load($id), loadAll, loadPage, delete($id), count(), save(),
    // __get($var), __set($var, $val), bind($result), data(), setPager, getPager(),
    // updatePagerAmount(), getCountRecords(), clear()
    //print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';
  }

  public function loadSortedAll(){
    $sql = "
      SELECT
        bt.*,
        IF (bt.`parent_id`=0, 0, 1) level_item,
        IF (bt.`parent_id`=0, bt.`id`, CONCAT(bt.`parent_id`, '_', bt.`name`)) field_order
      FROM `bookmarks_tree` bt
      ORDER BY field_order
    ";
    $result = Project::getDatabase() -> select($sql);
    return $result;
  }

}

?>
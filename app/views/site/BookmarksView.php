<?php

class BookmarksView extends BaseSiteView {
	protected $_dir = 'Bookmarks'; // - ссылка на дирректорию, где хранятся шаблоны

	public function Bookmarks_MainList($data) {
		$this->setTemplate(null, 'bookmarks_main_list.tpl.php');
		$this->set($data);
  //print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';
	}
	public function Bookmarks_MostVisit($data) {
		$this->setTemplate(null, 'bookmarks_most_visit.tpl.php');
		$this->set($data);
	}
	public function Bookmarks_View($data) {
		$this->setTemplate(null, 'bookmarks_view.tpl.php');
		$this->set($data);
	}
  public function Bookmarks_UserList($data) {
    $this->setTemplate(null, 'bookmarks_user_list.tpl.php');
    $this->set($data);
  }
  public function Bookmarks_Manage($data) {
    $this->setTemplate(null, 'bookmarks_manage.tpl.php');
    $this->set($data);
  }
  
  public function Bookmarks_CategoryEdit($data) {
    $this->setTemplate(null, 'bookmarks_category_edit.tpl.php');
    $this->set($data);
  }
  
  public function Bookmarks_Import($data) {
    $this->setTemplate(null, 'bookmarks_import.tpl.php');
    $this->set($data);
  }
  
	
	
}

?>
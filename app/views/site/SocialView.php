<?php

class SocialView extends BaseSiteView {
	protected $_dir = 'Social'; // - ссылка на дирректорию, где хранятся шаблоны app\templates\site\Social

  // -- Каталог позиций (все) - Основная вкладка
	public function Social_MainList($data) {
		$this->setTemplate(null, 'social_main_list.tpl.php');
		$this->set($data);
	}
  // -- Последние 10 позиций
	public function Social_LastAddPos($data) {
		$this->setTemplate(null, 'social_last_add_pos.tpl.php');
		$this->set($data);
	}
  // -- Позиции пользователя
  public function Social_UserList($data) {
    $this->setTemplate(null, 'social_user_list.tpl.php');
    $this->set($data);
  }
	public function Social_View($data) {
		$this->setTemplate(null, 'social_view.tpl.php');
		$this->set($data);
	}
  /*
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
*/  
}

?>
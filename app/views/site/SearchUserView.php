<?php

class SearchUserView extends BaseSiteView {
  // - ссылка на дирректорию, где хранятся шаблоны app\templates\site\SearchUser
	protected $_dir = 'SearchUser'; 

  // -- Поиск знакомых - Основная вкладка
	public function SearchUser_Main($data) {
		$this->setTemplate(null, 'search_user_main.tpl.php');
		$this->set($data);
	}

  // -- Поиск по интересам
  public function Search_ByInterest($data) {
    $this->setTemplate(null, 'search_by_interest.tpl.php');
    $this->set($data);
  }
  
/*  
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
  public function Social_PosAdd($data) {
    $this->setTemplate(null, 'social_pos_add.tpl.php');
    $this->set($data);
  }
  */
}

?>
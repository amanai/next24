<?php

class SocialView extends BaseSiteView {
	protected $_dir = 'Social'; // - ссылка на дирректорию, где хранятся шаблоны app\templates\site\Social
	protected $_stack;

	public function __set($name,$var) {
		$this->_stack[$name] = $var;
	}
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
      $this->_js_files[] = 'jquery.js';
    $this->setTemplate(null, 'social_view.tpl.php');
    $this->set($data);
  }
  public function Social_PosAdd($data) {
 // 	print '<pre>';
  //		print_r($this->_stack['product_places']);
  //	print '</pre>';	
    $this->setTemplate(null, 'social_pos_add.tpl.php');
    $this->set($data);
  }
}

?>
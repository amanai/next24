<?php

class SearchUserView extends BaseSiteView {
  // - ссылка на дирректорию, где хранятся шаблоны app\templates\site\SearchUser
	protected $_dir = 'SearchUser'; 

  // -- Поиск знакомых - Основная вкладка
	public function SearchUser_Main($data) {
		$this->_js_files[]='xpath.js';
		$this->_js_files[]='blockUI.js';
		$this->_js_files[]='ajax.js';
		$this->setTemplate(null, 'search_user_main.tpl.php');
		$this->set($data);
	}

  // -- Поиск по интересам
  public function Search_ByInterest($data) {
    $this->setTemplate(null, 'search_by_interest.tpl.php');
    $this->set($data);
  }
  
	public function ChangeCountry($info){
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'state_list.tpl.php');
			$response -> block('city_div', true, '');
			$response -> block('state_div', true, $this -> parse());
			
		/*	$info = array();
			$info['city_list'] = array();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'city_list.tpl.php');
			$response -> block('city_div', true, $this -> parse()); */
		}
		
	public function ChangeState($info){
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'city_list.tpl.php');
			$response -> block('city_div', true, $this -> parse());
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
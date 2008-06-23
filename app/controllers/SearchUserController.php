<?php
/*
  Контроллер для работы с "Найти знакомых"
*/
//print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';

class SearchUserController extends SiteController {
  const C_MAX_TAGS_COUNT = 10; // -- Максимальное кол-во тегов для вкладки. Остальные усекаются.
  const C_MAX_TAG_LENGTH = 30; // -- Максимальная длина тега в символах
  const C_MAX_FILE_UPLOAD_SIZE = 10000000; // -- Макс. размер загружаемого файла ~ 10 Мб

  function __construct($view_class = null) {
    if ($view_class === null) {
      $view_class = "SearchUserView";
    }
    parent::__construct($view_class);
  }
  
  // -- BaseSiteData - определяет набор закладок, доступных на странице
	protected function _BaseSiteData(&$data) {
		$data['tab_main_search']        = "Найти знакомых";
    $data['tab_search_interest']    = "Поиск по интересам";
		parent::BaseSiteData();
	}
  
  /**
  * Action: Вызов вкладки "Найди знакомых" (Основная)
  * Action: SearchUserMainAction - метод описывающий работу конкретного действия, 
  * зарегистрированного в таблице ACTION
  * 
  * Имя формируется строго: ИмяДействияAction. ИмяДействия_Action - уже не верно!
  */
	public function SearchUserMainAction() {
		$v_request = Project::getRequest();
    $v_session = Project::getSession();
		$data = array();   
	  $this->_BaseSiteData($data);
	  $data['action'] = 'SearchUserMain';
	  // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/2/ ...bookmarks_list/0/0/2/
	  // где bookmarks_list/{id_категории}/{id_тега}/{номер страницы}/
	  $v_n_page     = $v_request->getKeyByNumber(0);
    //$v_str_find = ($v_request->inp_hide == 'find') ? $v_request->inp_find : null;
    $data['p_search_sex']        = $v_request->select_search_sex;
    $data['p_search_age_from']   = $v_request->inp_search_age_from;
    $data['p_search_age_to']     = $v_request->inp_search_age_to;
    $data['p_search_counrty']    = $v_request->select_search_counrty;
    $data['p_search_login']      = $v_request->inp_search_login;
    $data['p_search_with_photo'] = $v_request->chk_search_with_photo;
    $v_country_model = new CountryModel();
    $data['list_country'] = $v_country_model->loadAll();
    if ($v_request->btn_search != null) {
      $v_session -> add('p_search_sex', $data['p_search_sex']);
      $v_session -> add('p_search_age_from', $data['p_search_age_from']);
      $v_session -> add('p_search_age_to', $data['p_search_age_to']);
      $v_session -> add('p_search_counrty', $data['p_search_counrty']);
      $v_session -> add('p_search_login', $data['p_search_login']);
      $v_session -> add('p_search_with_photo', $data['p_search_with_photo']);
      $v_session -> add('p_session_save', true);
    } else {
      $data['p_search_sex']        = $v_session -> getKey('p_search_sex', null); 
      $data['p_search_age_from']   = $v_session -> getKey('p_search_age_from', null); 
      $data['p_search_age_to']     = $v_session -> getKey('p_search_age_to', null); 
      $data['p_search_counrty']    = $v_session -> getKey('p_search_counrty', null); 
      $data['p_search_login']      = $v_session -> getKey('p_search_login', null); 
      $data['p_search_with_photo'] = $v_session -> getKey('p_search_with_photo', null); 
    }       
    
    if ($v_session -> getKey('p_session_save', null) == true) {
      $this->_getData($data, 'SearchUserMain', $v_n_page, null);
    }
		
	  $this->_view->SearchUser_Main($data);
		$this->_view->parse();
  }

  /**
  * Action: Поиск по интересам
  */
	public function SearchByInterestAction() {
    $v_request = Project::getRequest();
    $v_session = Project::getSession();
		$data = array();
		$this->_BaseSiteData($data);
		$data['action'] = 'SearchByInterest';
    $v_id_interest  = (int)$v_request->getKeyByNumber(0);
    $v_n_page       = (int)$v_request->getKeyByNumber(1);
    $v_model = new InterestsModel();
    $data['interests_list'] = $v_model->loadAll();
    if ($v_id_interest > 0) {
      $this->_getData($data, 'SearchByInterest', $v_n_page, $v_id_interest);
    }
    $this->_view->Search_ByInterest($data);
		$this->_view->parse();
	}               
  
  // -- Action "Мои позиции" - соц.позиции активного пользователя
  public function SocialUserListAction() {
    $v_request = Project::getRequest();
    $data = array();
    $this->_BaseSiteData($data);
    $data['action'] = 'SocialUserList';
    $v_current_userID = (int)Project::getUser() -> getDbUser() -> id;
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/ ...bookmarks_list/0/0/
    // где bookmarks_list/{id_категории}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_n_page     = $v_request->getKeyByNumber(1);
    $this->_getData($data, 'SocialUserList', $v_categoryID, $v_n_page, $v_current_userID);
    $this->_view->Social_UserList($data);
    $this->_view->parse();
  }
  
 
  /**
  * Формирование всех основных данных для HTML-форм
  */
  protected function _getData( &$data, $p_action, $p_n_page = null, $p_id_interest = null) {
    $v_n_page     = (int)$p_n_page;
    $v_model      = new UserModel();
    $v_list_per_page = $this->getParam('search_user_per_page', 4);
    $v_DbPager = new DbPager($v_n_page, $v_list_per_page);
    $v_model -> setPager($v_DbPager);
    $data['list_search_user'] = $v_model->loadSearchUser(
            $data['p_search_sex'],
            $data['p_search_age_from'],
            $data['p_search_age_to'],
            $data['p_search_counrty'],
            $data['p_search_login'],
            $data['p_search_with_photo'],
            $p_id_interest
            );
    $v_pager_view = new SitePagerView();
    // Формируем объект-постраничный вывод
    if ($p_id_interest == null) {
      // -- Pager для вкладки "Найти знакомых"
      $data['search_user_list_pager'] = $v_pager_view->show2($v_model->getPager(), 'SearchUser', $p_action);
    } else {
      // -- Pager для вкладки "Поиск по интересам"
      $data['search_user_list_pager'] = $v_pager_view->show2($v_model->getPager(), 'SearchUser', $p_action, array($p_id_interest));
    }
    // class SitePagerView -> function show2(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null)
  }
  
  /**
  * Функция получения ID категории по ID соц.позиции
  */
  private function _GetIDCategoryByIDPos($p_id_sp = null) {
    $v_id_sp = (int)$p_id_sp;
    if ($v_id_sp > 0) {
      $v_sp_model = new SocialModel();
      $v_row = $v_sp_model->load($v_id_sp);
      return $v_row['social_tree_id'];
      // для "Импортированные" ID Категории = 0
    }
    return -1; // -- Выбираемая соц.позиция с несуществующим ID 
  }
  
}

?>
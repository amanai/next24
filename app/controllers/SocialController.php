<?php
/*
  Контроллер для работы с Социальными Разделами(Позициями)
*/
//print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';

class SocialController extends SiteController {
  const C_MAX_TAGS_COUNT = 10; // -- Максимальное кол-во тегов для вкладки. Остальные усекаются.
  const C_MAX_TAG_LENGTH = 30; // -- Максимальная длина тега в символах
  const C_MAX_FILE_UPLOAD_SIZE = 10000000; // -- Макс. размер загружаемого файла ~ 10 Мб

  function __construct($view_class = null) {
    if ($view_class === null) {
      $view_class = "SocialView"; // - привязываем класс Представления к данному Контроллеру
    }
    parent::__construct($view_class);
  }
  
  // -- BaseSiteData - определяет набор закладок, доступных на странице
	protected function _BaseSiteData(&$data) {
		$data['tab_main_list']         = "Каталог позиций";
		$data['tab_last_add_pos_list'] = "Последние позиции";
    $data['tab_user_list']         = "Мои позиции";
    $data['tab_soc_pos_add']       = "Добавление позиции";
		parent::BaseSiteData();
	}
  
  /**
  * Action: Вызов вкладки "Каталог позиций" (Основная)
  * Action: SocialMainListAction - метод описывающий работу конкретного действия, 
  * зарегистрированного в таблице ACTION
  * 
  * Имя формируется строго: ИмяДействияAction. ИмяДействия_Action - уже не верно!
  */
	public function SocialMainListAction() {
		$v_request = Project::getRequest();
    $v_session = Project::getSession();
		$data = array();   
	  //$this->_BaseSiteData($data);
	  $data['action'] = 'SocialMainList';
	  // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/2/ ...bookmarks_list/0/0/2/
	  // где bookmarks_list/{id_категории}/{id_тега}/{номер страницы}/
	  $v_categoryID = $v_request->getKeyByNumber(0);
	  $v_n_page     = $v_request->getKeyByNumber(1);
    $v_str_find = ($v_request->inp_hide == 'find') ? $v_request->inp_find : null;
    $v_sort_rating = null;
    if ($v_request->inp_sort != null)  {
      $v_sort_rating = strtoupper($v_request->inp_sort); 
      $v_session -> add('social_sort_rating', $v_sort_rating);
    } else {
      $v_sort_rating = $v_session -> getKey('social_sort_rating', null);
    }
    $data['str_find'] = $v_str_find;
		$this->_getData($data, 'SocialMainList', $v_categoryID, $v_n_page, 0, $v_str_find, $v_sort_rating);
	  $this->_get_categories($data, $v_categoryID);
	  $this->_getSelectedCategory($data, $v_categoryID);
    $this->_view->assign('tab_list', TabController::getSocialTabs(true, false)); // Show tabs
	  $this->_view->Social_MainList($data);
		$this->_view->parse();
  }

  /**
  * Action: Последние добавленные позиции (10 шт)
  */
	public function SocialLastAddPosAction() {
		$data = array();
		//$this->_BaseSiteData($data);
		$data['action'] = 'SocialLastAddPos';
    $v_sc_model = new SocialModel();
    $data['social_pos_list'] = $v_sc_model->loadLastAddPos();
    $this->_view->assign('tab_list', TabController::getSocialTabs(false, true)); // Show tabs
    $this->_view->Social_LastAddPos($data);
		$this->_view->parse();
	}               
  
  // -- Action "Просмотр соц.позиции": параметры соц.позиции, комментарии, добавление комментария
  public function SocialViewAction() {
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser() -> getDbUser() -> id;
    $data = array();
    //$this->_BaseSiteData($data);
    $data['action'] = 'SocialView';

    $v_id = (int)$v_request->getKeyByNumber(0);
    if ($v_id > 0) {
      $v_sp_model = new SocialModel();
      $data['social_row'] = $v_sp_model->loadSocialRows($v_id);
      $v_tab_name = $data['social_row'][0]['name'];
      $v_encoding = mb_detect_encoding($v_tab_name);
      if (mb_strlen($v_tab_name, $v_encoding) > 50 ) $v_tab_name = mb_substr($v_tab_name, 0, 50, $v_encoding).'...';
      //$data['tab_social_view'] = $v_tab_name;
      // ---
      
      $controller = new BaseCommentController();
      $data['comment_list'] = $controller -> CommentList(
                                $v_id,  
                                $v_request -> getKeyByNumber(1),   //TODO: page
                                0,                //TODO: page
                                'Social', 'SocialView', 'social', array($v_id)
                                );
      $data['add_comment_url'] = $v_request -> createUrl('Social', 'SocialCommentAdd');
      
      $data['add_comment_element_id'] = $v_id;
      $data['add_comment_id'] = 0;
      // -- Проверка наличия внесение комментариев текущим пользователем по данной соц.позиции
      $v_sp_comment_model = new SocialCommentModel();
      $v_sp_votes_model   = new SocialVotesModel();
      $v_count_comment = $v_sp_comment_model->GetCountRecComment($v_current_userID, $v_id);
      $v_count_votes   = $v_sp_votes_model->GetCountRecVotes($v_current_userID, $v_id);
      $data['count_comment'] = $v_count_comment;
      $data['count_votes'] = $v_count_votes;
      // ---
      $this->_view->assign('tab_list', TabController::getSocialTabs(false, false, false, false, true, $v_tab_name)); // Show tabs
      $this->_view->Social_View($data);
      $this->_view->parse();
    } else {
      Project::getResponse()->redirect($v_request->createUrl('Social', 'SocialMainList'));
    }
  }
  
  // -- Action "Мои позиции" - соц.позиции активного пользователя
  public function SocialUserListAction() {
    $v_request = Project::getRequest();
    $data = array();
    //$this->_BaseSiteData($data);
    $data['action'] = 'SocialUserList';
    $v_current_userID = (int)Project::getUser() -> getDbUser() -> id;
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/ ...bookmarks_list/0/0/
    // где bookmarks_list/{id_категории}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_n_page     = $v_request->getKeyByNumber(1);
    $this->_getData($data, 'SocialUserList', $v_categoryID, $v_n_page, $v_current_userID);
    $this->_get_categories($data, $v_categoryID);
    $this->_getSelectedCategory($data, $v_categoryID);
    $this->_view->assign('tab_list', TabController::getSocialTabs(false, false, true)); // Show tabs
    $this->_view->Social_UserList($data);
    $this->_view->parse();
  }
  
  // -- Action: Удалить соц.позицию
  public function SocialDeleteAction() {
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser()->getDbUser()->id;
    $v_spID = $v_request->getKeyByNumber(0);
    $v_categoryID = $this->_GetIDCategoryByIDPos($v_spID);
    $v_model = new SocialModel();
    $v_model->load($v_spID);
    if (($v_model->user_id == $v_current_userID) and ($v_spID > 0)) {
      $v_model->delete($v_spID);
    }
    Project::getResponse()->redirect($v_request->createUrl('Social', 'SocialUserList', array($v_categoryID)));
  }
  
  /**
  *  Action: Открытие формы создания соц.позиции
  */
  public function SocialPosAddAction() {
    $v_request = Project::getRequest();
    $data = array();
    $data['action'] = 'SocialPosAdd';
    $v_current_userID = Project::getUser()->getDbUser()->id; // ID залогиненного пользователя
    $v_sp_model = new SocialModel();
    $data['arr_social_tree_criteria'] = $v_sp_model->loadTreeCriteria();
    $data['arr_categories'] = $v_sp_model->loadCategories();
    //$this->_BaseSiteData($data);
    if ($v_request->btn_submit == null) {
      // -- Открытие формы для создания
      $this->_view->__set('product_places',$v_sp_model->getProductPlaces());
      $this->_view->assign('tab_list', TabController::getSocialTabs(false, false, false, true)); // Show tabs
      $this->_view->Social_PosAdd($data);
      $this->_view->parse();
    } else {
      // -- Анализ данных и сохранение
      if (($v_request->inp_sp_name == "") or
          ($v_request->inp_sp_comment == "")) 
          {
            // -- Данные неполные
            $data['inp_sp_name']    = $v_request->inp_sp_name;
            $data['inp_sp_comment'] = $v_request->inp_sp_comment;
            $this->_view->Social_PosAdd($data);
            $this->_view->addFlashMessage(FM::ERROR, 'Поля " * " должны быть заполнены');
            $this->_view->assign('tab_list', TabController::getSocialTabs(false, false, false, true)); // Show tabs
            $this->_view->parse();
          } else {
            // -- Сохранение данных  
            $v_model = new SocialModel();
            $v_model->social_tree_id = $v_request->inp_sp_category;
            $v_model->user_id        = $v_current_userID;
            $v_model->name           = $v_request->inp_sp_name;
            $v_model->creation_date  = date("Y-m-d H:i:s"); 
            if($v_request->type) {         
           		$address = urlencode($v_request->address);
                $Coords = file_get_contents('http://maps.google.com/maps/geo?q='.$address.'&output=csv&key=abcdefg');
    			list($status,$Zoom,$Xcoord,$Ycoord) = split(',',$Coords);
				if($status == 200) {
					$v_model->Xcoord = $Xcoord;
					$v_model->Ycoord = $Ycoord;
					$v_model->Zoom = $Zoom;
				}
            }
            else {
            	$v_model->id_product     = $v_request->id_product;		  	
            }
			$v_new_id =$v_model->save();          
            // -- Сохранение коммента
            $v_comment_model = new SocialCommentModel();
            $v_comment_model->addComment(Project::getUser()->getDbUser()->id, 0, 0, $v_new_id, $v_request->inp_sp_comment, 0, 0);
            // -- Сохранения связи соц.позиции и критериев
            $this->_SetVote($v_new_id, $v_request->inp_num_criteria_1, $v_request->inp_select_1);
            $this->_SetVote($v_new_id, $v_request->inp_num_criteria_2, $v_request->inp_select_2);
            $this->_SetVote($v_new_id, $v_request->inp_num_criteria_3, $v_request->inp_select_3);
            // = Запись в таблицу локировки голосования
            $v_sp_votes_model = new SocialVotesModel();
            $v_sp_votes_model->social_pos_id = $v_new_id;
            $v_sp_votes_model->user_id       = (int)Project::getUser()->getDbUser()->id;
            $v_sp_votes_model->ip            = $_SERVER['REMOTE_ADDR'];
            $v_sp_votes_model->save();

            Project::getResponse()->redirect($v_request->createUrl('Social', 'SocialUserList'));
          }
    }
  }
  
  /**
  * Action: Добавить комментарий к Соц.позиции
  */
  public function SocialCommentAddAction() {
    $v_request = Project::getRequest();
    $v_sp_id = (int)$v_request->element_id;
    if($v_sp_id > 0) {
      $v_comment_model = new SocialCommentModel();
      $v_comment_model->addComment(Project::getUser()->getDbUser()->id, 0, 0, $v_sp_id, $v_request->comment, 0, 0);
    } //TODO:...
    Project::getResponse()->redirect($v_request->createUrl('Social', 'SocialView', array($v_sp_id)));
  }
  
  /**
  *  Action: Удалить комментарий к Соц.позиции
  */
  public function SocialCommentDeleteAction() {
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser()->getDbUser()->id;
    $v_sp_id = $v_request->getKeyByNumber(0);
    $v_comment_id  = $v_request->getKeyByNumber(1);
    $v_comment_model = new SocialCommentModel($v_comment_id);
    $v_sp_model = new SocialModel();
    $v_sp_model->load($v_sp_id);
    if ( ($v_comment_model->id > 0) and 
         ($v_sp_model->id > 0) and 
         ($v_comment_model->social_pos_id == $v_sp_model->id))
    {
      if ( ($v_comment_model->user_id == $v_current_userID) or 
           ($v_sp_model->user_id == $v_current_userID) ) 
      {
        $v_comment_model->delete($v_comment_model->user_id, $v_comment_id);
      }
    }
    Project::getResponse()->redirect($v_request->createUrl('Social', 'SocialView', array($v_sp_id)));
  }
  
  /**
  * Action: Оценка соц.позиции
  */
  public function SocialVoteAddAction(){
    $v_request = Project::getRequest();
    $v_sp_id   = $v_request->getKeyByNumber(0);
    if ((int)$v_sp_id > 0) {
      $this->_SetVote($v_sp_id, $v_request->inp_criteria_id_1, $v_request->inp_select_1);
      $this->_SetVote($v_sp_id, $v_request->inp_criteria_id_2, $v_request->inp_select_2);
      $this->_SetVote($v_sp_id, $v_request->inp_criteria_id_3, $v_request->inp_select_3);
      // = Запись в таблицу локировки голосования
      $v_sp_votes_model = new SocialVotesModel();
      $v_sp_votes_model->social_pos_id = $v_sp_id;
      $v_sp_votes_model->user_id       = (int)Project::getUser()->getDbUser()->id;
      $v_sp_votes_model->ip            = $_SERVER['REMOTE_ADDR'];
      $v_sp_votes_model->save();
    }
    Project::getResponse()->redirect($v_request->createUrl('Social', 'SocialView', array($v_sp_id)));
  }
  

  /**
  * Формирует каталог категорий соц.позиций, уже упорядоченный в Моделе SocialCategoryModel
  */
  protected function _get_categories(&$data, $p_categoryID = null) {
    $v_sc_category_model =  new SocialCategoryModel();
    $v_categoryID        = (int)$p_categoryID;
    $data['social_category_list'] = $v_sc_category_model -> loadCategoryList();
    if ($v_categoryID > 0) {
      $data['social_category_selectedID'] = $v_categoryID;
    }
  }
  //$param = $v_request->getKeys(); // = Array ( [_path] => bookmarks_list ) - выбранный URL ..bookmarks_list/0/0/
  
  /**
  * Формирование всех основных данных для HTML-форм
  */
  protected function _getData( &$data, $p_action, $p_categoryID = null, $p_n_page = null, $p_userID = null, $p_str_find = null, $p_sort_rating =null) {
    $v_categoryID = (int)$p_categoryID;
    $v_n_page     = (int)$p_n_page;
    $v_userID     = (int)$p_userID;
    $v_model      = new SocialModel();
    $v_list_per_page = $this->getParam('social_pos_per_page', 4);
    $v_DbPager = new DbPager($v_n_page, $v_list_per_page);
    $v_model -> setPager($v_DbPager);
    $data['social_pos_list'] = $v_model->loadSocialPosList($v_categoryID, $v_userID, $p_str_find, $p_sort_rating);
    $v_pager_view = new SitePagerView();
    // Формируем объект-постраничный вывод
    $data['social_pos_list_pager'] = $v_pager_view->show2($v_model->getPager(), 'Social', $p_action, array($v_categoryID));
    // class SitePagerView -> function show2(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null)
  }
  
  // -- Используется для отрытия в HTML-форме category_panel.tpl.php Раздела категорий
  // из которого вызвана страница. Возвращает ID родителя Категории
  protected function _getSelectedCategory(&$data, $p_category_childID){
    $v_categoryID = (int)$p_category_childID;
    if ($v_categoryID != 0) {
      // Определяем Родителя и получаем выборку "id parent_id name"
      $v_model = new SocialModel();
      $v_row   = $v_model->loadCategoryByChildID($v_categoryID);
      if (count($v_row) > 0) {
        $data['category_row'] = $v_row;
      }
    }
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
  
  /**
  * Голосование - сохраняет связь 1 криетрия с соц.позицие - вызывается 3 раза для 1 позиции
  * $p_sp_id - ID позиции
  * $p_cr_id - ID критерия
  * $p_cr_val - Величина критерия в 1..10
  */
  private function _SetVote($p_sp_id =0, $p_cr_id = 0, $p_cr_val = 0){
    if (((int)$p_sp_id >0 ) and ((int)$p_cr_id > 0)){
      $v_sc_model = new  SocialPosCriteriaVoteModel();
      $v_id = $v_sc_model->GetIDBy($p_sp_id, $p_cr_id);
      $v_sc_model->load($v_id);
      $v_sc_model->social_pos_id      = $p_sp_id;
      $v_sc_model->social_criteria_id = $p_cr_id;
      $v_sc_model->votes_sum          = (int)$v_sc_model->votes_sum   + (int)$p_cr_val;
      $v_sc_model->votes_count        = (int)$v_sc_model->votes_count + 1;
      $v_sc_model->save();
    }
  }
    
}

?>
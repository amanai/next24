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
    /*
		$data['tab_add_bookmark']  = "Добавить закладку";
    $data['tab_category_edit'] = "Категория";
    $data['tab_bookmarks_import'] = "Импорт";
    */
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
	  $this->_BaseSiteData($data);
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
	  $this->_view->Social_MainList($data);
		$this->_view->parse();
  }

  /**
  * Action: Последние добавленные позиции (10 шт)
  */
	public function SocialLastAddPosAction() {
		$data = array();
		$this->_BaseSiteData($data);
		$data['action'] = 'SocialLastAddPos';
    $v_sc_model = new SocialModel();
    $data['social_pos_list'] = $v_sc_model->loadLastAddPos();
    $this->_view->Social_LastAddPos($data);
		$this->_view->parse();
	}               
  
  // -- Action "Просмотр соц.позиции": параметры соц.позиции, комментарии, добавление комментария
  public function SocialViewAction() {
    $v_request = Project::getRequest();
    $data = array();
    $this->_BaseSiteData($data);
    $data['action'] = 'SocialView';

    $v_id = (int)$v_request->getKeyByNumber(0);
    if ($v_id > 0) {
      $v_sp_model = new SocialModel();
      $v_sp_model->load($v_id);
      $v_sp_model->views++;
      $v_sp_model->save();
      $data['social_row'] = $v_sp_model->loadSocialRow($v_id);
      $v_tab_name = $data['social_row'][0]['name'];
      $v_encoding = mb_detect_encoding($v_tab_name);
      if (mb_strlen($v_tab_name, $v_encoding) > 50 ) $v_tab_name = mb_substr($v_tab_name, 0, 50, $v_encoding).'...';
      $data['tab_social_view'] = $v_tab_name;
      // ---
      /*
      $controller = new BaseCommentController();
      $data['comment_list'] = $controller -> CommentList(
                                'BookmarksCommentModel', 
                                $v_id,  
                                $v_request -> getKeyByNumber(1),   //TODO: page
                                20,                //TODO: page
                                'Bookmarks', 'BookmarksView', array($v_id), 
                                'Bookmarks', 'BookmarksCommentDelete'
                                );
      $data['add_comment_url'] = $v_request -> createUrl('Social', 'BookmarksCommentAdd');
      $data['add_comment_element_id'] = $v_id;
      $data['add_comment_id'] = 0;
      */
      // ---
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
    $this->_BaseSiteData($data);
    $data['action'] = 'SocialUserList';
    $v_current_userID = (int)Project::getUser() -> getDbUser() -> id;
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/ ...bookmarks_list/0/0/
    // где bookmarks_list/{id_категории}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_n_page     = $v_request->getKeyByNumber(1);
    $this->_getData($data, 'SocialUserList', $v_categoryID, $v_n_page, $v_current_userID);
    $this->_get_categories($data, $v_categoryID);
    $this->_getSelectedCategory($data, $v_categoryID);
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
  *  Action: Редактирование/создание закладки
  */
  public function BookmarksManageAction() {
    $v_request = Project::getRequest();
    $data = array();
    $data['action'] = 'BookmarksManage';
    $v_current_userID = Project::getUser()->getDbUser()->id; // ID залогиненного пользователя
    $v_bm_id = (int)$v_request->getKeyByNumber(0);
    $data['tab_manage_bookmark_name'] = (($v_bm_id == 0) ? "Добавление закладки" : "Редактирование закладки");

    $v_bm_model = new BookmarksModel();
    
    if ($v_request->submit == null) { 
      
      // --- Открытие вкладки на Добавление/Редактирование закладки
      $v_bm_category_model = new BookmarksCategoryModel();
      if($v_bm_id > 0) { // Закладка уже есть, читаем её данные
        $data['bookmark_row'] = $v_bm_model->load($v_bm_id);
        $v_tags_model = new BookmarksTagModel();
        $tags = $v_tags_model->loadTagsWhere(null, null, $v_bm_id, false);
        foreach ($tags as $tag) {
          $data['bookmarks_tag_list'].= $tag['tag_name'].', ';
        }
        $data['bookmarks_tag_list'] = rtrim($data['bookmarks_tag_list'], ', ');
      }
      $data['bookmarks_category_list'] = $v_bm_category_model -> loadCategoryList();
      $this->_BaseSiteData($data);
      $this->_view->Bookmarks_Manage($data);
      $this->_view->parse();
      return;
      // --- /Открытие вкладки на Добавление/Редактирование закладки
      
    } else { 
      
      // Нажата SUBMIT на форме. Сохранение закладки (после Добавления/Редактирования)
      if($v_bm_id > 0) {
        $data['bookmark_row'] = $v_bm_model->load($v_bm_id);
        if($v_bm_model->user_id != $v_current_userID) { // Чужая закладка
          Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksUser'));
        }
      }  
      
      if(   ($v_request->inp_bookmark_title       == null) 
				 or ($v_request->inp_bookmark_url         == null)   
         or ($v_request->inp_bookmark_description == null)
        ) {    //TODO validator
      // Данные, введеные в форме неполные - переоткрыть форму с сообщ.об ошибке и введенными данными
        $data['error'][] = 'Поля " * " должны быть заполнены';
        $v_bm_category_model = new BookmarksCategoryModel();
        $data['bookmarks_category_list'] = $v_bm_category_model -> loadCategoryList();
        $data['bookmarks_tag_list'] = $v_request->inp_tags;
        $data['bookmark_row']['title'] = $v_request->inp_bookmark_title;
        $data['bookmark_row']['url'] = $v_request->inp_bookmark_url;
        $data['bookmark_row']['bookmarks_tree_id'] = (int)$v_request->select_cat_id;
        $data['bookmark_row']['description'] = $v_request->inp_bookmark_description;
        $data['bookmark_row']['is_public'] = (($v_request->inp_check_public == 'on') ? 1 : 0);
        $data['bookmark_row']['user_id'] = $v_current_userID;
        //$data['question']['creation_date'] = date("Y-m-d H:i:s");
        $this->_BaseSiteData($data);
        $this->_view->Bookmarks_Manage($data);
        $this->_view->parse();
        return;
      }
      // Данные введенные в форме валидны - UPDATE/INSERT данных в таблицу
      // -- Формируем поля в _data:array() для UPDATE `bookmarks` SET ...
      $v_bm_model->user_id            = $v_current_userID;
      $v_bm_model->bookmarks_tree_id  = (int)$v_request->select_cat_id;
      $v_bm_model->url                = $v_request->inp_bookmark_url;
      $v_bm_model->title              = $v_request->inp_bookmark_title; 
      $v_bm_model->description        = $v_request->inp_bookmark_description;
      $v_bm_model->is_public          = (($v_request->inp_check_public == 'on') ? 1 : 0);
      if ($v_bm_id == 0) $v_bm_model->creation_date = date("Y-m-d H:i:s");
      // !!! Для возможности выполнить BaseModel->save()(UPDATE) необходимо, чтобы в моделе была 
      // выборка строго соответствующая полям базовой таблицы. Метод BaseModel->load() - идеален
      $v_bm_old_id = (int)$v_bm_id;
      $v_bm_id = $v_bm_model->save();
      
      // Вставка тегов
      $v_tags_model = new BookmarksTagModel();
      if ($v_bm_old_id > 0) { 
        // UPDATE закладки, запись уже существовала - обнулить теги
        $v_tags_model->deleteTagsLinkByBookmarkID($v_bm_old_id);
      }
      $arr_tags = array();
      $arr_tags = explode(",", trim($v_request->inp_tags));
      $arr_tags = array_slice(array_unique($arr_tags), 0, self::C_MAX_TAGS_COUNT);
      foreach ($arr_tags as $value) {
        $v_tagName = trim($value);
        $v_tagName = mb_substr($v_tagName, 0, self::C_MAX_TAG_LENGTH, mb_detect_encoding($v_tagName));
        if (mb_strlen($v_tagName)!=0) {
          if (count($v_tags_model->loadTagByName($v_tagName)) == 0) {
            // Такого тега в таблице тегов ещё нет - вставка тега
            $v_tags_model->name = $v_tagName;
            $v_tag_id = $v_tags_model->save();
          } else {
            // Такой тег есть в таблице тегов
            $v_tag_id = $v_tags_model->id;
          }
          $v_tags_model->clear();
          $v_tags_model->insertTagLink($v_bm_id, $v_tag_id);
        }
      }
      Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksUser'));
    }
  }
  
  // -- Action: Добавить комментарий к закладке
  public function BookmarksCommentAddAction() {
    $v_request = Project::getRequest();
    $v_bookmark_id = (int)$v_request->element_id;
    if($v_bookmark_id > 0) {
      $v_comment_model = new BookmarksCommentModel();
      $v_comment_model->addComment(Project::getUser()->getDbUser()->id, 0, 0, $v_bookmark_id, $v_request->comment, 0, 0);
    } //TODO:...
    Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksView', array($v_bookmark_id)));
  }
  
  // -- Action: Удалить комментарий к закладке
  public function BookmarksCommentDeleteAction() {
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser()->getDbUser()->id;
    $v_bookmark_id = $v_request->getKeyByNumber(0);
    $v_comment_id  = $v_request->getKeyByNumber(1);
    $v_comment_model = new BookmarksCommentModel($v_comment_id);
    $v_bookmarks_model = new BookmarksModel();
    $v_bookmarks_model->load($v_bookmark_id);
    if ( ($v_comment_model->id > 0) and 
         ($v_bookmarks_model->id > 0) and 
         ($v_comment_model->bookmark_id == $v_bookmarks_model->id))
    {
      if ( ($v_comment_model->user_id == $v_current_userID) or 
           ($v_bookmarks_model->user_id == $v_current_userID) ) 
      {
        $v_comment_model->delete($v_comment_model->user_id, $v_comment_id);
      }
    }
    Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksView', array($v_bookmark_id)));
  }
  
  /**
     Action: Создание/редактирование категории (дерево)
  */
  public function BookmarksCategoryEditAction(){
    $v_request = Project::getRequest();
    $data = array();   
    $data['action'] = 'BookmarksCategoryEdit';
    $this->_BaseSiteData($data);
    $v_category_id = ($p_category_id !== null) ? (int)$p_category_id : (int)$v_request -> getKeyByNumber(0);
    $this->_get_categories($data, $v_category_id);
    $this->_getSelectedCategory($data, $v_category_id);
    $this -> _view -> Bookmarks_CategoryEdit($data);
    $this -> _view -> parse();
  }
  
  /**
     Action: Записи категории (дерево)
  */
  public function BookmarksCategorySaveAction(){
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser()->getDbUser()->id;
    $data = array();   
    $data['action'] = 'BookmarksCategoryEdit';
    $this->_BaseSiteData($data);
    
    if ($v_request->inp_categiry_name == null) {
      // -- Название категории пусто - ничего не делаем - просто редирект
      Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksList'));
    } else {
      // -- Сохранение
      $v_bm_category_model = new BookmarksCategoryModel();
      $v_bm_category_model->user_id = $v_current_userID;
      $v_bm_category_model->name    = $v_request->inp_categiry_name;
      $v_bm_category_model->active  = 0;
      $v_bm_category_model->parent_id = (int)$v_request->sel_parent_category;
      $v_bm_category_model->save();
      Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksCategorySaveMessage'));
    }
  }
  
  /**
  * Action: Вывод сообщения о успешном сохранении категории
  */
  public function BookmarksCategorySaveMessageAction() {
    $v_request = Project::getRequest();
    $data = array();   
    $data['action'] = 'BookmarksCategorySaveMessage';
    $this->_BaseSiteData($data);
   
    $this -> _view -> Bookmarks_CategoryEdit($data);
    $this -> _view -> parse();
  }
  
  /**
  * Action: Импортирование закладок открытие формы
  */
  public function BookmarksImportFormAction($p_is_message = null) {
    $v_request = Project::getRequest();
    $data = array();   
    $this->_BaseSiteData($data);
    $data['action'] = 'BookmarksImportForm';
    // -- Открытие формы для вывода сообщения о успешности импорта = TRUE
    $data['is_show_message'] = ($p_is_message == true) ? true : false;
    $data['import_make_url'] = $v_request -> createUrl('Bookmarks', 'BookmarksImportMake');
    $data['max_file_upload_size'] = self::C_MAX_FILE_UPLOAD_SIZE;
    $this->_view->Bookmarks_Import($data);
    $this->_view->parse();
  }
  
  /**
  * Action: Импортирование закладок - процесс заливания
  */
  public function BookmarksImportMakeAction() {
    $v_request = Project::getRequest();
    $data = array();   
    $this->_BaseSiteData($data);
    $data['action'] = 'BookmarksImportMake';
    $data['import_make_url'] = $v_request -> createUrl('Bookmarks', 'BookmarksImportMake');
    
    // Процесс обработки файла
    
    // Проверка на ошибку
    if ($_FILES['inp_file']['error'] == UPLOAD_ERR_FORM_SIZE) {
      $this->_view->addFlashMessage(FM::ERROR, "Размер загружаемого файла слишком велик.");
      $this->BookmarksImportFormAction();
      return;
    }
    if ( ($_FILES['inp_file']['error'] == 0) and 
         ($_FILES['inp_file']['size'] < self::C_MAX_FILE_UPLOAD_SIZE)
       ) {
      // Ошибок нет и размер в границах
      $v_return = $this->_ImportProcess($_FILES['inp_file']['tmp_name']);
      if ($v_return ==1) {
        $this->_view->addFlashMessage(FM::ERROR, "Загружаемый файл не является файлом закладок.");
        $this->BookmarksImportFormAction();
        return;
      }
      $this->BookmarksImportFormAction(true);
      return;
    }
    
    Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksUser'));

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
    
}

?>
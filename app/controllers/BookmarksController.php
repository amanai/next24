<?php
/*
  Контроллер для работы с Закладками
*/
//print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';

class BookmarksController extends SiteController {
  const C_MAX_TAGS_COUNT = 10; // -- Максимальное кол-во тегов для вкладки. Остальные усекаются.
  const C_MAX_TAG_LENGTH = 30; // -- Максимальная длина тега в символах
  const C_MAX_FILE_UPLOAD_SIZE = 10000000; // -- Макс. размер загружаемого файла ~ 10 Мб

  function __construct($view_class = null) {
    if ($view_class === null) {
      $view_class = "BookmarksView"; // - привязываем класс Представления к данному Контроллеру
    }
    parent::__construct($view_class);
  }
  
  // -- BaseSiteData - определяет набор закладок, доступных на странице
	protected function _BaseSiteData(&$data) {
		$data['tab_list_name']     = "Каталог закладок";
		$data['tab_most_visit']    = "Самые посещаемые";
		$data['tab_my_list_name']  = "Мои закладки";
		$data['tab_add_bookmark']  = "Добавить закладку";
    $data['tab_category_edit'] = "Категория";
    $data['tab_bookmarks_import'] = "Импорт";
		parent::BaseSiteData();
	}
  
  /**
  * Action: Вызов вкладки "Каталог закладок" (Основная)
  * Action: BookmarksListAction - метод описывающий работу конкретного действия, 
  * зарегистрированного в таблице ACTION
  * 
  * Имя формируется строго: ИмяДействияAction. ИмяДействия_Action - уже не верно!
  */
	public function BookmarksListAction() {
		$v_request = Project::getRequest();
		$data = array();   
	  //$this->_BaseSiteData($data);
	  $data['action'] = 'BookmarksList';
    $data['show_imported_bookmarks'] = false;
	  // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/2/ ...bookmarks_list/0/0/2/
	  // где bookmarks_list/{id_категории}/{id_тега}/{номер страницы}/
	  $v_categoryID = $v_request->getKeyByNumber(0);
	  $v_tagID      = $v_request->getKeyByNumber(1);
	  $v_n_page     = $v_request->getKeyByNumber(2);
	  $this->_getData($data, 'BookmarksList', $v_categoryID, $v_n_page, 0, $v_tagID, true);
	  $this->_get_catalogs($data, $v_categoryID);
	  $this->_getSelectedCategory($data, $v_categoryID);
	  $this->_getSelectedTag($data, $v_tagID);
      $this->_view->assign('tab_list', TabController::getBookmarksTabs(true, false)); // Show tabs
	  $this->_view->Bookmarks_MainList($data);
	  $this->_view->parse();
  }

  // -- Action "Самые посещаемые" закладки. Критерий: 10 самых посещаемых
	public function BookmarksMostVisitAction() {
		$data = array();
		//$this->_BaseSiteData($data);
		$data['action'] = 'BookmarksMostVisit';
    $v_bookmarks_model = new BookmarksModel();
    $data['bookmarks_list'] = $v_bookmarks_model->loadMostVisit();
    $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, true)); // Show tabs
    $this->_view->Bookmarks_MostVisit($data);
		$this->_view->parse();
	}               
  
  // -- Action "Просмотр закладки": параметры закладки, комментарии, добавление комментария
  public function BookmarksViewAction() {
    $v_request = Project::getRequest();
    $data = array();
    //$this->_BaseSiteData($data);
    $data['action'] = 'BookmarksView';

    $v_id = (int)$v_request->getKeyByNumber(0);
    if ($v_id > 0) {
      $v_bookmarks_model = new BookmarksModel();
      $v_bookmarks_model->load($v_id);
      $v_bookmarks_model->views++;
      $v_bookmarks_model->save();
      $data['bookmark_row'] = $v_bookmarks_model->loadBookmarkRow($v_id);
      $v_tab_name = $data['bookmark_row']['title'];
      $v_encoding = mb_detect_encoding($v_tab_name);
      if (mb_strlen($v_tab_name, $v_encoding) > 50 ) $v_tab_name = mb_substr($v_tab_name, 0, 50, $v_encoding).'...';
      $data['tab_bookmarks_view'] = $v_tab_name;
      // ---
      $controller = new BaseCommentController();
      $data['comment_list'] = $controller -> CommentList(
                                $v_id,  
                                $v_request -> getKeyByNumber(1),   //TODO: page
                                0,                //TODO: page
                                'Bookmarks', 'BookmarksView', 'bookmarks', array($v_id)
                                );
      $data['add_comment_url'] = $v_request -> createUrl('Bookmarks', 'BookmarksCommentAdd');
      $data['add_comment_element_id'] = $v_id;
      $data['add_comment_id'] = 0;
      // ---
      $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, false, false, false, false, true, $v_tab_name)); // Show tabs
      $this->_view->Bookmarks_View($data);
      $this->_view->parse();
    } else {
      Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksList'));
    }
  }
  
  // -- Action "Мои закладки" - закладки активного пользователя
  public function BookmarksUserAction() {
    $v_request = Project::getRequest();
    $data = array();
    //$this->_BaseSiteData($data);
    $data['action'] = 'BookmarksUser';
    $data['show_imported_bookmarks'] = true;
    $v_current_userID = (int)Project::getUser() -> getDbUser() -> id;
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/ ...bookmarks_list/0/0/
    // где bookmarks_list/{id_категории}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_tagID      = $v_request->getKeyByNumber(1);
    $v_n_page     = $v_request->getKeyByNumber(2);
    $this->_getData($data, 'BookmarksUser', $v_categoryID, $v_n_page, $v_current_userID, $v_tagID, false);
    $this->_get_catalogs($data, $v_categoryID);
    $this->_getSelectedCategory($data, $v_categoryID);
    $this->_getSelectedTag($data, $v_tagID);
    $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, true)); // Show tabs
    $this->_view->Bookmarks_UserList($data);
    $this->_view->parse();
  }
  
  // -- Action: Удалить закладку
  public function BookmarksDeleteAction() {
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser()->getDbUser()->id;
    $v_bookmarkID = $v_request->getKeyByNumber(0);
    $v_categoryID = $this->_GetIDCategoryByIDBookmark($v_bookmarkID);
    if ($v_categoryID == 0) $v_categoryID = 'imported';
    $v_model = new BookmarksModel();
    $v_model->load($v_bookmarkID);
    if (($v_model->user_id == $v_current_userID) and ($v_bookmarkID > 0)) {
      $v_model->delete($v_bookmarkID);
      $v_tag_model = new BookmarksTagModel();
      $v_tag_model->deleteTagsLinkByBookmarkID($v_bookmarkID);
    }
    Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksUser', array($v_categoryID)));
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
      //$this->_BaseSiteData($data);
      $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, false, true)); // Show tabs
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
        //$this->_BaseSiteData($data);
        $this->_view->addFlashMessage(FM::ERROR, 'Поля " * " должны быть заполнены');
        $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, false, true)); // Show tabs
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
    //$this->_BaseSiteData($data);
    $v_category_id = ($p_category_id !== null) ? (int)$p_category_id : (int)$v_request -> getKeyByNumber(0);
    $this->_get_catalogs($data, $v_category_id);
    $this->_getSelectedCategory($data, $v_category_id);
    $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, false, false, true)); // Show tabs
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
    //$this->_BaseSiteData($data);
    
    if ($v_request->inp_categiry_name == null) {
      // -- Название категории пусто - ничего не делаем - просто редирект
      Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksList'));
    } else {
      // -- Сохранение
      $v_bm_category_model = new BookmarksCategoryModel();
      $v_bm_category_model->user_id = $v_current_userID;
      $v_bm_category_model->name    = $v_request->inp_categiry_name;
      $v_bm_category_model->active  = Project::getUser() -> isAdmin()?1:0;
      $v_bm_category_model->parent_id = (int)$v_request->sel_parent_category;
      $v_bm_category_model->save();
      
      // -- Отправка сообщения
	  if (!Project::getUser() -> isAdmin()) {
	  	$admin = new UserModel();
	  	$admin->loadAdmin();
	  	
	  	$view = new BaseSiteView();
	  	$view->setTemplate('mail', 'bookmarks_new_category.tpl.php');
	  	$view->assign('user', Project::getUser()->getDbUser());
	  	$view->assign('category', $v_bm_category_model);
	  	$body = nl2br($view->parse());
	  	
	  	$message = new MessagesModel();
	  	$message->sendMessage($admin->id, $admin->id, 'Новая категория в закладках', $body);
	  }
      // ---------------------
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
    //$this->_BaseSiteData($data);
   
    $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, false, false, true)); // Show tabs
    $this -> _view -> Bookmarks_CategoryEdit($data);
    $this -> _view -> parse();
  }
  
  /**
  * Action: Импортирование закладок открытие формы
  */
  public function BookmarksImportFormAction($p_is_message = null) {
    $v_request = Project::getRequest();
    $data = array();   
    //$this->_BaseSiteData($data);
    $data['action'] = 'BookmarksImportForm';
    // -- Открытие формы для вывода сообщения о успешности импорта = TRUE
    $data['is_show_message'] = ($p_is_message == true) ? true : false;
    $data['import_make_url'] = $v_request -> createUrl('Bookmarks', 'BookmarksImportMake');
    $data['max_file_upload_size'] = self::C_MAX_FILE_UPLOAD_SIZE;
    $this->_view->assign('tab_list', TabController::getBookmarksTabs(false, false, false, false, false, true)); // Show tabs
    $this->_view->Bookmarks_Import($data);
    $this->_view->parse();
  }
  
  /**
  * Action: Импортирование закладок - процесс заливания
  */
  public function BookmarksImportMakeAction() {
    $v_request = Project::getRequest();
    $data = array();   
    //$this->_BaseSiteData($data);
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

  // -- Формирует каталог закладок, уже упорядоченный в Моделе BookmarksCategoryModel
  protected function _get_catalogs(&$data, $p_categoryID = null) {
    $v_bookmarks_category_model =  new BookmarksCategoryModel();
    $v_categoryID           = (int)$p_categoryID;
    $data['bookmarks_category_list'] = $v_bookmarks_category_model -> loadCategoryList();
    if ($v_categoryID > 0) {
      $data['bookmarks_category_selectedID'] = $v_categoryID;
    }
  }
  //$param = $v_request->getKeys(); // = Array ( [_path] => bookmarks_list ) - выбранный URL ..bookmarks_list/0/0/
  
  // -- Формируем все основные данные для HTML-формы
  protected function _getData( &$data, $p_action, $p_categoryID = null, $p_n_page = null, $p_userID = null, $p_tagID = null, $p_show_only_public = false) {
    if ($p_categoryID == 'imported') {
      $v_categoryID = -1;
    } else {
      $v_categoryID = (int)$p_categoryID;
    }
    $v_n_page     = (int)$p_n_page;
    $v_userID     = (int)$p_userID;
    $v_tagID      = (int)$p_tagID;
    $v_model      = new BookmarksModel();
    $v_list_per_page = $this->getParam('bookmarks_per_page', 4);
    $v_DbPager = new DbPager($v_n_page, $v_list_per_page);
    $v_model -> setPager($v_DbPager);
    $data['bookmarks_list'] = $v_model->loadBookmarksList($v_categoryID, $v_userID, $v_tagID, (boolean)$p_show_only_public);
    $v_pager_view = new SitePagerView();
    // Формируем объект-постраничный вывод
    $data['bookmarks_list_pager'] = $v_pager_view->show2($v_model->getPager(), 'Bookmarks', $p_action, array($v_categoryID, $v_tagID));
    // class SitePagerView -> function show2(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null)
    if ($v_categoryID > 0) { // -- формирование облака тегов для выбранной категории
      $v_tags_model = new BookmarksTagModel();
      $data['bookmarks_tags_list'] = $v_tags_model->loadTagsWhere($v_categoryID, $v_userID, null, (boolean)$p_show_only_public);
    }
    /*
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/2/ ...bookmarks_list/0/0/2/
    // где bookmarks_list/{id_категории}/{id_тега}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_tagID      = $v_request->getKeyByNumber(1);
    $v_n_page     = $v_request->getKeyByNumber(2);
    $this->_getData($data, 'BookmarksList', $v_categoryID, $v_n_page, 0, $v_tagID, true);
    */
  }
  
  // -- Используется для отрытия в HTML-форме category_panel.tpl.php Раздела категорий
  // из которого вызвана страница. Возвращает ID родителя Категории
  protected function _getSelectedCategory(&$data, $p_category_childID){
    $v_categoryID = (int)$p_category_childID;
    if ($v_categoryID != 0) {
      // Определяем Родителя и получаем выборку "id parent_id name"
      $v_model = new BookmarksModel();
      $v_row   = $v_model->loadCategoryByChildID($v_categoryID);
      if (count($v_row) > 0) {
        $data['category_row'] = $v_row;
      }
    }
    if ($p_category_childID == 'imported') {
      $data['category_row']['0']['id']   = -1;
      $data['category_row']['0']['name'] = 'Импортированные';
    }
  }
  
  // -- Выбирает имя тега, по которому фильтруем набор закладок
  protected function _getSelectedTag(&$data, $p_id = null) {
    $v_id = (int)$p_id; 
    if ($v_id > 0) {
      $v_tag_model = new BookmarksTagModel();
      $v_row   = $v_tag_model->loadTagNameByID($v_id);
      if (count($v_row) > 0) {
        $data['tag_name_selected'] = $v_row['name'];
      }
    }
  }

  /**
  * Обработка файла импорта
  */
  protected function _ImportProcess($p_tmp_file_name) {
    if (file_exists($p_tmp_file_name)) {
      $v_fhandle = fopen($p_tmp_file_name, 'r');
      // -- Проверка заголовка
      if ($this->_CheckCaptionFile($v_fhandle) == -1) {
        fclose($v_fhandle);
        return 1; // -- Заголовок не верен - файл не закладки
      }
      // -- Получение кодировки файла с которой работаем
      $v_encoding_charset = $this->_GetEncodingFile($v_fhandle);
      fseek($v_fhandle, 0);
      while ($str = fgets($v_fhandle)) {
        if (mb_strpos(mb_strtolower($str), '<a href') !== false) {
          $v_href = mb_strtolower($str);
          $v_href = mb_substr($v_href, mb_strpos($v_href, '<a href')+9);
          $v_href = trim(mb_substr($v_href, 0, mb_strpos($v_href, '"')));
          $v_name = $str;
          $v_name = mb_substr($v_name, mb_strpos(mb_strtolower($v_name), '<a href')+10);
          $v_name = mb_substr($v_name, mb_strpos($v_name, '>')+1);
          if (strtolower($v_encoding_charset) == 'utf-8') {
            $v_name = trim(mb_substr($v_name, 0, mb_strpos($v_name, '<')));
          } else { // Win-1251
            $v_name = trim(substr($v_name, 0, strpos($v_name, '<')));
            $v_name = mb_convert_encoding($v_name, "UTF-8", $v_encoding_charset);
          }

          if ($v_name == '') $v_name = '[Заполнить]';
          // -- INSERT закладок
          $v_bm_model = new BookmarksModel();
          $v_bm_model->user_id            = Project::getUser()->getDbUser()->id; // ID залогиненного пользователя 
          $v_bm_model->bookmarks_tree_id  = 0;
          $v_bm_model->url                = $v_href;
          $v_bm_model->title              = $v_name; 
          $v_bm_model->description        = $v_name;
          $v_bm_model->is_public          = 0;
          $v_bm_model->creation_date = date("Y-m-d H:i:s");
          $v_bm_id = $v_bm_model->save();
        }
      }
      fclose($v_fhandle);
    }
    return 0;
  }
  
  /**
  * Проверка файла Закладок на корректность по заголовку
  * Поиск ведется с первых 5 строках
  */
  private function _CheckCaptionFile($p_file_handle) {
    fseek($p_file_handle, 0);
    $i = 0;
    while (($i < 6) and ($str = mb_strtolower(fgets($p_file_handle)))) {
      if (mb_strpos($str, mb_strtolower('NETSCAPE-Bookmark-file-1')) > 0 ) { return 0; }
      $i++;
    }
    return -1; // -- Заголовок не найден
  }
  
  /**
  * Получение кодировки файла 
  * <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=WINDOWS-1251">
  * <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
  * Рассматриваем 20 строк на поиск, т.к. возможны комментарии и т.д.
  */
  private function _GetEncodingFile($p_file_handle) {
    fseek($p_file_handle, 0);
    $i = 0;
    while (($i < 21) and ($str = mb_strtolower(fgets($p_file_handle)))) {
      $v_charset_pos = mb_strpos($str, 'charset=');
      if ($v_charset_pos > 0) { 
        $str = mb_substr($str, $v_charset_pos+8);
        $str = mb_substr($str, 0, mb_strpos($str, '"'));
        return $str;
      }
      $i++;
    }
    return "UTF-8"; // -- Кодировка по умолчанию
  }
  
  /**
  * Функция получения ID категории по ID закладки
  */
  private function _GetIDCategoryByIDBookmark($p_id_bookmark = null) {
    $v_id_bookmark = (int)$p_id_bookmark;
    if ($v_id_bookmark > 0) {
      $v_bm_model = new BookmarksModel();
      $v_row = $v_bm_model->load($v_id_bookmark);
      return $v_row['bookmarks_tree_id'];
      // для "Импортированные" ID Категории = 0
    }
    return -1; // -- Выбираемая закладка с несуществующим ID 
  }
  
  // ********** Админские функции ************** //
  public function CategoryFormAction() {
  	$request = Project::getRequest();
  	$category = new BookmarksCategoryModel();
  	$category -> load($request->id);
  	$this->_view->assign('category', $category);
  	$this->_view->assign('type', $request->type);
  	$this->_view->CategoryForm();
  	$this->_view->parse();
  }
  
  public function AllowDenyCategoryAction() {
  	$request = Project::getRequest();
  	$category = new BookmarksCategoryModel();
  	$category -> load($request->id);
  	$category -> active = $request->type;
  	if ($category->save()) {
      // -- Отправка сообщения
	  	$admin = new UserModel();
	  	$admin->loadAdmin();
	  	
	  	$view = new BaseSiteView();
	  	$view->setTemplate('mail', 'bookmarks_category_allowdeny.tpl.php');
	  	$view->assign('category', $category);
	  	$view->assign('type', $request->type);
	  	$view->assign('comment', $request->comment);
	  	
	  	$body = nl2br($view->parse());
	  	
	  	$message = new MessagesModel();
	  	$message->sendMessage($admin->id, $category -> user_id, 'Ответ на запрос на создание категории в закладках', $body);
      // ---------------------
  	}
  	$this->_view->CloseCategoryForm();
  	$this->_view->parse();
  	
  }
      
}

?>
<?php
/*
  Контроллер для работы с Закладками
*/
//print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';

class BookmarksController extends SiteController {
  const C_MAX_TAGS_COUNT = 10; // -- Максимальное кол-во тегов для вкладки. Остальные усекаются.

  function __construct($view_class = null) {
    if ($view_class === null) {
      $view_class = "BookmarksView"; // - привязываем класс Представления к данному Контроллеру
    }
    parent::__construct($view_class);
  }
  
  // -- BaseSiteData - определяет набор закладок, доступных на странице
	protected function _BaseSiteData(&$data) {
		$data['tab_list_name']    = "Каталог закладок";
		$data['tab_most_visit']   = "Самые посещаемые";
		$data['tab_my_list_name'] = "Мои закладки";
		$data['tab_add_bookmark'] = "Добавить закладку";
		parent::BaseSiteData();
	}
  
  // -- BookmarksListAction - метод описывающий работу конкретного действия, зарегистрированного 
  // в таблице ACTION
  // Имя формируется строго: ИмяДействияAction. ИмяДействия_Action - уже не верно!
	public function BookmarksListAction() {
		$v_request = Project::getRequest();
		$data = array();   
    $this->_BaseSiteData($data);
    $data['action'] = 'BookmarksList';
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/2/ ...bookmarks_list/0/0/2/
    // где bookmarks_list/{id_категории}/{id_тега}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_tagID      = $v_request->getKeyByNumber(1);
    $v_n_page     = $v_request->getKeyByNumber(2);
		$this->_getData($data, 'BookmarksList', $v_categoryID, $v_n_page, 0, $v_tagID, true);
    $this->_get_catalogs($data, $v_categoryID);
    $this->_getSelectedCategory($data, $v_categoryID);
    $this->_getSelectedTag($data, $v_tagID);
    $this->_view->Bookmarks_MainList($data);
		$this->_view->parse();
  }

  // -- Action "Самые посещаемые" закладки. Критерий: 10 самых посещаемых
	public function BookmarksMostVisitAction() {
		$data = array();
		$this->_BaseSiteData($data);
		$data['action'] = 'BookmarksMostVisit';
    $v_bookmarks_model = new BookmarksModel();
    $data['bookmarks_list'] = $v_bookmarks_model->loadMostVisit();
    $this->_view->Bookmarks_MostVisit($data);
		$this->_view->parse();
	}               
  
  // -- Action "Просмотр закладки": параметры закладки, комментарии, добавление комментария
  public function BookmarksViewAction() {
    $v_request = Project::getRequest();
    $data = array();
    $this->_BaseSiteData($data);
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
                                'BookmarksCommentModel', 
                                $v_id,  
                                $v_request -> getKeyByNumber(1),   //TODO: page
                                20,                //TODO: page
                                'Bookmarks', 'BookmarksView', array($v_id), 
                                'Bookmarks', 'BookmarksCommentDelete'
                                );
      $data['add_comment_url'] = $v_request -> createUrl('Bookmarks', 'BookmarksCommentAdd');
      $data['add_comment_element_id'] = $v_id;
      $data['add_comment_id'] = 0;
      // ---
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
    $this->_BaseSiteData($data);
    $data['action'] = 'BookmarksUser';
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
    $this->_view->Bookmarks_UserList($data);
    $this->_view->parse();
  }
  
  // -- Action: Удалить закладку
  public function BookmarksDeleteAction() {
    $v_request = Project::getRequest();
    $v_current_userID = (int)Project::getUser()->getDbUser()->id;
    $v_bookmarkID = $v_request->getKeyByNumber(0);
    $v_model = new BookmarksModel();
    $v_model->load($v_bookmarkID);
    if (($v_model->user_id == $v_current_userID) and ($v_bookmarkID > 0)) {
      $v_model->delete($v_bookmarkID);
      $v_tag_model = new BookmarksTagModel();
      $v_tag_model->deleteTagsLinkByBookmarkID($v_bookmarkID);
    }
    Project::getResponse()->redirect($v_request->createUrl('Bookmarks', 'BookmarksUser'));
  }
  
  // -- Action: Редактирование/создание закладки
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
        $tags = $v_tags_model->loadTagsWhere(null, null, $v_bm_id);
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
        if (strlen($v_tagName)!=0) {
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
	  $v_categoryID = (int)$p_categoryID;
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
      $data['bookmarks_tags_list'] = $v_tags_model->loadTagsWhere($v_categoryID, $v_userID);
    }
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

}

?>
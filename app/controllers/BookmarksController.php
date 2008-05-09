<?php
/*
  Контроллер для работы с Закладками
*/

class BookmarksController extends SiteController {

  function __construct($view_class = null) {
    if ($view_class === null) {
      $view_class = "BookmarksView"; // - привязываем класс Представления к данному Контроллеру
    }
    parent::__construct($view_class);
    //print '['.basename(__FILE__).'] line:'.__LINE__.' '.__METHOD__.'</br>';
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
    $v_user_id = (int)Project::getUser() -> getDbUser() -> id;
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/2/ ...bookmarks_list/0/0/2/
    // где bookmarks_list/{id_категории}/{id_тега}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_tagID      = $v_request->getKeyByNumber(1);
    $v_n_page     = $v_request->getKeyByNumber(2);
		$this->_getData($data, 'BookmarksList', $v_categoryID, $v_n_page, 0, $v_tagID);
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

    $v_id = (int)$v_request->getKeyByNumber(0);
    if ($v_id > 0) {
      $v_bookmarks_model = new BookmarksModel();
      $data['bookmark_row'] = $v_bookmarks_model->loadBookmarkRow($v_id);
      $v_tab_name = $data['bookmark_row']['title'];
      $v_encoding = mb_detect_encoding($v_tab_name);
      if (mb_strlen($v_tab_name, $v_encoding) > 50 ) $v_tab_name = mb_substr($v_tab_name, 0, 50, $v_encoding).'...';
      $data['tab_bookmarks_view'] = $v_tab_name;
      $this->_view->Bookmarks_View($data);
      $this->_view->parse();
    } else {
      Project::getResponse()->redirect($request->createUrl('Bookmarks', 'BookmarksList'));
    }
  }
  
  // -- Action "Мои закладки" - закладки активного пользователя
  public function BookmarksUserAction() {
    $v_request = Project::getRequest();
    $data = array();
    $this->_BaseSiteData($data);
    $data['action'] = 'BookmarksUser';
    $v_userID = (int)Project::getUser() -> getDbUser() -> id;
    // Номер выводимой страницы, определяется адресом bookmarks_list/0/1/ ...bookmarks_list/0/0/
    // где bookmarks_list/{id_категории}/{номер страницы}/
    $v_categoryID = $v_request->getKeyByNumber(0);
    $v_tagID      = $v_request->getKeyByNumber(1);
    $v_n_page     = $v_request->getKeyByNumber(2);
    $this->_getData($data, 'BookmarksUser', $v_categoryID, $v_n_page, $v_userID, $v_tagID);
    $this->_get_catalogs($data, $v_categoryID);
    $this->_getSelectedCategory($data, $v_categoryID);
    $this->_getSelectedTag($data, $v_tagID);
    $this->_view->Bookmarks_UserList($data);
    $this->_view->parse();
  }
  /*
  // -- Action: Добавить комментарий
  public function AddCommentAction() {
    $request = Project::getRequest();
    $question_model = new QuestionModel();
    $question_model->load($request->element_id);
    $answer_model = new AnswerModel();
    if($question_model->id > 0) {
      $answer_model->addComment(Project::getUser()->getDbUser()->id, 0, 0, $request->element_id, $request->comment, 0, 0);
      $question_model->a_count++;
      $question_model->save();
      
    } //TODO:...
    Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'ViewQuestion', array($question_model->id)));
  }
  */
  
  
  // -- Формирует каталог закладок, уже упорядоченный в Моделе BookmarksTreeModel
  protected function _get_catalogs(&$data, $p_categoryID = null) {
    $v_bookmarks_tree_model =  new BookmarksTreeModel();
    $v_categoryID           = (int)$p_categoryID;
    $data['bookmarks_catalog_list'] = $v_bookmarks_tree_model -> loadSortedAll();
    if ($v_categoryID > 0) {
      $data['bookmarks_catalog_selectedID'] = $v_categoryID;
    }
  }
  //$param = $v_request->getKeys(); // = Array ( [_path] => bookmarks_list ) - выбранный URL ..bookmarks_list/0/0/
  
  // -- Формируем все основные данные для HTML-формы
	protected function _getData(&$data, $p_action, $p_categoryID = null, $p_n_page = null, $p_userID = null, $p_tagID = null) {
	  $v_categoryID = (int)$p_categoryID;
	  $v_n_page     = (int)$p_n_page;
    $v_userID     = (int)$p_userID;
    $v_tagID      = (int)$p_tagID;
	  $v_model      = new BookmarksModel();
    $v_list_per_page = $this->getParam('bookmarks_per_page', 4);
    $v_DbPager = new DbPager($v_n_page, $v_list_per_page);
	  $v_model -> setPager($v_DbPager);
    $data['bookmarks_list'] = $v_model->loadBookmarksList($v_categoryID, $v_userID, $v_tagID);
	  $v_pager_view = new SitePagerView();
    // Формируем объект-постраничный вывод
    $data['bookmarks_list_pager'] = $v_pager_view->show2($v_model->getPager(), 'Bookmarks', $p_action, array($v_categoryID, $v_tagID));
    // class SitePagerView -> function show2(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null)
    if ($v_categoryID > 0) { // -- формирование облака тегов для выбранной категории
      $data['bookmarks_tags_list'] = $v_model->loadTagsByCategoryID($v_categoryID, $v_userID);
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
      $v_model = new BookmarksModel();
      $v_row   = $v_model->loadTageNameByID($v_id);
      if (count($v_row) > 0) {
        $data['tag_name_selected'] = $v_row['name'];
      }
    }
  }

/*
	protected function _list(&$data, $action, $catId = null, $tagId = null, $userId = null) {
		$param = Project::getRequest()->getKeys();
		array_shift($param);
		$question_model = new QuestionModel();
		$question_cat_model = new QuestionCatModel();
		if($catId > 0) {
			$tag_model = new QuestionTagModel();
			$data['question_tag_list'] = $tag_model->loadTags($catId);
		}
		$pager = new DbPager($request->pn, 20); //TODO: pageSize
		$question_model->setPager($pager);
		$data['question_list'] = $question_model->loadWhere($catId, $tagId, $userId);
		$data['question_cat_list'] = $question_cat_model->loadAll();
		$pager_view = new SitePagerView();
		$data['question_list_pager'] = $pager_view->show2($question_model->getPager(), 'QuestionAnswer', $action, $param);
	}

	public function ViewQuestionAction() {
		$request = Project::getRequest();
		$this->BaseSiteData($data);
		$id = (int)$request->getKeyByNumber(0);
		if($id > 0) {
			$question_model = new QuestionModel();
			$data['question'] = $question_model->loadQuestion($id);
			$data['question_tab'] = substr($question_model->q_text, 0, 100);
			count($question_model->q_text) > 100 ? $data['question_tab'] .= "..." : "";
			$controller = new BaseCommentController();
			$data['comment_list'] = $controller -> CommentList(
																'AnswerModel', 
																$id,  
																$request -> getKeyByNumber(1), 	//TODO: page
																20,  							//TODO: page
																'QuestionAnswer', 'ViewQuestion', array($id),
																'QuestionAnswer', 'AnswerDelete'
																);
			$data['add_comment_url'] = $request -> createUrl('QuestionAnswer', 'AddAnswer');
			$data['add_comment_element_id'] = $id;
			$data['add_comment_id'] = 0;
//			if($question_model->user_id == Project::getUser()->getDbUser()->id) $data['managed'] = true;
			$this->_view->ViewQuestion($data);
			$this->_view->parse();
		} else {
			Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'List'));
		}
	}
	
	public function ManagedQuestionAction() {
		$request = Project::getRequest();
		$data = array();
		$question_model = new QuestionModel();
		$id = (int)$request->getKeyByNumber(0);
		if(!$request->submit) {
			
			$question_cat_model = new QuestionCatModel();
			if($id > 0) {
				$data['question'] = $question_model->loadQuestion($id);
				$tags_model = new QuestionTagModel();
				$tags = $tags_model->loadWhere(null, null, $id);
				foreach ($tags as $tag) {
					$data['question_tag_list'].= $tag['name'].', ';
				}
				$data['question_tag_list'] = rtrim($data['question_tag_list'], ', ');
				$data['tab_manage_question_name'] = "Редактирование вопроса";
			}
			$data['question_cat'] = $question_cat_model->loadAll();
			$this->BaseSiteData($data);
			$this->_view->ManagedQuestion($data);
			$this->_view->parse();
		} else {
			if($id > 0) {
				$data['question'] = $question_model->load($id);
				if($question_model->user_id != Project::getUser()->getDbUser()->id) {
					Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'UserQuestions'));
				}
			}	
			
			if($request->question_text == null) {		//TODO validator
				$data['error'][] = "Заполните текст вопроса";
				$question_cat_model = new QuestionCatModel();
				$data['question_cat'] = $question_cat_model->loadAll();
				$data['question_tag_list'] = $request->tags;
				$data['question']['q_text'] = $request->question_text;
				$data['question']['question_cat_id'] = (int)$request->cat_id;
				$data['question']['user_id'] = Project::getUser()->getDbUser()->id;
				$data['question']['creation_date'] = date("Y-m-d H:i:s");
				$this->BaseSiteData($data);
				$this->_view->ManagedQuestion($data);
				$this->_view->parse();
				return;
			}

			$question_model->q_text = $request->question_text;
			$question_model->questions_cat_id = (int)$request->cat_id;
			$question_model->user_id = Project::getUser()->getDbUser()->id;
			$question_model->creation_date = date("Y-m-d H:i:s");
			$q_id = $question_model->save();
			$tag_model = new QuestionTagModel();
			$question_tag_model = new QTagModel();
			$question_tag_model->deleteByQuestionId($id);    	//TODO: revamp
			$tags_ar = array();
			$tags_ar = explode(",", $request->tags);
			foreach ($tags_ar as $tag) {
				$tag = trim($tag);	
				if(count($tag_model->loadByName($tag)) <= 0) {
					$tag_model->name = $tag;
					$tag_id = $tag_model->save();
					//if(count($question_tag_model->loadWhere($q_id, $tag_model->id)) <= 0) {
					//	$question_tag_model->question_id = $q_id;
					//	$question_tag_model->question_tag_id = $tag_model->id;
					//	$question_tag_model->save();
					//	$question_tag_model->clear();
					//}
				} else {
					$tag_id = $tag_model->id;
				}
					$tag_model->clear();
					$question_tag_model->question_id = $q_id;
					$question_tag_model->question_tag_id = $tag_id;
					$question_tag_model->save();
					$question_tag_model->clear();
			}
			Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'UserQuestions'));
		}
	}

	public function AddAnswerAction() {
		$request = Project::getRequest();
		$question_model = new QuestionModel();
		$question_model->load($request->element_id);
		$answer_model = new AnswerModel();
		if($question_model->id > 0) {
			$answer_model->addComment(Project::getUser()->getDbUser()->id, 0, 0, $request->element_id, $request->comment, 0, 0);
			$question_model->a_count++;
			$question_model->save();

		} //TODO:...
		Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'ViewQuestion', array($question_model->id)));
	}
	
	public function AnswerDeleteAction() {
		$request = Project::getRequest();
		$request_user_id = (int)Project::getUser()->getShowedUser()->id;
		$user_id = (int)Project::getUser()->getDbUser()->id;
		$question_id = $request->getKeyByNumber(0);
		$answer_id = $request->getKeyByNumber(1);
		$answer_model = new AnswerModel($answer_id);
		$question_model = new QuestionModel();
		$question_model->load($question_id);
		if (($answer_model->id > 0) && ($question_model->id > 0) && ($answer_model->question_id == $question_model->id)){
			if (($answer_model->user_id == $user_id) || ($question_model->user_id == $user_id)){
				$answer_model->delete($answer_model->user_id, $answer_id);
				$question_model->a_count--;
				$question_model->save();
			}
		}
		Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'ViewQuestion', array($question_model->id)));
	}

	public function DeleteAction() {
		$request = Project::getRequest();
		$user_id = (int)Project::getUser()->getDbUser()->id;
		$question_model = new QuestionModel();
		$question_model->load($request->getKeyByNumber(0));
		if ($question_model->user_id == $user_id) {
			$question_model->delete($request->getKeyByNumber(0));
		}
		Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'UserQuestions'));
	}

 */


}


?>
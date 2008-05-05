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
	protected function BaseSiteData(&$data) {
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
		$request = Project::getRequest();
		$data = array();
    $this->BaseSiteData($data);
    $data['action'] = 'BookmarksList';
    $user_id = (int)Project::getUser() -> getDbUser() -> id;
		$this->_list($data, 'BookmarksList', $request->getKeyByNumber(0), $request->getKeyByNumber(1), $user_id);
    $this->_get_catalogs($data);
    $this->_view->Bookmarks_List($data);
		$this->_view->parse();
  }

  // -- Action "Самые посещаемые" закладки. Критерий: 10 самых посещаемых
	public function BookmarksMostVisitAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData($data);
		$data['action'] = 'BookmarksMostVisit';
    $bookmarks_model = new BookmarksModel();
    $data['bookmarks_list'] = $bookmarks_model->loadMostVisit();
    $this->_view->Bookmarks_MostVisit($data);
		$this->_view->parse();
	}               
  
 // -- Формирует каталог закладок, уже упорядоченный в Моделе BookmarksTreeModel
  protected function _get_catalogs(&$data) {
    $v_bookmarks_tree_model =  new BookmarksTreeModel();
    $data['bookmarks_catalog_list'] = $v_bookmarks_tree_model -> loadSortedAll();
  }

	protected function _list(&$data, $action, $categoryID = null, $tagId = null, $userId = null) {
    $v_request = Project::getRequest();
	  $v_tree_id = (int)$v_request-> getKeyByNumber(0);
	  $v_n_page  = (int)$v_request -> getKeyByNumber(1);
    // Номер текущей выводимой страницы, определяется по адресу bookmarks_list/0/1/ ...bookmarks_list/0/0/
	  $param = $v_request->getKeys(); // = Array ( [_path] => bookmarks_list ) - выбранный URL ..bookmarks_list/0/0/
	  array_shift($param);
	  $bookmarks_model = new BookmarksModel();
    $list_per_page = $this->getParam('bookmarks_per_page', 4);
    $v_DbPager = new DbPager($v_n_page, $list_per_page);
	  $bookmarks_model -> setPager($v_DbPager);

    $data['bookmarks_list'] = $bookmarks_model->loadWhere($categoryID);
	  $pager_view = new SitePagerView();
    // Формируем объект-постраничный вывод
    $data['bookmarks_list_pager'] = $pager_view->show2($bookmarks_model->getPager(), 'Bookmarks', $action, array($v_tree_id));
    // class SitePagerView -> function show2(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null)
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
<?php

class QuestionAnswerController extends SiteController {
	
	function __construct($view_class = null) {
		if ($view_class === null) {
			$view_class = "QuestionAnswerView";
		}
		parent::__construct($view_class);
	}
	
	public function ListAction() {
		$request = Project::getRequest();
		$data = array();
		
		$question_cat_model = new QuestionCatModel();
		$data['question_cat'] = $question_cat_model->loadAll();
		
		$this->_list($data, 'List', $request->getKeyByNumber(0), $request->getKeyByNumber(1));
		$this->BaseSiteData($data);
		$data['action'] = 'List';
		$this->_view->assign('tab_list', TabController::getQuestionAnswerTabs(true, false, false));
		$this->_view->QuestionList($data);
		$this->_view->parse();
	}

	public function ListPopAction() {
		$request = Project::getRequest();
		$data = array();
		
		$question_cat_model = new QuestionCatModel();
		$data['question_cat'] = $question_cat_model->loadAll();
		
		$this->_list($data, 'List', $request->getKeyByNumber(0), $request->getKeyByNumber(1),null," ORDER BY questions.`a_count` DESC LIMIT ?d, ?d ");
		$this->BaseSiteData($data);
		$data['action'] = 'List';
		$this->_view->assign('tab_list', TabController::getQuestionAnswerTabs(false, true, false));
		$this->_view->QuestionPopList($data);
		$this->_view->parse();
	}
	public function ListStatAction() {
		$request = Project::getRequest();
		$v_request = $request;
		$v_session = Project::getSession(); 
		$data = array();
    	$v_sort = null;
   	 	if ($v_request->inp_sort != null)  {
      		$v_sort = strtoupper($v_request->inp_sort); 
      		$v_session -> add('question_sort', $v_sort);
    	} else {
      		$v_sort = $v_session -> getKey('question_sort', null);
    	}
    	$v_sort_type = null;
		if ($v_request->type != null)  {
      	$v_sort_type = strtoupper($v_request->type); 
      	$v_session -> add('question_type_sort', $v_sort_type);
    	} else {
      	$v_sort_type = $v_session -> getKey('question_type_sort', null);
    	}  		
    	
		$question_cat_model = new QuestionCatModel();
		$data['question_cat'] = $question_cat_model->loadAll();
		
		$this->_list($data, 'List', $request->getKeyByNumber(0), $request->getKeyByNumber(1),null,null,$v_sort_type,$v_sort);
		$this->BaseSiteData($data);
		$data['action'] = 'List';
		$this->_view->assign('tab_list', TabController::getQuestionAnswerTabs(false, false, true));
		$this->_view->QuestionStatList($data);
		$this->_view->parse();
	}	
		
	public function UserQuestionsAction() {
		$request = Project::getRequest();
		$data = array();
		$this->_list($data, 'UserQuestions', $request->getKeyByNumber(0), $request->getKeyByNumber(1), Project::getUser()->getDbUser()->id);
		$this->BaseSiteData($data);
		$data['action'] = 'UserQuestions';
		$this -> _view -> assign('tab_list', TabController::getOwnTabs(false,false,false,false,false,false,true,false,false,false));
		$this->_view->MyQuestionList($data);	
		$this->_view->parse();
	}
	
	public function UserQuestionsAnswersAction() {
		$request = Project::getRequest();
		$data = array();
		$this->_list($data, 'UserQuestions', $request->getKeyByNumber(0), $request->getKeyByNumber(1), Project::getUser()->getDbUser()->id);
		$this->BaseSiteData($data);
		$data['action'] = 'UserQuestions';
		$this -> _view -> assign('tab_list', TabController::getOwnTabs(false,false,false,false,false,false,true,false,false,false));
		$this->_view->MyAnswersList($data);	
		$this->_view->parse();
	}
	
	protected function _list(&$data, $action, $catId = null, $tagId = null, $userId = null, $order = null, $sort_type = null, $sort = null) {
		$param = Project::getRequest()->getKeys();
		array_shift($param);
		$question_model = new QuestionModel();
		$question_cat_model = new QuestionCatModel();
		if($catId > 0) {
			$tag_model = new QuestionTagModel();
			$data['question_tag_list'] = $tag_model->loadTags($catId);
		}
   		$v_request = Project::getRequest();
   		$v_session = Project::getSession(); 
		$request_keys = $v_request->getKeys();
		$questions_per_page = $request_keys['qpp'];
		if($questions_per_page) {
			if(in_array($questions_per_page,array(10,20,30))) {
				$v_session->add('qpp',$questions_per_page);	
				$v_list_per_page = $questions_per_page;
			}
			else {
				$v_list_per_page = 10;
				$v_session->add('qpp',$v_list_per_page);	
			}
  		}
  		else {
  			if($v_session->getKey('qpp')) $v_list_per_page = $v_session->getKey('qpp');
  			else $v_list_per_page = 10;
  		}			
		//$pager = new DbPager($request->pn, 20); //TODO: pageSize
		$pager = new DbPager($request->pn, $v_list_per_page);
		$question_model->setPager($pager);		
		$data['question_list'] = $question_model->loadWhere($catId, $tagId, $userId, $order, $sort_type, $sort);
		$data['question_cat_list'] = $question_cat_model->loadAll();
		$pager_view = new SitePagerView();
		$data['question_list_pager'] = $pager_view->show2($question_model->getPager(), 'QuestionAnswer', $action, $param);
	}
	

	public function ViewQuestionAction() { 
		$request = Project::getRequest();
		$this->BaseSiteData($data);
		$id = (int)$request->getKeyByNumber(0);	
		$question_cat_model = new QuestionCatModel();
		$data['question_cat_list'] = $question_cat_model->loadAll();
		if($id > 0) {
			$question_model = new QuestionModel();
			$data['question'] = $question_model->loadQuestion($id);
			
			$data['question_tab'] = $question_model->getNWordsFromText($question_model->q_text, 8);

			$controller = new BaseCommentController();
			$data['comment_list'] = $controller -> CommentList(
																$id,  
																$request -> getKeyByNumber(1), 	//TODO: page
																0,  							//TODO: page
																'QuestionAnswer', 'ViewQuestion', 'questions', array($id)
																);

//			if($question_model->user_id == Project::getUser()->getDbUser()->id) $data['managed'] = true;
			$this -> _view -> assign('tab_list', TabController::getOwnTabs(false,false,false,false,false,false,true,false,false,false));
			//$this->_view->assign('tab_list', TabController::getQuestionAnswerTabs(true, false, false, false, false));
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
		$question_cat_model = new QuestionCatModel();
		$data['question_cat_list'] = $question_cat_model->loadAll();		
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
			$this -> _view -> assign('tab_list', TabController::getOwnTabs(false,false,false,false,false,false,true,false,false,false));
			//$this->_view->assign('tab_list', TabController::getQuestionAnswerTabs(false, false, false, false, true));
			$this->_view->ManagedQuestion($data);
			$this->_view->parse();
		} else {
			if($id > 0) {
				$data['question'] = $question_model->load($id);
				if($question_model->user_id != Project::getUser()->getDbUser()->id) {
					if($request->desktop_question) {
						Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'UserQuestions'));
					}
					else { 
						Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'List'));
					}				
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
					/*if(count($question_tag_model->loadWhere($q_id, $tag_model->id)) <= 0) {
						$question_tag_model->question_id = $q_id;
						$question_tag_model->question_tag_id = $tag_model->id;
						$question_tag_model->save();
						$question_tag_model->clear();	
					}*/
				} else {
					$tag_id = $tag_model->id;
				}
					$tag_model->clear();	
					$question_tag_model->question_id = $q_id;
					$question_tag_model->question_tag_id = $tag_id;
					$question_tag_model->save();
					$question_tag_model->clear();
			}
			if($request->desktop_question) {
				Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'UserQuestions'));
			}
			else { 
				Project::getResponse()->redirect($request->createUrl('QuestionAnswer', 'List'));
			}	
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
	
	protected function BaseSiteData(&$data) {
		$data['tab_list_name'] = "Каталог вопросов";
		$data['tab_my_list_name'] = "Мои вопросы";
		$data['tab_manage_question_name'] = "Задать вопрос";
		parent::BaseSiteData();
	}
}


?>
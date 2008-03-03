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
		$question_model = new QuestionModel();
		$question_cat_model = new QuestionCatModel();
		$pager = new DbPager($request->pn, 20); //TODO: pageSize
		$question_model->setPager($pager);
		$param = array();
		if($request->cat_id !== null) {
			$param['cat_id'] = (int)$request->cat_id;
			if($request->tag_id !== null) {
				$param['tag_id'] = (int)$request->tag_id;
				$data['question_list'] = $question_model->loadByTag($param['tag_id']);
			} else {
				$data['question_list'] = $question_model->loadByCat($param['cat_id']);
			}
			$tag_model = new QuestionTagModel();
			$data['tag_list'] = $tag_model->loadByCat((int)$param['cat_id']);
		} else {
			$data['question_list'] = $question_model->loadAll();
		}
		$data['question_cat_list'] = $question_cat_model->loadAll();
		$data['tab_name'] = 'Последние вопросы';
		$pager_view = new SitePagerView();
		$data['question_list_pager'] = $pager_view->show($question_model->getPager(), 'QuestionAnswer', 'List', $param);
		$this->BaseSiteData();
		$this->_view->QuestionList($data);
		$this->_view->parse();
	}
	
	public function ViewQuestionAction() { 
		$request = Project::getRequest();
		$this->BaseSiteData();
		if($request->id !== null) {
			$question_model = new QuestionModel();
			$data['question'] = $question_model->loadQuestion($request->id);
			$controller = new BaseCommentController();
			$data['comment_list'] = $controller -> CommentList(
																'AnswerModel', 
																$request->id,  
																$request -> getKeyByNumber(0), 	//TODO: page
																20,  							//TODO: page
																'QuestionAnswer', 'ViewQuestion', array($request->id), 
																'QuestionAnswer', 'AnswerDelete'
																);
			$this->_view->ViewQuestion($data);
			$this->_view->parse();
		}
	}
	
	public function AddQuestionAction() {
		$request = Project::getRequest();
		//TODO: 

	}
	
	public function AddAnswerAction() {
		
	}
	
}


?>
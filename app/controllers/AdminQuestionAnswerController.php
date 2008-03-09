<?php 
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AdminController.php');

class AdminQuestionAnswerController extends AdminController {
	
	public function __construct() {
		parent::__construct("AdminQuestionAnswerView");
	}
	
	public function IndexAction() {
		$this->BaseAdminData();
		$this->_view->Index();
		$this->_view->parse();
	}
	
	public function CatListAction() {
		$request = Project::getRequest();
		$this->BaseAdminData();
		$data = array();
		$model = new QuestionCatModel();
		$data['cat_list'] = $model->loadAll('sortfield');
		$this->_view->CatList($data);
		$this->_view->parse();
	}
	
	public function MoveCatAction() {
		$request = Project::getRequest();
		$frCat = $request->getKeyByNumber(0);
		$toCat = $request->getKeyByNumber(1);
		if($frCat !== null && $toCat !== null) {
			$frCatModel = new QuestionCatModel();
			$toCatModel = new QuestionCatModel();
			$res = $frCatModel->load((int)$frCat);
			$frCatModel->bind($res);
			$res = $toCatModel->load((int)$toCat);
			$toCatModel->bind($res);
			$tmp = $frCatModel->sortfield;
			$frCatModel->sortfield = $toCatModel->sortfield;
			$toCatModel->sortfield = $tmp;
			$frCatModel->save();
			$toCatModel->save();
		}
		Project::getResponse()->Redirect($request->createUrl('AdminQuestionAnswer','CatList'));
	}
	
	public function ManagedCatAction() {
		$request = Project::getRequest();
		$data = array();
		$model = new QuestionCatModel();
		$id = $request->getKeyByNumber(0);
		if(!$request->save) {
			if($id > 0) {
				$data['cat'] = $model->load($id);
			}
			$data['cat_list'] = $model->loadAll('sortfield');
			$this->BaseAdminData();
			$this->_view->ManagedCat($data);
			$this->_view->parse();
		} else {
			if($id > 0) {
				$model->load($id);
			}
			$model->name = $request->name;
			$model->sortfield = $request->after_item+1;
			$model->save();
			Project::getResponse()->Redirect($request->createUrl('AdminQuestionAnswer','CatList'));
		}
		
	}
	
	public function DeleteCatAction() {
		$request = Project::getRequest();
		if($request->getKeyByNumber(0) > 0) {
			$model = new QuestionCatModel();
			$model->delete((int)$request->getKeyByNumber(0));
		}
		Project::getResponse()->Redirect($request->createUrl('AdminQuestionAnswer','CatList'));		
	}
	
	public function QuestionListAction() {
		$request = Project::getRequest();
		$param = $request->getKeys();
		array_shift($param);
		$data = array();
		$question_model = new QuestionModel();
		$question_cat_model = new QuestionCatModel();
		if ($request->getKeyByNumber(0) !== null) {
			$tag_model = new QuestionTagModel();
			$data['tag_list'] = $tag_model->loadTags($request->getKeyByNumber(0));
		}
		$data['question_cat_list'] = $question_cat_model->loadAll();
		$pager = new DbPager($request->pn, 20); //TODO: pageSize
		$question_model->setPager($pager);		
		$data['question_list'] = $question_model->loadWhere($request->getKeyByNumber(0), $request->getKeyByNumber(1));
		$pager_view = new SitePagerView();
		$data['pager'] = $pager_view->show($question_model->getPager(), 'AdminQuestionAnswer', 'QuestionList', $param);
		$this->BaseAdminData();
		$this->_view->QuestionList();
		$this->_view->parse();
	}
	
	
	
	
	
}
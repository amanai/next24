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
		if(!$request->getKeyByNumber(1)) {
			$data['action_name'] = "Создать категорию";
			if($id > 0) {
				$data['action_name'] = "Редактировать категорию";
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
		if ($request->getKeyByNumber(0) > 0) {
			$tag_model = new QuestionTagModel();
			$data['tag_list'] = $tag_model->loadTags($request->getKeyByNumber(0));
		}
		$data['cat_list'] = $question_cat_model->loadAll();
		$pager = new DbPager($request->pn, 20); //TODO: pageSize
		$question_model->setPager($pager);		
		$data['question_list'] = $question_model->loadWhere($request->getKeyByNumber(0), $request->getKeyByNumber(1));
		$pager_view = new SitePagerView();
		$data['pager'] = $pager_view->show($question_model->getPager(), 'AdminQuestionAnswer', 'QuestionList', $param);
		$this->BaseAdminData();
		$this->_view->QuestionList($data);
		$this->_view->parse();
	}
	
	public function DeleteQuestionAction() {
		$request = Project::getRequest();
		if($request->getKeyByNumber(0) > 0) {
			$model = new QuestionModel();
			$model->delete((int)$request->getKeyByNumber(0));
		}
		Project::getResponse()->Redirect($request->createUrl('AdminQuestionAnswer','QuestionList'));		
	}
	
	public function EditQuestionAction() {
		$request = Project::getRequest();
		$id = $request->getKeyByNumber(0);
		$data = array();
		if(!$request->getKeyByNumber(1)) {
			if($id > 0) {
				$model = new QuestionModel();
				$cat_model = new QuestionCatModel();
				$tag_model = new QuestionTagModel();
				$data['question'] = $model->load($id);
				$data['cat_list'] = $cat_model->loadAll();
				$tags_model = new QuestionTagModel();
				$tags = $tags_model->loadWhere(null, null, $id);
				foreach ($tags as $tag) {
					$data['tags'].= $tag['name'].', ';
				}
				$data['tags'] = rtrim($data['tags'], ', ');
				$this->BaseAdminData();
				$this->_view->EditQuestion($data);
				$this->_view->parse();
			}
		} else {
			if($id > 0) {
				$model = new QuestionModel();
				$model->load($id);
				$model->q_text = $request->question_text;
				$model->questions_cat_id = (int)$request->cat_id;
				$id = $model->save();
				$tag_model = new QuestionTagModel();
				$question_tag_model = new QTagModel();
				$tags_ar = array();
				$tags_ar = explode(",", $request->tags);
				foreach ($tags_ar as $tag) {
					$tag = trim($tag);	
					if(count($tag_model->loadByName($tag)) == 0) {
						$tag_model->name = $tag;
						$tag_id = $tag_model->save();
						$tag_model->clear();	
						$question_tag_model->question_id = $id;
						$question_tag_model->question_tag_id = $tag_id;
						$question_tag_model->save();
						$question_tag_model->clear();				
					} else {
						$question_tag_model->question_id = $id;
						$question_tag_model->question_tag_id = $tag_model->id;
						$question_tag_model->save();
						$question_tag_model->clear();
					}
				}
			}
			Project::getResponse()->Redirect($request->createUrl('AdminQuestionAnswer','QuestionList'));
		}
	}
	
	
	
	
	
	
}
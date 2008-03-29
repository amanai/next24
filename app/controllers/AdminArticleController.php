<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AdminController.php');

class AdminArticleController extends AdminController {
	
	public function __construct() {
		parent::__construct("AdminArticleView");
	}
	
	public function ResetRateAction() {
		$request = Project::getRequest();
		$article_vote_controller = new ArticleVoteModel();
		$article_vote_controller->deleteByArticleId($request->getKeyByNumber(0));
	}
	
	public function ShowTreeAction() {
		$data = array();
		$n = Node::by_key('', 'articles_tree');
		$data['tree'] = $n->getBranch();
		$this->_view->ShowTree($data);
		$this->_view->parse();		
	}
	
	public function ManagedSectionAction() {
		$request = Project::getRequest();
		if(!$request->submit) {
			$data = array();
			$this->BaseAdminData();
			$article_tree_model = new ArticleTreeModel();
			$data['cat_list'] = $article_tree_model->loadByParentId(0);
			$this->_view->ManagedSection($data);
			$this->_view->parse();
		} else {
			$id = (int)$request->getKeyByNumber(0);
			$article_tree_model = new ArticleTreeModel();
			if($id > 0) {
				$article_tree_model->load($id);
			}
			$node = Node::by_id($request->parent_id, 'articles_tree');
			$key = $node->getNewKey();
			if($key->level < 5) {
				$article_tree_model->user_id = Project::getUser()->getDbUser()->id;
				$article_tree_model->name = $request->section_name;
				$article_tree_model->key = $key;
				$article_tree_model->level = $key->level;
				$article_tree_model->save();
			}
			
		}
	}
	
	public function DeleteSectionAction() {
		$request = Project::getRequest();
		$id = (int)$request->getKeyByNumber(0);
		if($id > 0) {
			$article_tree_model = new ArticleTreeModel();
			$article_tree_model->delete($id);
		}
	}
	
	public function DeleteArticleAction() {
		$request = Project::getRequest();
		$id = (int)$request->getKeyByNumber(0);
		if($id > 0) {
			$article_model = new ArticleModel();
			$article_model->delete($id);
		}
	}
	
	public function SetCompetitionAction() {
		
	}
	
	
	
}

?>
<?php

class ArticleController extends SiteController {
	
	public function __construct() {
		if ($view_class === null) {
			$view_class = "ArticleView";
		}
		parent::__construct($view_class);
	}
	
	public function ListAction() {
		$request = Project::getRequest();
		$data = array();
		$tree_model = new ArticleTreeModel();
		$article_model = new ArticleModel();
		$data['cat_list'] = $tree_model->loadByParentId((int)$request->getKeyByNumber(0));
		$data['article_list'] = $article_model->loadByParentId((int)$request->getKeyByNumber(0));		
		
		
	}
	
	public function LastListAction() {
		$data = array();
		$this->_articleList($data, null, 'a.creation_date', 'DESC', 10, 'LastList');
		var_dump($data);
	}
	
	public function TopListAction() {
		$data = array();
		$this->_articleList($data, null, 'a.votes', 'DESC', 10, 'TopList');
		var_dump($data);
	}
	
	private function _articleList(&$data, $userId, $sortName, $sortOrder, $per_page, $action) {
		$request = Project::getRequest();
		$article_model = new ArticleModel();
		$pager = new DbPager($request -> getKeyByNumber(0), $per_page);
		$article_model->setPager($pager);
		$data['article_list'] = $article_model->loadWhere($userId, $sortName, $sortOrder);
		$pager_view = new SitePagerView();
		$data['article_list_pager'] = $pager_view->show2($article_model->getPager(), 'Article', $action);
	}
	
	public function AddArticleAction() {
		$request = Project::getRequest();
		var_dump($request);
		$article_tree_model = new ArticleTreeModel();
		$data['cat_list'] = $article_tree_model->loadByParentId(0);
		$article_tree_model->load(2);
		$this->_view->AddArticle($data);
		$this->_view->parse();
	}
	
	public function AjaxChangeCatAction() {
		$request = Project::getRequest();
		$parent_id = $request->getKeyByNumber(0);
		$article_tree_model = new ArticleTreeModel();
		$article_tree_model->load($parent_id);
		if($article_tree_model->level < 5) {
			$data['cat_list'] = $article_tree_model->loadByParentId($parent_id);
			if(count($data['cat_list']) > 0) {
				$data['block_name'] = "level";
				$data['block_name'].=$article_tree_model->level+1;
				$data['level'] = $article_tree_model->level+1;
				$this->_view->AjaxChangeCat($data);
				$this ->_view->ajax();
			}
		}	
	}
	
}

?>
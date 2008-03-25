<?php

class ArticleController extends SiteController {
	private $_countPages = 0;
	
	public function __construct() {
		if ($view_class === null) {
			$view_class = "ArticleView";
		}
		parent::__construct($view_class);
	}
	
	public function ListAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData($data);
		$tree_model = new ArticleTreeModel();
		$article_model = new ArticleModel();
		$data['cat_list'] = $tree_model->loadByParentId((int)$request->getKeyByNumber(0));
		$data['article_list'] = $article_model->loadByParentId((int)$request->getKeyByNumber(0));
		$this->_view->ArticleList($data);
		$this->_view->parse();
	}
	
	public function LastListAction() {
		$data = array();
		$this->BaseSiteData($data);
		$this->_articleList($data, null, 'a.creation_date', 'DESC', 10, 'LastList');
		$this->_view->LastList($data);
		$this->_view->parse();
	}
	
	public function TopListAction() {
		$data = array();
		$this->BaseSiteData($data);
		$this->_articleList($data, null, 'a.votes', 'DESC', 10, 'TopList');
		$this->_view->TopList($data);
		$this->_view->parse();
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
		if(!$request->submit) {
			$article_tree_model = new ArticleTreeModel();
			$data['cat_list'] = $article_tree_model->loadByParentId(0);
			$this->_view->AddArticle($data);
			$this->_view->parse();
		} else {
			$article_model = new ArticleModel();
			$article_page_model = new ArticlePageModel();
			$article_model->articles_tree_id = (int)$request->category;
			//$article_model->user_id = Project::getUser()->getDbUser()->id;;
			$article_model->title = $request->title;
			$article_model->allowcomments = (bool)$request->allow_comment;
			$article_model->rate_status = (bool)$request->allow_rate;
			$article_model->creation_date = date("Y-m-d H:i:s");
			$id = $article_model->save();
			for($i = 0; $i < count($request->page_title); $i++) {
				$article_page_model = new ArticlePageModel();
				$article_page_model->article_id = $id;
				$article_page_model->title = $request->page_title[$i];
				$article_page_model->p_text = $request->page_text[$i];
				$article_page_model->save();
			}
		}
		
	}
	
	public function ArticleViewAction() {
		$request = Project::getRequest();
		$data = array();
		$id = (int)$request->getKeyByNumber(0);
		$pageId = (int)$request->getKeyByNumber(1);
		if($id > 0) {
			$this->BaseSiteData($data);
			$article_model = new ArticleModel();
			$article_page_model = new ArticlePageModel();
			$article_tree_model = new ArticleTreeModel();
			$article_vote_model = new ArticleVoteModel();
			$article_vote_model->loadByArticleUser($id, Project::getUser()->getDbUser()->id);
			$pages = $article_page_model->loadByArticleId($id);
			$data['article'] = $article_model->load($id);
			$data['category'] = $article_tree_model->load($article_model->articles_tree_id);
			$data['page_content'] = $pages[$pageId];
			$data['pager_view'] = $this->_view->ShowPager(count($pages), $pageId, 'Article', 'ArticleView', array($id));
			$data['vote_status'] = $article_vote_model->count();
			$article_model->views++;
			$article_model->save();
			$this->_view->ViewArticle($data);
			$this->_view->parse();
		}
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
	
	public function AjaxAddPageAction() {
		$this->_countPages++;
		$data = array();
		$data['page_number'] = $this->_countPages;
		$this->_view->AjaxAddPage($data);
		$this->_view->ajax();
	}
	
	public function VoteAction() {
		$request = Project::getRequest();
		$articleId = (int)$request->getKeyByNumber(0);
		$userId = Project::getUser()->getDbUser()->id;
		$article_model = new ArticleModel();
		$article_model->load($articleId);
		$article_vote_model = new ArticleVoteModel();
		if(count($article_vote_model->loadByArticleUser($articleId, $userId)) <= 0 && $article_model->rate_status == 1 && $userId > 0) {
			$article_vote_model->article_id = $articleId;
			$article_vote_model->user_id = $userId;
			$article_model->votes = $request->vote;
			$article_vote_model->save();
			$article_model->save();
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'ArticleView', array($request->getKeyByNumber(0))));
	}
	
	protected function BaseSiteData(&$data) {
		$data['tab_article_list'] = "Каталог статей";
		$data['tab_top_list'] = "Top статьи";
		$data['tab_last_list'] = "Последние статьи";
		$data['tab_my_articles'] = "Мои статьи";
	}
	
}

?>
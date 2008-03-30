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
		$this->BaseSiteData();
		$data['tab_list'] = TabController::getMainArticleTabs(true);
		$tree_model = new ArticleTreeModel();
		$article_model = new ArticleModel();
		$data['cat_list'] = $tree_model->loadByParentId((int)$request->getKeyByNumber(0));
		$data['article_list'] = $article_model->loadByParentId((int)$request->getKeyByNumber(0));
		$controller_model = new ControllerModel();
		$action_model = new ActionModel();
		$controller = $controller_model->loadByKey('AdminArticle');
		$action = $action_model->loadByKey($controller['id'], 'ManagedSection');
		$data['admin_access'] = Project::getSecurityManager()->getAuth()->checkAccess($controller['id'], $action['id']);
		$this->_view->ArticleList($data);
		$this->_view->parse();
	}
	
	public function UserArticleListAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, true);
		echo Project::getUser()->getDbUser()->id;
		$this->_articleList($data, Project::getUser()->getDbUser()->id, null, null, 10, 'UserArticleList');
		$this->_view->UserArticleList($data);
		$this->_view->parse();
	}
	
	public function LastListAction() {
		$data = array();
		$this->BaseSiteData($data);
		$data['tab_list'] = TabController::getMainArticleTabs(false, true);
		$this->_articleList($data, null, 'a.creation_date', 'DESC', 10, 'LastList');
		$this->_view->LastList($data);
		$this->_view->parse();
	}
	
	public function TopListAction() {
		$data = array();
		$this->BaseSiteData($data);
		$data['tab_list'] = TabController::getMainArticleTabs(false, false, true);
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
			$data = array();
			$this->BaseSiteData();
			$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, false, false, true);
			$article_tree_model = new ArticleTreeModel();
			$data['cat_list'] = $article_tree_model->loadByParentId(0);
			$this->_view->AddArticle($data);
			$this->_view->parse();
		} else {
			$article_model = new ArticleModel();
			$article_page_model = new ArticlePageModel();
			$article_model->articles_tree_id = (int)$request->category;
			$article_model->user_id = Project::getUser()->getDbUser()->id;;
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
	
	public function EditArticleAction() {
		$request = Project::getRequest();
		$id = (int)$request->getKeyByNumber(0);
		if(!$request->submit) {
			$data = array();
			$this->BaseSiteData();
			$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, false, false, true, null, $article_model->title);
			$article_model = new ArticleModel();
			$article_vote_model = new ArticleVoteModel();
			$article_page_model = new ArticlePageModel();
			$article_tree_model = new ArticleTreeModel();
			if(count($article_vote_model->loadByArticleId($id)) > 0) { //TODO: it's todo
				$data['message'] = "Вы не можете редактировать эту статью, голосование по ней уже началось";
			} else {
				$article = $article_model->load($id);
				if($article['user_id'] == Project::getUser()->getDbUser()->id) {
					$data['article'] = $article;
					$data['pages'] = $article_page_model->loadByArticleId($id);
				}
			}
			$this->_view->AddArticle($data);
			$this->_view->parse();
		}
	}
	
	public function ArticleViewAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$id = (int)$request->getKeyByNumber(0);
		$pageId = (int)$request->getKeyByNumber(1);
		if($id > 0) {
			$article_model = new ArticleModel();
			$article_page_model = new ArticlePageModel();
			$article_tree_model = new ArticleTreeModel();
			$article_vote_model = new ArticleVoteModel();
			$article_pager = new ArticlePagerView();
			$votes = $article_vote_model->loadByArticleUser($id, Project::getUser()->getDbUser()->id);
			$pages = $article_page_model->loadByArticleId($id);
			$data['article'] = $article_model->load($id);
			$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, false, true, false, $article_model->title);
			$data['category'] = $article_tree_model->load($article_model->articles_tree_id);
			$data['page_content'] = $pages[$pageId];
			$data['pager_view'] = $article_pager->ShowPager(count($pages), $pageId, 'Article', 'ArticleView', array($id));
			$data['vote_status'] = !count($votes) && $article_model->rate_status;
			$data+=$article_vote_model->rateByArticleId($id);
			$article_model->views++;
			$article_model->save();
			if($article_model->allowcomments > 0) {
				$controller = new BaseCommentController();
				$data['comment_list'] = $controller -> CommentList(
																	'ArticleCommentModel', 
																	$id,  
																	$request -> getKeyByNumber(2), 	//TODO: page
																	20,  							//TODO: page
																	'Article', 'ArticleView', array($id), 
																	'Article', 'DeleteComment'
																	);
				$data['add_comment_url'] = $request -> createUrl('Article', 'AddComment');
				$data['add_comment_element_id'] = $id;
				$data['add_comment_id'] = 0;
			}
			$this->_view->ViewArticle($data);
			$this->_view->parse();
		}
	}
	
	public function AddCommentAction() {
		$request = Project::getRequest();
		$article_model = new ArticleModel();
		$article_model->load($request->element_id);
		$comment_model= new ArticleCommentModel();
		if($article_model->id > 0) {
			$comment_model->addComment(Project::getUser()->getDbUser()->id, 0, 0, $request->element_id, $request->comment, 0, 0);
			$article_model->comments++;
			$article_model->save();
			
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'ArticleView', array($article_model->id)));
	}
	
	public function DeleteCommentAction() {
		$request = Project::getRequest();
		$request_user_id = (int)Project::getUser()->getShowedUser()->id;
		$user_id = (int)Project::getUser()->getDbUser()->id;
		$article_id = $request->getKeyByNumber(0);
		$comment_id = $request->getKeyByNumber(1);
		$comment_model = new ArticleCommentModel($comment_id);
		$article_model = new ArticleModel();
		$article_model->load($article_id);
		if (($comment_model->id > 0) && ($article_model->id > 0) && ($comment_model->article_id == $article_model->id)){
			if (($comment_model->user_id == $user_id) || ($article_model->user_id == $user_id)){
				$comment_model->delete($comment_model->user_id, $comment_id);
				$article_model->comments--;
				$article_model->save();
			}
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'ArticleView', array($article_model->id)));
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
			$article_vote_model->vote = $request->vote;
			$article_model->votes++;
			$article_vote_model->save();
			$article_model->save();
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'ArticleView', array($request->getKeyByNumber(0))));
	}
	
	public function DeleteArticleAction() {
		$request = Project::getRequest();
		$article_model = new ArticleModel();
		$article_vote_model = new ArticleVoteModel();
		$userId = Project::getUser()->getDbUser()->id;
		$articleId = $request->getKeyByNumber(0);
		$article_model->load($articleId);
		if($article_model->user_id == $userId && count($article_vote_model->loadByArticleId($articleId)) <=0 ) {
			$article_model->delete($articleId);
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'UserArticleList'));
	}
}

?>
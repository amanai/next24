<?php

class ArticleController extends SiteController {
	private $_countPages = 0;
	
	public function __construct() {
		if ($view_class === null) {
			$view_class = "ArticleView";
		}
		parent::__construct($view_class);
	}
	
	// каталог статей
	public function ListAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$data['tab_list'] = TabController::getMainArticleTabs(true);
		$status = array(ARTICLE_COMPETITION_STATUS::COMPLETE, ARTICLE_COMPETITION_STATUS::SHOW_IN_CATALOG);
		$this->_listArticle($data, $status);
		$this->_view->ArticleList($data);
		$this->_view->parse();
	}
	
/*	public function UserArticleListAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, true);
		//echo Project::getUser()->getDbUser()->id;
		$this->_articleList($data, Project::getUser()->getDbUser()->id, null, null, 10, 'UserArticleList');
		$this->_view->UserArticleList($data);
		$this->_view->parse();
	}*/
	
/*	public function LastListAction() {
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
*/	
/*	private function _articleList(&$data, $userId, $sortName, $sortOrder, $per_page, $action) {
		$request = Project::getRequest();
		$article_model = new ArticleModel();
		$pager = new DbPager($request -> getKeyByNumber(0), $per_page);
		$article_model->setPager($pager);
		$data['article_list'] = $article_model->loadWhere($userId, $sortName, $sortOrder);
		$pager_view = new SitePagerView();
		$data['article_list_pager'] = $pager_view->show2($article_model->getPager(), 'Article', $action);
	}*/
	
	private function _listArticle(&$data, array $status) {
		$request = Project::getRequest();
		$tree_model = new ArticleTreeModel();
		$article_model = new ArticleModel();		
		$n = Node::by_key('', 'articles_tree');
		$tree = $n->getBranch();
		foreach ($tree as $node) {
			if($node['id'] == (int)$request->getKeyByNumber(0)) $data['select_node'] = $node;
			if($node['level'] == 1) {
				$data[root][$node['key']] = $node;
			} else {
				$data[child][substr($node['key'], 0, -4)][$node['key']] = $node;
			}
		}
		$data['article_list'] = $article_model->loadByParentId((int)$request->getKeyByNumber(0), $status);
		foreach ($data['article_list'] as &$article) {
			$article += $article_model->getFullPathById($article['articles_tree_id']);
		}
	}
	
/*	public function AddArticleAction() {
		$request = Project::getRequest();
		if(!$request->submit) {
			$data = array();
			$data['action'] = "AddArticle";
			$this->BaseSiteData();
			$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, false, false, true);
			$article_tree_model = new ArticleTreeModel();
			$data['cat_list'] = $article_tree_model->loadByParentId(0);
			$this->_view->AddArticle($data);
			$this->_view->parse();
		} else {
			$parent_id = (int)$request->category;
			if($request->cat_title != null) {
				$node = Node::by_id($request->category, 'articles_tree');
				$key = $node->getNewChildKey();
				if($key->level <= 5) {
					$article_tree_model = new ArticleTreeModel();
					$article_tree_model->user_id = Project::getUser()->getDbUser()->id;
					$article_tree_model->name = $request->cat_title;
					$article_tree_model->key = $key;
					$article_tree_model->level = $key->level;
					$article_tree_model->active = 0;
					$parent_id = $article_tree_model->save();
				}				
			}
			$article_model = new ArticleModel();
			$article_page_model = new ArticlePageModel();
			$article_model->articles_tree_id = $parent_id;
			$article_model->user_id = Project::getUser()->getDbUser()->id;
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
			$data['action'] = "EditArticle";
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
					$key = Node::by_id($article_model->articles_tree_id, 'articles_tree')->key;
					while($key != "") {
						$sect[] = $key;
						$key = $key->getParent();
					}
					$sect = array_reverse($sect);
					$n = Node::by_key('', 'articles_tree');
					$branches = $n->getBranch();
					$fill_sections = array();
					foreach ($branches as $section) {
						$data['fill_sections'][$section['level']][] = $section;
					}
					$data['sect'] = $sect;
				}
			}
			$this->_view->AddArticle($data);
			$this->_view->parse();
		}
	}*/
	
	// отображение самой статьи
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
			
			$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, false, true, $article_model->title);
			$data['category'] = $article_tree_model->load($article_model->articles_tree_id);
			$data['page_content'] = $pages[$pageId];
			$data['pager_view'] = $article_pager->ShowPager(count($pages), $pageId, 'Article', 'ArticleView', array($id));
			$data['vote_status'] = count($votes);
			$data = array_merge($data, $article_vote_model->rateByArticleId($id));
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
	
	// добавление комментария
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
	
	// удаление комментария
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
	
/*	public function AjaxChangeCatAction() {
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
	}*/
	
	// голосование за тему
	public function SubjectVoteAction() {
		$request = Project::getRequest();
		$articleId = (int)$request->getKeyByNumber(0);
		$userId = Project::getUser()->getDbUser()->id;
		$article_model = new ArticleModel();
		$article_model->load($articleId);
		$subject_vote_model = new SubjectVoteModel();
		if(	count($subject_vote_model->loadUserId($userId)) <= 0 &&
			$article_model->rate_status == ARTICLE_COMPETITION_STATUS::IN_RATE &&
			$userId > 0 &&
			$userId != $article_model->user_id) {
				$subject_vote_model->clear();
				$subject_vote_model->user_id = $userId;
				$article_model->votes++;
				$subject_vote_model->save();
				$article_model->save();
		}
		
		Project::getResponse()->redirect($request->createUrl('Article', 'CompetitionCatalog'));
	}
	
	// голосование за статью
	public function VoteAction() {
		$request = Project::getRequest();
		$articleId = (int)$request->getKeyByNumber(0);
		$userId = Project::getUser()->getDbUser()->id;
		$article_vote_model = new ArticleVoteModel();
		if(count($article_vote_model->loadByArticleUser($articleId, $userId)) <= 0 && $userId > 0) {
			$article_vote_model->article_id = $articleId;
			$article_vote_model->user_id = $userId;
			$article_vote_model->vote = $request->vote;
			$article_vote_model->save();
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'ArticleView', array($request->getKeyByNumber(0))));
	}
	
	/*
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
	}*/
	
	// конкурс тем
	public function CompetitionCatalogAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$data['tab_list'] = TabController::getMainArticleTabs(false, false, true);
		if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_START){
			$status = array(ARTICLE_COMPETITION_STATUS::NEW_ARTICLE);
			$data['competition_control'] = true;
		} elseif (ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_VOTE) {
			$status = array(ARTICLE_COMPETITION_STATUS::IN_RATE);
			$data['competition_control'] = false;
			$article_vote_model = new ArticleVoteModel();
			if(count($article_vote_model->loadByArticleUser(0, Project::getUser()->getDbUser()->id)) == 0) $data['can_vote'] = true;
		} else {
			Project::getResponse()->redirect($request->createUrl('Article', 'List'));
		}
		$this->_listArticle($data, $status);
		$this->_view->CompetitionArticleList($data);
		$this->_view->parse();
	}
	
	// последние победители
	public function LastWinnersListAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$data['tab_list'] = TabController::getMainArticleTabs(false,true);
		$article_model = new ArticleModel();
		if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_FINAL) {
			$status = array(ARTICLE_COMPETITION_STATUS::COMPLETE, ARTICLE_COMPETITION_STATUS::EDITED);
		} else {
			$status = array(ARTICLE_COMPETITION_STATUS::WINNER);
		}
		$data['article_list'] = $article_model->loadByParentId(0, $status);
		foreach ($data['article_list'] as &$article) {
			$article += $article_model->getFullPathById($article['articles_tree_id']);
		}
		$this->_view->LastWinnersList($data);
		$this->_view->parse();
	}
	
	// диалог добавления темы пользователем
	public function AddSubjectAction() {
		//$request = Project::getRequest();
		$data = array();
		$this->BaseSiteData();
		$article_model = new ArticleModel();
		$data['tab_list'] = TabController::getMainArticleTabs(false, false, false, true);
		if(count($article_model->loadByParentId(0, array(ARTICLE_COMPETITION_STATUS::NEW_ARTICLE), Project::getUser()->getDbUser()->id)) >= 5) {
			$data['message'] = "Нельзя добавить больше 5 тем за конкурс";
			$data['active'] = false;
		} else {
			$data['active'] = true;
			$n = Node::by_key('', 'articles_tree');
			$data['tree'] = $n->getBranch();
		}
		$this->_view->AddSubject($data);
		$this->_view->parse();
	}
	
	// сохранение темы
	public function SaveSubjectAction() {
		$request = Project::getRequest();
		$article_model = new ArticleModel();
		if(count($article_model->loadByParentId(0, array(ARTICLE_COMPETITION_STATUS::NEW_ARTICLE), Project::getUser()->getDbUser()->id)) < 5) {
			$article_model->title = $request->title;
			$article_model->articles_tree_id = $request->parent_id;
			$article_model->user_id = Project::getUser()->getDbUser()->id;
			$article_model->rate_status = ARTICLE_COMPETITION_STATUS::NEW_ARTICLE;
			$article_model->creation_date = date("Y-m-d H:i:s");
			$article_model->save();
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'CompetitionCatalog'));
	}
	
	//запускаем kron в среду в 18.00
	public function CompetitionStage1Action() {
		if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_VOTE) {
			$article_model = new ArticleModel();
			$article_model->CompetitionStage1();
		}
	}
	
	//запускаем kron в пятницу в 18.00
	public function CompetitionStage2Action() {
		if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_FINAL) {
			$article_model = new ArticleModel();
			$article_model->CompetitionStage2();
		}
	}
	
	//запускаем kron в понедельник в 00.00
	public function CompetitionStage3Action() {
		if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_START) {
			$article_model = new ArticleModel();
			$article_model->CompetitionStage3();
		}
	}
	
}

?>
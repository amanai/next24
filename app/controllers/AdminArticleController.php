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
		Project::getResponse()->redirect($request->createUrl('Article', 'List'));
	}
	
	public function ShowTreeAction() {
		$this->BaseAdminData();
		$data = array();
		$n = Node::by_key('', 'articles_tree');
		$data['tree'] = $n->getBranch();
		$this->_view->ShowTree($data);
		$this->_view->parse();		
	}
	
	public function ManagedSectionAction() {
		$request = Project::getRequest();
		$data = array();
		if($request->sub == 0) {
			$id = (int)$request->getKeyByNumber(0);
			$article_tree_model = new ArticleTreeModel();
			if($id > 0){
				$data['cat'] = $article_tree_model->load($id);
			}
			
			$this->BaseAdminData();
			$n = Node::by_key('', 'articles_tree');
			$data['tree'] = $n->getBranch();
			$this->_view->ManagedSection($data);
			$this->_view->ajax();
		} else {
			$id = (int)$request->getKeyByNumber(0);
			$article_tree_model = new ArticleTreeModel();
			if($id > 0) {
				$article_tree_model->load($id);
			}
			$node = Node::by_key($request->parent_id, 'articles_tree');
			$key = $node->getNewChildKey();
			if($key->level <= 5) {
				$article_tree_model->user_id = Project::getUser()->getDbUser()->id;
				$article_tree_model->name = $request->section_name;
				$article_tree_model->key = $key;
				$article_tree_model->level = $key->level;
				$article_tree_model->save();
			}
			Project::getResponse()->redirect($request->createUrl('AdminArticle', 'ShowTree'));			
		}
	}
	
	public function DeleteSectionAction() {
		$request = Project::getRequest();
		$id = (int)$request->getKeyByNumber(0);
		if($id > 0) {
			$article_tree_model = new ArticleTreeModel();
			$article_tree_model->delete($id);
		}
		Project::getResponse()->redirect($request->createUrl('AdminArticle', 'ShowTree'));	
	}
	
	public function DeleteArticleAction() {
		$request = Project::getRequest();
		$id = (int)$request->getKeyByNumber(0);
		if($id > 0) {
			$article_model = new ArticleModel();
			$article_model->delete($id);
		}
		Project::getResponse()->redirect($request->createUrl('Article', 'List'));		
	}
	
	public function SetCompetitionAction() {
		$request = Project::getRequest();
		if($request->sub == 0) {
			$id = (int)$request->getKeyByNumber(0);
			$article_tree_model = new ArticleTreeModel();
			$data['node'] = $article_tree_model->load($id);
			$this->_view->SetCompetition($data);
			$this->_view->ajax();
						
		} else {
			$article_comp_model = new ArticleCompetitionModel();
			$articleTreeId = (int)$request->article_tree_id;
			$dataBegin = $request->data_begin;
			$dataEnd = $request->data_end;
			$art = $article_comp_model->loadWhere($articleTreeId, $dataBegin, $dataEnd);
			var_dump($art);
			if(count($art) <= 0) {
				$article_comp_model->id_article_tree = (int)$request->id;
				$article_comp_model->data_begin = $dataBegin;
				$article_comp_model->data_end = $dataEnd;
				$article_comp_model->reward = $request->reward;
				$article_comp_model->save();
			}
			Project::getResponse()->redirect($request->createUrl('AdminArticle', 'ShowTree'));
		}
	}
	
	public function VerifyCompetitionAction() {
		$article_competition_model = new ArticleCompetitionModel();
		$endCompetition = $article_competition_model->selectEndCompetition();
		$article_model = new ArticleModel();
		$article_vote_model = new ArticleVoteModel();
		$winnerArticleId = 0;
		if(count($endCompetition) > 0) {
			foreach ($endCompetition as $comp) {
				$articles = $article_model->loadByParentId($comp['article_tree_id']);
				$max = 0;
				foreach ($articles as $article) {
					$r = $article_vote_model->rateByArticleId($article['id']);
					if($max < $r['rate']) {
						$max = $r['rate'];
						$winnerArticleId = $article['id'];
					}
				}
				$article_model->load($winnerArticleId);
				$article_model->rate_status = ARTICLE_RATE_STATUS::WINNER;
				$article_model->save();
				$article_competition_model->delete($comp['id']);
			}
		}
	}
	
	public function SetActiveAction() {
		$request = Project::getRequest();
		$id = (int)$request->getKeyByNumber(0);
		if($id > 0) {
			$article_tree_model = new ArticleTreeModel();
			$article_tree_model->load($id);
			$article_tree_model->active = 1;
			$article_tree_model->save();
		}
		Project::getResponse()->redirect($request->createUrl('AdminArticle', 'ShowTree'));
	}
	
	public function EditArticleAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseAdminData();
		$data['controller'] = null;
		$data['save_action'] = "SaveArticle";
		$article_model = new ArticleModel();
		$data['edit_data'] = $article_model->load($request->getKeyByNumber(0));
		$article_tree_model = new ArticleTreeModel();
		$n = Node::by_key('', 'articles_tree');
		$data['cat_list'] = $n->getBranch();
		$this->_view->EditArticle($data);
		$this->_view->ajax();
	}
		
	public function SaveArticleAction() {
		//die('eg');
		$request = Project::getRequest();
		$id = (int)$request->id;
		$article_model = new ArticleModel();
		$article_page_model = new ArticlePageModel();
		$article_model->load($id);
		$article_model->user_id = Project::getUser()->getDbUser()->id;
		$article_model->title = $request->article_title;
		$article_model->allowcomments = (bool)$request->allow_comment;
		$article_model->rate_status = (bool)$request->allow_rate;
		$article_model->creation_date = date("Y-m-d H:i:s");
		$id = $article_model->save();
		
		for($i = 0; $i < count($request->title_page); $i++) {
			$article_page_model = new ArticlePageModel();
			$article_page_model->article_id = $id;
			$article_page_model->title = $request->title_page[$i];
			$article_page_model->p_text = $request->content_page[$i];
			$article_page_model->save();
		}
		$data = array();
		$data['page'] = $request;
		$this->makeArticleList($data);
		$this -> _view -> AjaxArticleList($data);
		$this->_view->ajax();
	}
	
	public function ListAction() {
		$request = Project::getRequest();
		$data = array();
		$this->BaseAdminData();
		$this->makeArticleList($data);
		$this->_view->ArticleList($data);
		$this->_view->parse();
	}
	
	public function makeArticleList(&$data) {
		$request = Project::getRequest();
		$article_model = new ArticleModel();
		$pager = new DbPager($request->pn, 10); //TODO:
		$article_model -> setPager($pager);
		$data['article_list'] = $article_model->loadPage();
		$data['list_pager'] = $article_model -> getPager();
		$data['list_controller'] = null;
		$data['list_action'] = 'List';
		$data['edit_controller'] = null;
		$data['edit_action'] = "EditArticle";
		$data['add_link'] = AjaxRequest::getJsonParam($data['edit_controller'], $data['edit_action']);
	}
	
	
}

?>
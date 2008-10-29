<?php
	class NewsController extends SiteController{
	    var $_aNewsTreeBreadCrumb = array();
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "NewsView";
			}
			parent::__construct($view_class);
		}		
		
		public function NewsAction(){
		    $newsModel = new NewsModel();
		    $request = Project::getRequest();
		    
		    $news_tree_id = $request->news_tree_id;
		    if ($news_tree_id){
		        $this -> getNewsTreeBreadCrumb($news_tree_id);
		        $this->_aNewsTreeBreadCrumb = array_reverse($this->_aNewsTreeBreadCrumb);
		    }
		    
			$this-> _view -> assign('tab_list', TabController::getNewsTabs(true)); // Show tabs
			$this-> _view -> assign('aNewsTreeBreadCrumb', $this->_aNewsTreeBreadCrumb); // Show tabs
			
			
			$aListNews = $newsModel->getAllNews();
			$this-> _view -> assign('news_list', $aListNews); // all News tree
			
			$this -> _view -> NewsPage();
			$this -> _view -> parse();
		}
		
		function getNewsTreeBreadCrumb($news_tree_id){
		    $newsModel = new NewsModel();
		    if ($news_tree_id){
                $newsTree = $newsModel -> getNewsTree($news_tree_id);
                if ($newsTree){
                    $this->_aNewsTreeBreadCrumb[] = $newsTree;
                    $this->getNewsTreeBreadCrumb($newsTree['parent_id']);
                }
            }
		}
		
		public function AddFeedAction(){
		    $newsModel = new NewsModel();
		    $request = Project::getRequest();
		    
		    $this-> _view -> assign('tab_list', TabController::getNewsTabs(false, true)); // Show tabs
			
			$aListNews = $newsModel->getAllNews();
			$this-> _view -> assign('news_list', $aListNews); // all News tree
			
			$this -> _view -> AddFeedPage();
			$this -> _view -> parse();
		    
		}
		
	}
?>
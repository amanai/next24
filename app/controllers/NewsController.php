<?php
	class NewsController extends SiteController{
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "NewsView";
			}
			parent::__construct($view_class);
		}		
		
		public function NewsAction(){
			$this-> _view -> assign('tab_list', TabController::getNewsTabs(true)); // Show tabs
			
			$newsModel = new NewsModel();
			$aListNews = $newsModel->getAllNews();
			$this-> _view -> assign('news_list', $aListNews); // all News tree
			
			$this -> _view -> ContentPage();
			$this -> _view -> parse();
		}
		
	}
?>
<?php
	class IndexController extends SiteController{
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "HomeView";
			}
			parent::__construct($view_class);
		}
		
		public function IndexAction(){		
			$this -> BaseSiteData();	
			$this -> _view -> Home(array());
			$this -> _view -> parse();
		}
		
	}
?>
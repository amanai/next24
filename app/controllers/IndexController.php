<?php
	class IndexController extends SiteController{
	    private $tabs_map = array();
		
		function __construct($view_class = null){
		    $this->tabs_map['main_tabs'][0] = array('name'=>'Новости');
			$this->tabs_map['main_tabs'][1] = array('name'=>'Статьи');
		    $this->tabs_map['main_tabs'][2] = array('name'=>'Фотоальбом');
		    $this->tabs_map['main_tabs'][3] = array('name'=>'Вопросы-ответы');
		    
			if ($view_class === null){
				$view_class = "HomeView";
			}
			parent::__construct($view_class);
		}
		
		public function IndexAction(){	
			//$this -> BaseSiteData();	
			$v_request = Project::getRequest();
    		$v_session = Project::getSession();
    		$request_keys = $v_request->getKeys();			
			$userModel = new UserModel();
			$user = Project::getUser() -> getDbUser();
			$tabs_map = $this->tabs_map;
			$needToSave = false;
			$desktops = unserialize($userModel->getDesktops());
			if(!$request_keys['d']) {
			if ($user->id){
			    $tabs_map['selected_tabs'] = unserialize($user->tabs_map);
			    if (!$tabs_map['selected_tabs']){
			        $needToSave = true;
			    }
			}
			if (!$user->id || !$tabs_map['selected_tabs']){
			    $tabs_map['selected_tabs'][0] = array('id'=>'0', 'selected'=>true);
			    $tabs_map['selected_tabs'][1] = array('id'=>'1', 'selected'=>true);
			    $tabs_map['selected_tabs'][2] = array('id'=>'2', 'selected'=>true);
			    $tabs_map['selected_tabs'][3] = array('id'=>'3', 'selected'=>true);
			}
			$this -> _view -> assign('tabs_map', $tabs_map);
			$this -> _view -> assign('user_id', $user->id);
			if ($needToSave) $userModel->saveUserTabsMap($user->id, $tabs_map['selected_tabs']);
			}
			$this -> _view -> assign('desktops', $desktops);
			if(!isset($request_keys['d'])) {
				$this -> _view -> Home();
			}
			else {
				$this -> _view -> HomeBlank();	
			}
			$this -> _view -> parse();
		}
		
		// Ajax, меняет состав табс-меню для пользователя
		public function ChangeIndexTabsAction(){
    	    $userModel = new UserModel();
    	    $user = Project::getUser() -> getDbUser();
    	    $request = Project::getRequest();
    	    $tabs_map = $this->tabs_map;
			$checkBoxes = $request->checkBoxes;
			
			if ($user){
			    $old_selected_tabs = unserialize($user->tabs_map);
			    foreach ($checkBoxes as $tabActiveId){
			        $tabs_map['selected_tabs'][] = array('id'=>$tabActiveId, 'selected'=>true);
			    }
			    foreach ($old_selected_tabs as $old_tab){
			        if (!in_array($old_tab['id'], $checkBoxes)){
                        $tabs_map['selected_tabs'][] = array('id'=>$old_tab['id'], 'selected'=>false);
			        }
			    }
			    if (!$checkBoxes) $tabs_map['selected_tabs'][0]['selected'] = true;
			    $userModel->saveUserTabsMap($user->id, $tabs_map['selected_tabs']);
			}else{
			    return;
			}
			$message['tabs_map'] = $tabs_map;
			$message['user_id'] = $user->id;
    	    
    	    
    	    
    	    $this -> _view -> returnTabs($message);
            $this -> _view -> ajax();
		}
		public function addDesktopAction() {
			$v_request = Project::getRequest();
    		$v_session = Project::getSession();
    		$request_keys = $v_request->getKeys();			
			$userModel = new UserModel();
			$desktops = unserialize($userModel->getDesktops());
			//$desktops[] = $v_request['tab_name'];
			$desktops[] = 'Новая вкладка';
			$desktops = serialize($desktops);
			$userModel->addDesktop($desktops);
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Index", "Index"));
		}	

		public function NewsAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    if (!$user->id) $user->id = 0;
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    $isPartner = ($user->user_type_id == 4)?true:false;
	    $isTabsSnow = false; // if !$isTabsSnow you can show tabs
	    
	    //  view type and filters
	    switch ($request->view){ // View type
	        case 'full': // full news list
	           $_SESSION['newsViewType'] = 'full';
	           break;
	        case 'report': // report news list
	           $_SESSION['newsViewType'] = 'report';
	           break;
	           
	        case 'news_all': // no filter, all news
	           $_SESSION['newsViewFilter'] = 'news_all';
	           break;
	        case 'news_subscribe': // filter, only subscribe news
	           $_SESSION['newsViewFilter'] = 'news_subscribe';
	           break;
	        case 'news_stared': // filter, only news star
	           $_SESSION['newsViewFilter'] = 'news_stared';
	           break;
	           
	    }
	    $_SESSION['newsViewType'] = ($_SESSION['newsViewType'])?$_SESSION['newsViewType']:'report';
	    $_SESSION['newsViewFilter'] = ($_SESSION['newsViewFilter'])?$_SESSION['newsViewFilter']:'news_subscribe';
	    switch ($_SESSION['newsViewType']){ // View type
	        case 'full': // full news list
	           $viewCheckedClass = array('viewCheckedClass', '');
	           break;
	        case 'report': // report news list
	           $viewCheckedClass = array('', 'viewCheckedClass');
	           break;
	    }
	    switch ($_SESSION['newsViewFilter']){ // View filter
	        case 'news_all': // no filter, all news
	           $newsViewFilter = array('viewCheckedClass', '', '');
	           $isOnlyFavoriteNews = false;
	           $isOnlySubscribeNewsTree = false;
	           break;
	        case 'news_subscribe': // filter, only subscribe news
	           $newsViewFilter = array('', 'viewCheckedClass', '');
	           $isOnlyFavoriteNews = false;
	           $isOnlySubscribeNewsTree = true;
	           break;
	        case 'news_stared': // filter, only news star
	           $newsViewFilter = array('', '', 'viewCheckedClass');
	           $isOnlyFavoriteNews = true;
	           $isOnlySubscribeNewsTree = false;
	           break;
	    }
	    
	    if (!$user->id){ // if NOT REGISTRED USER
	        $this-> _view -> assign('newsViewFilter', 'news_all');
	        $isOnlyFavoriteNews = false;
	        $isOnlySubscribeNewsTree = false;
	    }else {
	        $this-> _view -> assign('newsViewFilter', $_SESSION['newsViewFilter']);
	    }
	    
	    if ($request -> shownow == 'allnews'){ // if click on "(все новости [15])"
	        $this-> _view -> assign('newsViewType', 'full');
	        $this-> _view -> assign('nShowRows', 0); // Show all news records
	        if (!$isTabsSnow){
	            $newsViewModel = new NewsView();
	            if ($request->filterNewsTreeFeeds){
	                $breadCrumb = $newsViewModel->ShowNewsTreeBreadCrumbByNewsTreeFeedsId($request->filterNewsTreeFeeds, false);
	            }else{
	                $breadCrumb = $newsViewModel->ShowNewsTreeBreadCrumbByNewsTreeId($request->filterNewsTree, false);
	            }
    	        $this-> _view -> assign('tab_list', TabController::getNewsTabs($user->id, $isAdmin, false, false, false, false, false, array(), true, $breadCrumb)); // Show tabs
    	        $isTabsSnow = true;
	        }
	    }else {
	        $this-> _view -> assign('newsViewType', $_SESSION['newsViewType']);
	        $this-> _view -> assign('nShowRows', 4); // Show all news records
	    }
	    $this-> _view -> assign('shownow', $request->shownow);
	    
	    $this-> _view -> assign('viewCheckedClass', $viewCheckedClass);
	    $this-> _view -> assign('viewFilterCheckedClass', $newsViewFilter);
	    // END view type and filters
	    
	    $this-> _view -> assign('user_id', $user->id);
	    $this-> _view -> assign('isAdmin', $isAdmin);
	    $this-> _view -> assign('isPartner', $isPartner);
	    
	    $news_tree_id = $request->news_tree_id;
		
		if ($request->news_id){
		    if ($isAdmin) {
		        $isNewsTreeActive = false;
		        $isNewsBannersActive = false;
		    }else{
		        $isNewsTreeActive = true;
		        $isNewsBannersActive = true;
		    }		    
		    $news = $newsModel -> getNewsById($request->news_id, $user->id, $isNewsTreeActive, $isNewsBannersActive);
		    if (!$news) Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'News'));
		    $this-> _view -> assign('news', $news); 
		    $tabsNews = array("title"=>$newsModel -> getNWordsFromText($news['news_title'], 7), "id"=>$request->news_id);
		    if (!$isTabsSnow){
		        $this-> _view -> assign('tab_list', TabController::getNewsTabs($user->id, $isAdmin, false, false, false, false, true, $tabsNews)); // Show tabs
		        $isTabsSnow = true;
		    }
		    $this-> _view -> assign('isShowOneNews', true); 
		    $newsModel -> setNews_Views($request->news_id, 1);
		}else{
		    if (!$isTabsSnow){
		        $this-> _view -> assign('tab_list', TabController::getNewsTabs($user->id, $isAdmin, true)); // Show tabs
		        $isTabsSnow = true;
		    }
		    $this-> _view -> assign('isShowOneNews', false); 
		}
		
		$aNewsTreeList = $newsModel->getAllNews();
		$this-> _view -> assign('news_tree_list', $aNewsTreeList); // all News tree
		$this-> _view -> assign('filterNewsTree', $request->filterNewsTree); // filter by News tree ID
		$this-> _view -> assign('filterNewsTreeFeeds', $request->filterNewsTreeFeeds); // filter by News tree feeds ID
		
		// PAGER
		$news_per_page = $this -> getParam("NEWS_PER_PAGE");
		$pager_view = new SitePagerView();
		if ($request->filterNewsTreeFeeds){ // pager for All news , filterNewsTreeFeeds
		    $news_count = $newsModel->getNewsCountByNewsTreeFeedsId($request->filterNewsTreeFeeds, $user->id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
		    $pages_number = $pager_view->getPagesNumber($news_count, $news_per_page);
		    $current_page_number=$request->getKeyByNumber(2);
		    $news_pager = $pager_view->show3('News', 'News', array("shownow"=>"allnews", "filterNewsTreeFeeds"=>$request->filterNewsTreeFeeds), $pages_number, $current_page_number);
		    $this-> _view -> assign('news_tree_pager', $news_pager); 
		    $this-> _view -> assign('page_settings', array("record_per_page"=>$news_per_page, "current_page_number"=>$current_page_number+1)); 
		}elseif ($request->filterNewsTree){ // pager for All news , filterNewsTree
		    $news_count = $newsModel->getNewsCountByNewsTreeId($request->filterNewsTree, $user->id, $isOnlySubscribeNewsTree, $isOnlyFavoriteNews);
		    $pages_number = $pager_view->getPagesNumber($news_count, $news_per_page);
		    $current_page_number=$request->getKeyByNumber(2);
		    $news_pager = $pager_view->show3('News', 'News', array("shownow"=>"allnews", "filterNewsTree"=>$request->filterNewsTree), $pages_number, $current_page_number);
		    $this-> _view -> assign('news_tree_pager', $news_pager); 
		    $this-> _view -> assign('page_settings', array("record_per_page"=>$news_per_page, "current_page_number"=>$current_page_number+1)); 
		}
		// END PAGER
		
		
		$aNewsSubscribe = $newsModel -> getNewsSubscribeByUserId($user->id);
		$this-> _view -> assign('aNewsSubscribe', $aNewsSubscribe); // all NewsSubscribe
		
		$this -> _view -> NewsPage();
		$this -> _view -> parse();
	}	
	
	
	public function ModerateNewsTreeAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    $this -> _view -> clearFlashMessages();
	    $this -> _view -> assign('tab_list', TabController::getOwnTabs(false,false,false,false,false,false,false,true,false,false));
	//    $this-> _view -> assign('tab_list', TabController::getNewsTabs($user->id, $isAdmin, false, false, false, false, false, array(), false, false, false, true)); // Show tabs
	    
	    if ($request->deleted == "no") $this -> _view -> addFlashMessage(FM::ERROR  , "Поле нельзя удалить, возможно у него есть связи с другими таблицами");
	    
	    $this-> _view -> assign('user_id', $user->id); 
	    $aListNews = $newsModel->getAllNews();
		$this-> _view -> assign('news_list', $aListNews); // all News tree
		
		$this -> _view -> ModerateNewsTreePage();
		$this -> _view -> parse();
	}
	
	public function ModerateFeedsAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    $this -> _view -> clearFlashMessages();
	    $this -> _view -> assign('tab_list', TabController::getOwnTabs(false,false,false,false,false,false,false,true,false,false));
	   // $this-> _view -> assign('tab_list', TabController::getNewsTabs($user->id, $isAdmin, false, false, false, false, false, array(), false, false, true)); // Show tabs
	    
	    $this-> _view -> assign('isAdmin', $isAdmin); 
	    $sqlWhere = " WHERE 1=1 ";
	    if ($request->banner_state) {$sqlWhere .= " AND news_banners.state=0 "; $this-> _view -> assign('banner_state', $request->banner_state); }
	    if ($request->feeds_state) {$sqlWhere .= " AND feeds.state=0 "; $this-> _view -> assign('feeds_state', $request->feeds_state); }
	    if ($request->feed_is_partner) {$sqlWhere .= " AND feeds.is_partner=".($request->feed_is_partner-1);  }
		$this-> _view -> assign('feed_is_partner', $request->feed_is_partner);
		if ($request->user_login) {$sqlWhere .= " AND users.login like '%".$request->user_login."%'"; $this-> _view -> assign('user_login', $request->user_login); }
		
		$aListNewsTreeFeeds = $newsModel->getAllNewsTreeFeeds($sqlWhere, false, false, false);
		$this-> _view -> assign('aListNewsTreeFeeds', $aListNewsTreeFeeds); //  News tree feeds for current user
	    $this-> _view -> assign('user_id', $user->id); 
		
		$this -> _view -> ModerateFeedsPage();
		$this -> _view -> parse();
	}
	
	public function AddNewsTreeAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    $this -> _view -> clearFlashMessages();
	    
	    if ($request->frmAction == 'add'){
	        $noErrors = true;
	        if (!$request->news_tree_id){
	            $this -> _view -> addFlashMessage(FM::ERROR, "Выберите в какой категории будет находиться новый раздел");
	            $noErrors = false;
	        }
	        if (!trim($request->news_tree_name)){
	            $this -> _view -> addFlashMessage(FM::ERROR, "Введите название категории");
	            $noErrors = false;
	        }
	        if (!$user->id){
	            $this -> _view -> addFlashMessage(FM::ERROR, "Необходимо зарегистрироваться для добавления новых разделов");
	            $noErrors = false;
	        }
	        
	        if ($noErrors){
    	        $category_tag = trim($request->category_tag);
    	        $type = ($category_tag)?1:0; // 0 - 1 Rss => 1 NewsTreeCastegory; 1 - 1 Rss => N NewsTreeCategory
    	        $creation_date = date("Y-m-d H:i:s");
    	        if ($user->user_type_id == 1 || $user->user_type_id == 4){ // partner or Admin
        	            $is_partner=1;
        	            $state = 0;
        	            $text_parse_type = 0;
        	        } else { // registred user
        	            $is_partner=0;
        	            $state = 1;
        	            $text_parse_type = 2;
        	        }
    	        
    	        $news_tree_id = $newsModel -> addNewsTree($request->news_tree_id, $user->id, $request->news_tree_name, 0);
    	        //Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'ChangeNewsTree')."/tree_id:".$news_tree_id);
    	        Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'AddNewsTree')."/isadded:1");
	        }
	    }
	    if ($request->isadded == 1){
	        $this-> _view -> assign('isAdded', true); 
	        $this -> _view -> addFlashMessage(FM::INFO , "Раздел отправлен на модерацию");
	    }else{
	        $this-> _view -> assign('isAdded', false); 
	        
	        $aListNews = $newsModel->getAllNews();
		    $this-> _view -> assign('news_list', $aListNews); // all News tree
	    }
	    
	    $this-> _view -> assign('tab_list', TabController::getNewsTabs($user->id, $isAdmin, false, false, false, true)); // Show tabs
	    $this-> _view -> assign('frmAction', 'add'); 
	    $this-> _view -> assign('submitValue', 'Добавить'); 
	    $this-> _view -> assign('news_tree_name', ''); 
		
		$this -> _view -> AddNewsTreePage();
				
		$this -> _view -> parse();
	    
	}		
	}
?>
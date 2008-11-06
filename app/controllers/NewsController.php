<?php
define('SEC_TO_DELETE_NEWS_FROM_FEEDS', 259200); // 259200 = 3 days

class NewsController extends SiteController{
	
	function __construct($view_class = null){
		if ($view_class === null){
			$view_class = "NewsView";
		}
		parent::__construct($view_class);
	}		
	
	public function NewsAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    $isPartner = ($user->user_type_id == 4)?true:false;
	    
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
	           break;
	        case 'news_subscribe': // filter, only subscribe news
	           $newsViewFilter = array('', 'viewCheckedClass', '');;
	           break;
	        case 'news_stared': // filter, only news star
	           $newsViewFilter = array('', '', 'viewCheckedClass');;
	           break;
	    }
	    if ($request -> shownow == 'allnews'){ // if click on "(все новости [15])"
	        $this-> _view -> assign('newsViewType', 'full');
	        $this-> _view -> assign('nShowRows', 0); // Show all news records
	    }else {
	        $this-> _view -> assign('newsViewType', $_SESSION['newsViewType']);
	        $this-> _view -> assign('nShowRows', 4); // Show all news records
	    }
	    $this-> _view -> assign('shownow', $request->shownow);
	    
	    $this-> _view -> assign('newsViewFilter', $_SESSION['newsViewFilter']);
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
		    $tabsNews = array("title"=>$newsModel -> getNWordsFromText($news['news_title'], 6)."...", "id"=>$request->news_id);
		    $this-> _view -> assign('tab_list', TabController::getNewsTabs(false, false, false, true, $tabsNews)); // Show tabs
		    $this-> _view -> assign('isShowOneNews', true); 
		}else{
		    $this-> _view -> assign('tab_list', TabController::getNewsTabs(true)); // Show tabs
		    $this-> _view -> assign('isShowOneNews', false); 
		}
				
		$aListNews = $newsModel->getAllNews();
		$this-> _view -> assign('news_list', $aListNews); // all News tree
		$this-> _view -> assign('filterNewsTree', $request->filterNewsTree); // filter by News tree ID
		$this-> _view -> assign('filterNewsTreeFeeds', $request->filterNewsTreeFeeds); // filter by News tree feeds ID
		
		$aNewsSubscribe = $newsModel -> getNewsSubscribeByUserId($user->id);
		$this-> _view -> assign('aNewsSubscribe', $aNewsSubscribe); // all NewsSubscribe
		
		$this -> _view -> NewsPage();
		$this -> _view -> parse();
	}	
	
	
	public function AddFeedAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    
	    if ($request->frmAction == 'add'){
	        $user = Project::getUser()->getDbUser();
	        $category_tag = trim($request->category_tag);
	        $type = ($category_tag)?1:0; // 0 - 1 Rss => 1 NewsTreeCastegory; 1 - 1 Rss => N NewsTreeCategory
	        $creation_date = date("Y-m-d H:i:s");
	        
	        $feed_id = $newsModel -> addFeeds($user->id, $request->feed_name, $request->feed_url, $type, 0, $creation_date);
	        $news_banner_id = $newsModel -> addNewsBanner($user->id, $request->code, 0);
	        $news_tree_feeds_id = $newsModel -> addNewsTreeFeeds($request->news_tree_id, $feed_id, $news_banner_id, $category_tag);
	        
	        Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'MyFeeds'));
	    }
	    
	    $this-> _view -> assign('tab_list', TabController::getNewsTabs(false, true)); // Show tabs
	    $this-> _view -> assign('frmAction', 'add'); 
	    $this-> _view -> assign('submitValue', 'Добавить'); 
	    $this-> _view -> assign('feed_name', ''); 
        $this-> _view -> assign('feed_url', ''); 
        $this-> _view -> assign('category_tag', ''); 
        $this-> _view -> assign('code', ''); 
		
		$aListNews = $newsModel->getAllNews();
		$this-> _view -> assign('news_list', $aListNews); // all News tree
		
		$this -> _view -> AddFeedPage();
		$this -> _view -> parse();
	    
	}
	
	public function ChangeFeedAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $news_tree_feeds_id = $request->news_tree_feeds_id;
	    $newsTreeFeed = $newsModel->getNewsTreeFeedsById($news_tree_feeds_id, false, false, false);
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    
	    if ( $news_tree_feeds_id && $newsTreeFeed && is_array($newsTreeFeed)){
	        if ($request->deleteRss){
	            
	            $newsModel -> deleteFeeds($newsTreeFeed['feed_id']);
	            $newsModel -> deleteNewsBanner($newsTreeFeed['news_banner_id']);
	            $newsModel -> deleteNewsTreeFeeds($news_tree_feeds_id);
	            $newsModel -> deleteNewsByNewsTreeFeedsId($news_tree_feeds_id);
	            Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'MyFeeds'));
	        }elseif ($request->frmAction == 'change'){
    	        
    	        $category_tag = trim($request->category_tag);
    	        $type = ($category_tag)?1:0; // 0 - 1 Rss => 1 NewsTreeCastegory; 1 - 1 Rss => N NewsTreeCategory
    	        $creation_date = date("Y-m-d H:i:s");
    	        
    	        if ($user->id == $newsTreeFeed['feeds_user_id'] || $isAdmin){
    	        // if OWNER or ADMIN
    	            if ($isAdmin) $text_parse_type = $request->text_parse_type; else $text_parse_type = -1;
        	        $newsModel -> changeFeeds($newsTreeFeed['feed_id'], $request->feed_name, $request->feed_url, $type, 0, $text_parse_type);
        	        $newsModel -> changeNewsTreeFeeds($news_tree_feeds_id, $request->news_tree_id, $newsTreeFeed['feed_id'], $newsTreeFeed['news_banner_id'], $category_tag);
        	        if ($newsTreeFeed['news_banner_id']){
        	           $newsModel -> changeNewsBanner($newsTreeFeed['news_banner_id'], $request->code, 0);
        	        }else {
        	           $news_banner_id = $newsModel -> addNewsBanner($user->id, $request->code, 0);
        	           $newsModel -> changeOneValue('news_tree_feeds', $news_tree_feeds_id, 'news_banner_id', $news_banner_id);
        	        }
    	        }
    	        Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'ChangeFeed')."/change_feed/news_tree_feeds_id:".$news_tree_feeds_id."/");
    	    }
	        $this-> _view -> assign('tab_list', TabController::getNewsTabs(false, false, true)); // Show tabs
	        $this-> _view -> assign('frmAction', 'change'); 
	        $this-> _view -> assign('submitValue', 'Изменить'); 
	        $this-> _view -> assign('feed_name', $newsTreeFeed['feeds_name']); 
	        $this-> _view -> assign('feed_url', $newsTreeFeed['url']); 
	        $this-> _view -> assign('category_tag', $newsTreeFeed['category_tag']); 
	        $this-> _view -> assign('code', $newsTreeFeed['code']); 
	        $this-> _view -> assign('news_tree_id', $newsTreeFeed['news_tree_id']); 
	        $this-> _view -> assign('text_parse_type', $newsTreeFeed['text_parse_type']); 
	        $this-> _view -> assign('news_tree_feeds_id', $news_tree_feeds_id); 
	        $this-> _view -> assign('isChange', true); 
	        $this-> _view -> assign('isAdmin', $isAdmin); 
		
    		$aListNews = $newsModel->getAllNews();
    		$this-> _view -> assign('news_list', $aListNews); // all News tree
    		
    		$this -> _view -> AddFeedPage();
    		$this -> _view -> parse();
	    }else{
	        Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'MyFeeds'));
	    }
	}
	
	public function MyFeedsAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    $isAdmin = ($user->user_type_id == 1)?true:false;
	    
	    $this-> _view -> assign('isAdmin', $isAdmin); 
	    $this-> _view -> assign('tab_list', TabController::getNewsTabs(false, false, true)); // Show tabs
		
		$aListNewsTreeFeeds = $newsModel->getNewsTreeFeedsByUserId($user->id, false, false, false);
		$this-> _view -> assign('aListNewsTreeFeeds', $aListNewsTreeFeeds); //  News tree feeds for current user
		
		$aListNews = $newsModel->getAllNews();
		$this-> _view -> assign('news_list', $aListNews); // all News tree
		
		$this -> _view -> MyFeedPage();
		$this -> _view -> parse();
	    
	}
	
	public function ChangeStateAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    
	    $message = array();
	    $table = $request->element;;
	    $message[] = $request->id;
	    $message[] = $table;
	    $oldSet = $newsModel -> getOneRecord($table, $request->id);
        if ($oldSet){
            if ($oldSet['state']){
                $newsModel -> changeOneValue($table, $request->id, 'state', 0);
                $message[] = "not moderated";
            }else{
                $newsModel -> changeOneValue($table, $request->id, 'state', 1);
                $message[] = "active";
            }
        }
	    $this -> _view -> ActivateBanner($message);
		$this -> _view -> ajax();
	}
	
	public function ChangeNewsFavoriteAction(){
	    $newsModel = new NewsModel();
	    $request = Project::getRequest();
	    $user = Project::getUser()->getDbUser();
	    
	    $message = array();
	    $message['imgUrl'] = $request->imgUrl;
	    $message['newsId'] = $request->news_id;
	    $newsModel -> setNewsFavorite($request->news_id, $user->id);
	    $newSet = $newsModel -> getNewsFavorite($request->news_id, $user->id);
        if ($newSet){
            $message['val'] = 1;
        }else{
            $message['val'] = 0;        
        }
	    $this -> _view -> ChangeNewsFavorite($message);
		$this -> _view -> ajax();
	}
	
	public function SubscribeNewsAction(){
	    $request = Project::getRequest();
	    if ($request->subscribe){
    	    $newsModel = new NewsModel();
    	    $user = Project::getUser()->getDbUser();
    	    $newsModel -> setNewsSubscribe($user->id, $request->news_tree_feeds);
	    }
	    Project::getResponse()->redirect(Project::getRequest()->createUrl('News', 'News'));
	}
	
	
	/**
	 * ADD News by cron
	 * */
	public function CronNewsAction(){
	    ini_set('max_execution_time', 0);
	    $newsModel = new NewsModel();

	    $newsModel -> deleteOldNews(date("Y-m-d H:i:s", time()-SEC_TO_DELETE_NEWS_FROM_FEEDS));	  
	    
	    $lastRSS = new lastRSS();
	    $lastRSS->cache_dir = './rss_cache';
        $lastRSS->cache_time = 3600; // one hour
        
	    $aNewsTreeFeeds = $newsModel -> getAllNewsTreeFeeds(true, true, true);
	    foreach ($aNewsTreeFeeds as $newsTreeFeeds){
	        		        
	        echo $newsTreeFeeds['url'];
	        echo "<br>";
	        $aFeeds = $lastRSS->Get($newsTreeFeeds['url']);
	        echo "<pre>";
	        //print_r($aFeeds);
	        //print_r($newsTreeFeeds);
	        //echo $newsTreeFeeds['last_parse_date']."<br>";
	        $n = 0;
	        if (is_array($aFeeds) && count($aFeeds)>0 && is_array($aFeeds['items'])){
	            foreach ($aFeeds['items'] as $item){
	                //print_r($item); echo "<hr>";
                    $pubDate = (isset($item['pubDate']))?$item['pubDate']:date("Y-m-d H:i:s");
                    $title = (isset($item['title']))?$item['title']:"";
                    $link = (isset($item['link']))?$item['link']:"";
                    $description = (isset($item['description']))?$item['description']:"";
                    $category = (isset($item['category']))?$item['category']:"";
                    $enclosure = (isset($item['enclosure']))?$item['enclosure']:"";
                    $enclosure_type = (isset($item['enclosure_type']))?$item['enclosure_type']:"";
                    
                    if (strtoupper($aFeeds['encoding']) != 'UTF-8' ){
                        $title = iconv(strtoupper($aFeeds['encoding']), 'UTF-8', $title);
                        $description = iconv(strtoupper($aFeeds['encoding']), 'UTF-8', $description);
                        $category = iconv(strtoupper($aFeeds['encoding']), 'UTF-8', $category);
                        $enclosure = iconv(strtoupper($aFeeds['encoding']), 'UTF-8', $enclosure);
                    }
		            $short_text = $newsModel -> getNWordsFromText($description, 40)."...";
		            $pub_date = date("Y-m-d H:i:s", strtotime($pubDate));
		            if (!$newsTreeFeeds['category_tag'] || strtoupper($newsTreeFeeds['category_tag']) == strtoupper($category)){
		            // if RSS-feeds have different categories => it should be same as in item
		                $pub_date_in_sec = strtotime($pub_date);
		                if (
		                      (!$newsTreeFeeds['last_parse_date'] || $newsTreeFeeds['last_parse_date'] < $pub_date) && // check parse date
		                      (time()-SEC_TO_DELETE_NEWS_FROM_FEEDS < $pub_date_in_sec) // check news publication date
		                   )
		                { // not parsed yet
		                    $n++;
		                    $newsModel -> addNews(
		                              $newsTreeFeeds['id'], $title, $link, $short_text, $description, 
		                              $category, $pub_date, $enclosure, $enclosure_type, 0, 0, 0, $newsTreeFeeds['text_parse_type']);
		                    $newsModel -> setParseDate($newsTreeFeeds['feed_id'], date("Y-m-d H:i:s"));
		                }
		            }
	            }
	        }
	        echo "Added ".$n." News";
	        echo "</pre>";

	        echo "<hr>";
	    }
	    
	}
	
	
	
}
?>
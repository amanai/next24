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
		    
		    if ($request->frmAction == 'add'){
		        $user = Project::getUser()->getDbUser();
		        $category_tag = trim($request->category_tag);
		        $type = ($category_tag)?1:0; // 0 - 1 Rss => 1 NewsTreeCastegory; 1 - 1 Rss => N NewsTreeCategory
		        $creation_date = date("Y-m-d H:i:s");
		        
		        $feed_id = $newsModel -> addFeeds($user->id, $request->feed_name, $request->feed_url, $type, 0, $creation_date);
		        $news_banner_id = $newsModel -> addNewsBanner($user->id, $request->code, 0);
		        $news_tree_feeds_id = $newsModel -> addNewsTreeFeeds($request->news_tree_id, $feed_id, $news_banner_id, $category_tag);
		        
		        header("Location: http://".$_SERVER['HTTP_HOST']."/news");
		    }
		    
		    $this-> _view -> assign('tab_list', TabController::getNewsTabs(false, true)); // Show tabs
			
			$aListNews = $newsModel->getAllNews();
			$this-> _view -> assign('news_list', $aListNews); // all News tree
			
			$this -> _view -> AddFeedPage();
			$this -> _view -> parse();
		    
		}
		
		
		public function CronNewsAction(){
		    ini_set('max_execution_time', 0);
		    $newsModel = new NewsModel();
		    $lastRSS = new lastRSS();
		    $lastRSS->cache_dir = './rss_cache';
            $lastRSS->cache_time = 3600; // one hour
            
		    $aNewsTreeFeeds = $newsModel -> getAllNewsTreeFeeds(true, true, true);
		    foreach ($aNewsTreeFeeds as $newsTreeFeeds){
		        		        
		        echo $newsTreeFeeds['url'];
		        echo "<br>";
		        $aFeeds = $lastRSS->Get($newsTreeFeeds['url']);
		        echo "<pre>";
		        print_r($newsTreeFeeds);
		        print_r($aFeeds);
		        
		        if (is_array($aFeeds) && count($aFeeds)>0 && is_array($aFeeds['items'])){
		            foreach ($aFeeds['items'] as $item){
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
                        
                        
    		            $short_text = substr($description,0,200);
    		            $pub_date = date("Y-m-d H:i:s", strtotime($pubDate));
    		            if (!$newsTreeFeeds['category_tag'] || strtoupper($newsTreeFeeds['category_tag']) == strtoupper($item['category'])){
    		            // if RSS-feeds have different categories => it should be same as in item
    		            
    		                $sameNews = $newsModel -> getNewsSame($newsTreeFeeds['id'], $title, $link, $description, $category, $pub_date);
    		                if (!is_array($sameNews) || count($sameNews)==0){ // not found same news
    		                  $newsModel -> addNews(
    		                              $newsTreeFeeds['id'], $title, $link, $short_text, $description, 
    		                              $category, $pub_date, $enclosure, $enclosure_type, 0, 0, 0);
    		                }
    		            }
		            }
		        }
		        echo "</pre>";

		        echo "<hr>";exit;
		    }
		    
		}
		
		
		
	}
?>
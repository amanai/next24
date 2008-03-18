<?php
class SubscribeController extends SiteController{
	
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "SubscribeView";
			}
			parent::__construct($view_class);
			
		}
		function BaseSubscribeData(&$info){
			$info['tab_list'] = TabController::getOwnTabs(false, false, false, false, false, false, false, true);
		}
		
		
		function ListAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$this -> BaseSiteData();
			$info = array();
			$this -> BaseSubscribeData($info);
			
			
			
			$filter = (int)$request -> getKeyByNumber(0);
			$blog_catalog_page = (int)$request -> getKeyByNumber(1);
			
			if ($filter === 1){
				$info['only_subscribed'] = true;
				$info['all_tree'] = false;
			} else {
				$info['only_subscribed'] = false;
				$info['all_tree'] = true;
			}
			$info['only_subscribed_link'] = $request -> createUrl('Subscribe', 'List', array(1, $blog_catalog_page));
			$info['all_link'] = $request -> createUrl('Subscribe', 'List', array(0, $blog_catalog_page));
			$blog_catalog_model = new BlogCatalogModel;
			$pager = new DbPager($blog_catalog_page, $this -> getParam('blog_catalog_per_page', 10));
			$blog_catalog_model -> setPager($pager);
			if ($filter === 1){
				$info['blog_catalog'] = $blog_catalog_model -> loadSubscribedPage($user_id);
			} else {
				$info['blog_catalog'] = $blog_catalog_model -> loadAll();
			}
			$info['level'] = 0;
			
			foreach($info['blog_catalog'] as &$item){
				$item['ajax_param'] = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogCatalogTree', array($item['id'], $info['level'], $filter, 1));
			}
			$info['direction'] = 1;
			$this -> _view -> SubscribeList($info);
			$this -> _view -> parse();
		}
		
		function AjaxBlogCatalogTreeAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$info = array();
			$catalog_id = (int)$request -> getKeyByNumber(0);
			$level = (int)$request -> getKeyByNumber(1);
			$filter = (int)$request -> getKeyByNumber(2);
			$direction = (int)$request -> getKeyByNumber(3);
			if ($direction === 1){
				$tree_model = new BlogTreeModel;
				$info['blog_catalog'] = $tree_model -> loadByCatalog($catalog_id);
				$subscribe_model = new BlogSubscribeModel;
				foreach ($info['blog_catalog'] as $key => &$item){
					$subscribed = $subscribe_model -> isSubscribed($user_id, $item['id']);
					$count_subitems = $tree_model -> countSubItems($item['key']);
					if (!$filter ||  $subscribed || $count_subitems){
						$item['count_subitems'] = $count_subitems;
						$item['need_subscribe'] = true;
						$item['subscribed'] = $subscribed;
					} else {
						unset($info['blog_catalog'][$key]);
					}
				}
				$info['level'] = $level + 1;
			} else {
				$info['level'] = $level;
			}
			//var_dump($info['level']);die;
			$info['direction'] = $direction;
			$info['id'] = $catalog_id;
			
			$info['filter'] = $filter;
			$this -> _view -> AjaxBlogCatalogTree($info);
			$this -> _view -> ajax();
		}
		
		function AjaxBlogTreeAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$info = array();
			$tree_id = (int)$request -> getKeyByNumber(0);
			$level = (int)$request -> getKeyByNumber(1);
			$filter = (int)$request -> getKeyByNumber(2);
			$direction = (int)$request -> getKeyByNumber(3);
			$tree_model = new BlogTreeModel;
			$info['blog_catalog'] = $tree_model -> loadListByParentId($tree_id);
			
			$subscribe_model = new BlogSubscribeModel;
			if ($direction === 1){
				foreach ($info['blog_catalog'] as $key => &$item){
					$subscribed = $subscribe_model -> isSubscribed($user_id, $item['id']);
					$count_subitems = $tree_model -> countSubItems($item['key']);
					if (!$filter ||  $subscribed || $count_subitems){
						if ($level >= 1){
							$count_subitems = 0;
						}
						$item['count_subitems'] = $count_subitems;
						$item['need_subscribe'] = true;
						$item['subscribed'] = $subscribed;
					} else {
						unset($info['blog_catalog'][$key]);
					}
					
				}
				$info['level'] = $level + 1;
			} else {
				$info['level'] = $level;
			}
			$info['id'] = $tree_id;
			$info['direction'] = $direction;
			$info['filter'] = $filter;
			$this -> _view -> AjaxBlogTree($info);
			$this -> _view -> ajax();
		}
		
		function ChangeAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$tree_id = (int)$request -> getKeyByNumber(0);
			
			$subscribe_model = new BlogSubscribeModel;
			$subscribe_model -> changeSubscribe($user_id, $tree_id);
			$info = array();
			$info['id'] = $tree_id;
			
			$this -> _view -> Change($info);
			$this -> _view -> ajax();
		}
}
?>

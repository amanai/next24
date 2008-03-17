<?php
class SubscribeController extends SiteController{
	
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "SubscribeView";
			}
			parent::__construct($view_class);
			
		}
		
		function ListAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$this -> BaseSiteData();
			$info = array();
			
			
			$blog_catalog_page = $request -> getKeyByNumber(0);
			
			$blog_catalog_model = new BlogCatalogModel;
			$pager = new DbPager($blog_catalog_page, $this -> getParam('blog_catalog_per_page', 10));
			$blog_catalog_model -> setPager($pager);
			$info['blog_catalog'] = $blog_catalog_model -> loadPage();
			$info['level'] = 0;
			
			
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
			$tree_model = new BlogTreeModel;
			$info['blog_catalog'] = $tree_model -> loadByCatalog($catalog_id);
			$subscribe_model = new BlogSubscribeModel;
			foreach ($info['blog_catalog'] as &$item){
				$item['count_subitems'] = $tree_model -> countSubItems($item['key']);
				$item['need_subscribe'] = true;
				$item['subscribed'] = $subscribe_model -> isSubscribed($user_id, $item['id']);
			}
			$info['id'] = $catalog_id;
			$info['level'] = $level + 1;
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
			$tree_model = new BlogTreeModel;
			$info['blog_catalog'] = $tree_model -> loadListByParentId($tree_id);
			
			$subscribe_model = new BlogSubscribeModel;
			
			foreach ($info['blog_catalog'] as &$item){
				if ($level >= 1){
					$item['count_subitems'] = 0;
				} else {
					$item['count_subitems'] = $tree_model -> countSubItems($item['key']);
				}
				$item['need_subscribe'] = true;
				$item['subscribed'] = $subscribe_model -> isSubscribed($user_id, $item['id']);
				
			}
			$info['id'] = $tree_id;
			$info['level'] = $level + 1;
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
			
		}
}
?>

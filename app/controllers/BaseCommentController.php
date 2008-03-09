<?php
class BaseCommentController extends CBaseController{
	const DEFAULT_COMMENT_PER_PAGE = 8;
		


		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "SiteCommentView";
			}
			parent::__construct($view_class);
		}
		
		/**
		 * 
		 */
		public function CommentList($model_class, $item_id, $page_number, $page_size, $cur_controller, $cur_action, $params, $del_controller, $del_action){
			if ((int)$page_size <= 0){
				$page_size = self::DEFAULT_COMMENT_PER_PAGE;
			}
			$request = Project::getRequest();
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$requested_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$info = array();
			$model = new $model_class;
			$pager = new DbPager($page_number, $page_size);
			$model -> setPager($pager);
			$list = $model -> loadByItem($item_id);
			foreach($list as &$item){
				if (($user_id > 0) && (($user_id === $requested_user_id) || ((int)$item['user_id'] === $user_id))){
					$item['del_link'] = $request -> createUrl($del_controller, $del_action, array($item_id, $item['id']));
				} else {
					$item['del_link'] = false;
				}
			}
			$info['comment_list'] = $list;
			$pager_view = new SitePagerView();
			$info['comment_list_pager'] = $pager_view -> show2($model -> getPager(), $cur_controller, $cur_action, $params);
			$this -> _view -> CommentList($info);
			return $this -> _view -> parse();
		}
	}
?>
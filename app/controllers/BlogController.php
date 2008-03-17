<?php

/**
 * Контроллер для работы с блогами
 */
	class BlogController extends SiteController{
		const DEFAULT_POST_PER_PAGE = 2;
		const DEFAULT_COMMENT_PER_PAGE = 8;
		const DEFAULT_SUBSCRIBE_TAG = 'subscribe';
		private $_is_subscribed_to_log = false;
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "BlogView";
			}
			parent::__construct($view_class);
			
		}
		
		function BaseBlogData(&$info){
			$request = Project::getRequest();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			if ($request_user_id <= 0){
				Project::getResponse() -> redirect($request -> createUrl('Index', 'Index', null, false));
			}
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			if ($request_user_id === $user_id) {
				$v = new BlogView();
				$v -> ControlPanel();
				$info['control_panel'] = $v -> parse();
				$info['blog_owner'] = true;
			} else {
				$info['control_panel'] = null;
				$info['blog_owner'] = false;
			}
			$info['tab_list'] = TabController::getOwnTabs(false, false, false, false, false, false, true);
			// User blog tree
			$blog_model = Project::getUser() -> getShowedUser() -> getBlog();
			$tree_model = new BlogTreeModel;
			$info['branch_list'] = $tree_model -> getBranchList($blog_model -> id, $user_id);
		}
		
		function PostListAction(){
			$request = Project::getRequest();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$this -> BaseSiteData();
			$info = array();
			$this -> BaseBlogData($info);
			
			$tree_id = (int)$request -> getKeyByNumber(0);
			$page_number = (int)$request -> getKeyByNumber(1);
			
			$post_model = new BlogPostModel;
			$post_model -> setPager(new DbPager($page_number, $this -> getParam('post_per_page', self::DEFAULT_POST_PER_PAGE)));
			
			$subcribe_model = new BlogSubscribeModel;
			$list = $post_model -> loadList($request_user_id, $user_id, $tree_id, $subcribe_model -> isSubscribed($user_id, $tree_id));
			foreach ($list as &$item){
				$item['comment_link'] = $request -> createUrl('Blog', 'Comments', array($item['id'], $page_number, 0));
				if ($request_user_id === $user_id) {
					$item['edit_link'] = $request -> createUrl('Blog', 'PostEdit', array($item['id'], $page_number));
					$item['del_link'] = $request -> createUrl('Blog', 'PostDelete', array($item['id'], $page_number));
					
				}
			}
			$info['post_list'] = $list;
			
			$pager_view = new SitePagerView();
			$info['post_list_pager'] = $pager_view -> show2($post_model -> getPager(), 'Blog', 'PostList', array($tree_id));
			 
			
			$this -> _view -> PostList($info);
			$this -> _view -> parse();
		}
		
		
		
		
		public function AjaxChangeBranchAction(){
			$request = Project::getRequest();
			$info = array();
			
			$post_model = new BlogPostModel;
			$post_model -> load($request -> getKeyByNumber(0));
			$tag_model = new BlogTagModel;
			$tag_model -> load($post_model -> bc_tag_id);
			$info['post_tag_id'] = $tag_model -> id;
			
			$tree_model = new BlogTreeModel;
			$tree_model -> load($request -> getKeyByNumber(1));
			
			$info['tag_list'] = $tag_model -> loadList($tree_model -> blog_catalog_id, true);
			$this -> _view -> AjaxChangeBranch($info);
			$this -> _view -> ajax();
		}
		
		
		/**
		 * Edit post action
		 */
		public function PostEditAction(){
			
			$request = Project::getRequest();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$this -> BaseSiteData();
			$info = array();
			$this -> BaseBlogData($info);
			
			$post_id = (int)$request -> getKeyByNumber(0);
			$page_number = (int)$request -> getKeyByNumber(1);
			
			$post_model = new BlogPostModel;
			$post_model -> load($post_id);
			
			$info['post_id'] = (int)$post_model -> id;
			$info['full_text'] = $post_model -> full_text;
			$info['small_text'] = $post_model -> small_text;
			$info['post_title'] = $post_model -> title;
			$info['post_creation_date'] = $post_model -> creation_date;
			$info['post_tree_id'] = (int)$post_model -> ub_tree_id;
			$info['post_mood'] = (int)$post_model -> mood;
			$info['post_access'] = (int)$post_model -> access;
			$info['post_allow_comments'] = (int)$post_model -> allowcomments;
			$info['best_post'] = (int)$post_model -> bbp_status;
			
			$tag_model = new BlogTagModel;
			$tag_model -> load($post_model -> bc_tag_id);
			$info['post_tag'] = $tag_model -> name;
			$info['post_tag_id'] = $tag_model -> id;
			$info['post_page_number'] = $page_number;
			
			
			
			$info['access_list'] = HelpFunctions::getBlogAccessList();
			
			$mood_model = new MoodModel;
			$info['mood_list'] = $mood_model -> getList($request_user_id);
			
			$tree_model = new BlogTreeModel;
			$tree_model -> load($post_model -> ub_tree_id);
			
			$info['tag_list'] = $tag_model -> loadList($tree_model -> blog_catalog_id, true);
			
			
			foreach($info['branch_list'] as &$item){
				$item['change_branch_param'] = AjaxRequest::getJsonParam('Blog', 'AjaxChangeBranch', array($post_id, $item['id']));
			}
			
			$this -> _view -> PostEdit($info);
			$this -> _view -> parse();
			return;
		}
		
		/**
		 * Edit blog info action
		 */
		function EditAction(){
			$request = Project::getRequest();
			$info = array();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			if (($request_user_id != $user_id) || !$user_id){
				Project::getResponse() -> redirect($request -> createUrl('Blog', 'PostList'));
			}
			
			$blog_model = new BlogModel;
			$blog_model -> loadByUserId($user_id);
			
			$info['blog_title'] = $blog_model -> title;
			$info['blog_access'] = $blog_model -> access;
			$info['access_list'] = HelpFunctions::getBlogAccessList();

			$this -> BaseSiteData();
			$this -> BaseBlogData($info);
			
			$this -> _view -> BlogEdit($info);
			$this -> _view -> parse();
		}
		
		/**
		 * Save blog info action
		 */
		function SaveAction(){
			$request = Project::getRequest();
			$info = array();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			if (($request_user_id != $user_id) || !$user_id){
				Project::getResponse() -> redirect($request -> createUrl('Blog', 'PostList'));
			}
			
			$blog_model = new BlogModel;
			$blog_model -> loadByUserId($user_id);
			
			if ($blog_model -> id <= 0){
				$blog_model -> creation_date = date("Y-m-d");
				$blog_model -> creation_ip = $_SERVER['REMOTE_ADDR'];
			}
			$blog_model -> title = $request -> blog_title;
			$blog_model -> access = $request -> blog_access;
			$blog_model -> save();
			Project::getResponse() -> redirect($request -> createUrl('Blog', 'Edit'));
		}
		
		function PostSaveAction(){
			$request = Project::getRequest();
			 
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			
			$post_id = (int)$request -> id;
			$page_number = (int)$request -> page_number;
			
			
			$post_model = new BlogPostModel;
			$post_model -> load($request -> id);
			$post_model -> title = $request -> post_title;
			$post_model -> full_text = $request -> post_full_text;
			$post_model -> small_text = $request -> post_small_text;
			$post_model -> ub_tree_id = $request -> post_branch;
			$post_model -> bc_tag_id = $request -> post_tag;
			if ($request -> allow_comments){
				$post_model -> allowcomments = 1;
			} else {
				$post_model -> allowcomments = 0;
			}
			if ($request -> best_post){
				if ((int)$post_model -> bbp_status === BEST_POST_STATUS::NO){
					$post_model -> bbp_status = BEST_POST_STATUS::MODERATION;
				}
			} else {
				if (!$post_model -> bbp_status){
					$post_model -> bbp_status = BEST_POST_STATUS::NO;
				}
			}
			$post_model -> access = (int)$request -> post_access;
			$post_model -> mood = (int)$request -> post_mood;
			$post_model -> avatar_id = (int)$request -> post_avatar;
			
			if ($post_model -> id <= 0){
				$post_model -> creation_date = date("Y-m-d");
				$post_model -> creation_ip = $_SERVER['REMOTE_ADDR'];
				$post_model -> comments = 0;
				$post_model -> views = 0;
			}
			$post_id = $post_model -> save();
			
			Project::getResponse() -> redirect($request -> createUrl('Blog', 'PostEdit', array($post_id, $page_number)));
		}
		
		public function CommentsAction(){
			$request = Project::getRequest();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$this -> BaseSiteData();
			$info = array();
			$this -> BaseBlogData($info);
			
			$post_id = (int)$request -> getKeyByNumber(0);
			$post_page_number = (int)$request -> getKeyByNumber(1);
			$page_number = (int)$request -> getKeyByNumber(2);
			
			
			
			
			$controller = new BaseCommentController();
			$info['comment_list'] = $controller -> CommentList(
																'BlogCommentModel', // Model for getting comments 
																$post_id,  // Id of comment item
																$page_number, // current page number
																$this -> getParam('comment_per_page'),  // page size
																'Blog', 'Comments', array($post_id, $post_page_number), // current view params
																'Blog', 'DeleteComment' // parameters for delete action
																);
			
			
			
			$post_model = new BlogPostModel;
			$post_model -> load($post_id);
			$info['full_text'] = ($request_user_id !== $user_id ) ? $this -> PostPreprocess($post_model -> full_text, $user_id, $post_model -> ub_tree_id) : $post_model -> full_text;
			$info['post_title'] = $post_model -> title;
			$info['post_creation_date'] = $post_model -> creation_date;
			$info['post_allow_comments'] = (int)$post_model -> allowcomments;
			$tag_model = new BlogTagModel;
			$tag_model -> load($post_model -> bc_tag_id);
			$info['post_tag'] = $tag_model -> name;
			
			
			$info['add_comment_url'] = $request -> createUrl('Blog', 'SaveComment', array($post_id, $post_page_number, $page_number));
			
			$this -> _view -> CommentList($info);
			$this -> _view -> parse();
		}
		
		public function PostPreprocess($text, $user_id, $tree_id){
			$subscribe_model = new BlogSubscribeModel;
			if (!$subscribe_model -> isSubscribed($user_id, $tree_id)){
				$subscribe_tag = $this -> getParam('subscribe_tag', self::DEFAULT_SUBSCRIBE_TAG);
				$startTag = '\<' . $subscribe_tag . '\>';
				$endTag = '\<\/' . $subscribe_tag . '\>';
				$token  = '/'.$startTag.'([^?]+)'.$endTag.'/i'; // Modified i make case insensitive replacing
				$text = preg_replace($token, $this -> _view -> UnsubscribedText(), $text);
			}
			return $text;
		}
		
		public function SaveCommentAction(){
			$request = Project::getRequest();
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$post_id = (int)$request -> getKeyByNumber(0);
			$post_page_number = (int)$request -> getKeyByNumber(1);
			$page_number = (int)$request -> getKeyByNumber(2);
			
			$post_model = new BlogPostModel;
			$post_model -> load($post_id);
			
			$comment_model = new BlogCommentModel($request -> id);
			if ($post_model -> id > 0){
				$comment_model -> addComment($user_id, 0, 0, $post_id, $request -> comment, 0);
			}
			Project::getResponse() -> redirect($request -> createUrl('Blog', 'Comments', array($post_id, $post_page_number, $page_number)));
		}
		
		/**
		 * Delete comment
		 */
		public function DeleteCommentAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$post_id = $request -> getKeyByNumber(0);
			$comment_id = $request -> getKeyByNumber(1);
			
			$comment_model = new BlogCommentModel($comment_id);
			$post_model = new BlogPostModel;
			$post_model -> load($post_id);
			if (($comment_model -> id > 0) && ($post_model -> id > 0) && ($comment_model -> blog_post_id == $post_model -> id)){
				if (($comment_model -> user_id == $user_id) || ($post_model -> user_id == $user_id)){
					$comment_model -> delete($comment_model -> user_id, $comment_id);
				}
			}
			Project::getResponse() -> redirect($request -> createUrl('Blog', 'Comments', array($post_id)));
			//TODO::avatar?warning?mood?
		}
		
		
		
		/**
		 * Удаление поста из раздела блога
		 */
		public function PostDeleteAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$post_id = $request -> getKeyByNumber(0);
			$page_number = $request -> getKeyByNumber(1);
			
			// Delete comments
			$comment_model = new BlogCommentModel();
			$comment_model -> deleteByItem($user_id, $post_id);
			// Delete posts
			$post_model = new BlogPostModel;
			$post_model -> load($post_id);
			$tree_id = $post_model -> ub_tree_id;
			$post_model -> delete($post_id);
			
			
			Project::getResponse() -> redirect($request -> createUrl('Blog', 'PostList', array($tree_id , $page_number)));
			
			
			// TODO:: need to delete warnings?
			
			
			
		}
		
		/**
		 * 
		 */
		public function EditBranchAction($id = null){
			
			$request = Project::getRequest();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$this -> BaseSiteData();
			$info = array();
			$this -> BaseBlogData($info);
			
			$branch_id = ($id !== null)?(int)$id:(int)$request -> getKeyByNumber(0);
			
			$blog_model = new BlogModel;
			$blog_model -> loadByUserId($user_id);
			$blog_id = (int)$blog_model -> id;
			if ($blog_id <= 0){
				Project::getResponse() -> redirect($request -> createUrl('Blog', 'Post'));
			}
			
			$tree_model = new BlogTreeModel;
			$tree_model -> load($branch_id);
			$info['branch_id'] = $tree_model -> id;
			$info['branch_name'] = $tree_model -> name;
			$info['branch_access'] = $tree_model -> access;
			$info['blog_catalog_id'] = $tree_model -> blog_catalog_id;
			$info['access_list'] = HelpFunctions::getBlogAccessList();
			
			$catalog_model = new BlogCatalogModel;
			$info['catalog_list'] = $catalog_model -> loadAll();
			
			
			$n = $tree_model -> getNode();
			if ($n instanceof Node){
				$child =  $n -> getLastChildKey();
				$parent = $n -> key -> getParent();
				$info['parent_key'] = $parent -> __toString();
			} else {
				$child = null;
				$info['parent_key'] = null;
			}
			if ($child){
				$info['parent_list'] = 1;
			} else {
				$info['parent_list'] = $tree_model -> getParentList($blog_id, $tree_model -> id);
			}
			
			$this -> _view -> BranchEdit($info);
			$this -> _view -> parse();
		}
		
		function SaveBranchAction(){
			$request = Project::getRequest();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$branch_id = (int)$request -> branch_id;
			$name = $request -> branch_name;
			$catalog_id = (int)$request -> blog_catalog;
			$parent_id = (int)$request -> parent_branch;
			$access = (int)$request -> branch_access;
			
			$this -> BaseSiteData();
			$info = array();
			$this -> BaseBlogData($info);
			
			$blog_model = new BlogModel;
			$blog_model -> loadByUserId($user_id);
			$blog_id = (int)$blog_model -> id;
			if ($blog_id <= 0){
				Project::getResponse() -> redirect($request -> createUrl('Blog', 'Post'));
			}
			
			$parent_tree_model = new BlogTreeModel;
			$parent_tree_model -> load($parent_id);
			$parent_node = $parent_tree_model -> getNode();
			if ($parent_tree_model -> level > 1){
				$this -> _view -> addFlashMessage(FM::ERROR, "Неверно выбран родительский раздел");
				$this -> EditBranchAction($branch_id);
				return;
			}
			
			
			
			$tree_model = new BlogTreeModel;
			$tree_model -> load($branch_id);
			$n = $tree_model -> getNode();
			if ($n instanceof Node){
				$child =  $n -> getLastChildKey();
			} else {
				$child = null;
			}
			if ($child){
				$this -> _view -> addFlashMessage(FM::ERROR, "Невозможно переместить раздел: есть зависимые разделы");
				$this -> EditBranchAction($branch_id);
				return;
			}
			
			$tree_model -> name = $name;
			$tree_model -> blog_id = $blog_id;
			$tree_model -> access = $access;
			$tree_model -> blog_catalog_id = $catalog_id;
			$tree_model -> blog_banner_id = 0;
			if (!$n){
				$n = $tree_model -> getNode();
			}
			if (!$parent_node || !$tree_model -> id){
				$n = $tree_model -> getNode();
				$tree_model -> key = $n -> getNewChildKey() -> __toString();
				$tree_model -> level = 1;
			} 
			
			$branch_id = $tree_model -> save();
			$n = $tree_model -> getNode();
			if ($parent_node){
				$n -> changeParent($parent_node);
			}
			Project::getResponse() -> redirect($request -> createUrl('Blog', 'EditBranch', array($branch_id)));
			
		}
}
?>
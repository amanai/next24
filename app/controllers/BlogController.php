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
			} else {
				$info['control_panel'] = null;
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
				}
			}
			$info['post_list'] = $list;
			
			$pager_view = new SitePagerView();
			$info['post_list_pager'] = $pager_view -> show2($post_model -> getPager(), 'Blog', 'PostList', array($tree_id));
			 
			
			$this -> _view -> PostList($info);
			$this -> _view -> parse();
		}
		
		private function checkBranchAccess($branch_id, $user_id){
			if ($branch_id > 0){
				$this -> setModel("BlogTree");
				$this -> model -> resetSql();
				$this -> model -> load($branch_id);
				$blog_id = (int)$this -> model -> get('blog_id');
				if ($blog_id == 0){
					// Branch is not connected to any blogs
					$router = getManager('CRouter');
					$router -> redirect($router -> createUrl('Blog', 'Post'));
				}
				$this -> setModel("BlogsModel");
				$this -> model -> resetSql();
				$this -> model -> load($blog_id);
				$owner_id = (int)$this -> model -> get('user_id');
				
				$this -> view -> blog_info = $this -> model -> getData();
				
				if (($owner_id === 0) || ($owner_id !== $user_id)) {
					// User not logged or is not owner of blog
					die('is not owner');
					$router = getManager('CRouter');
					$router -> redirect($router -> createUrl('Blog', 'Post'));
				}
				$this -> view -> new_branch = false;
			} else {
				$blog_id = (int)$this -> blog_id;
				$this -> view -> new_branch = true;
				if ($blog_id > 0){
					$this -> setModel("BlogsModel");
					$this -> model -> resetSql();
					$this -> model -> load($blog_id);
					$owner_id = (int)$this -> model -> get('user_id');
					if (($owner_id === 0) || ($owner_id !== $user_id)) {
						// User not logged or is not owner of blog
						die('is not owner 2');
						$router = getManager('CRouter');
						$router -> redirect($router -> createUrl('Blog', 'Post'));
					}
					$this -> view -> blog_info = $this -> model -> getData();
				} else {
					// Can't create branch out of blog
					die('out of blog');
					$router = getManager('CRouter');
					$router -> redirect($router -> createUrl('Blog', 'Post'));
				}
				
			}
			$this -> view -> blog_owner = true;
			return $blog_id;
		}
		
		
		public function checkOwner($blog_id, $user_id){
			$this -> setModel("BlogModel");
			$this -> model -> resetSql();
			$data = $this -> model -> load($blog_id);
			if (isset($data['user_id']) && ($user_id == $data['user_id'])){
				return true;
			} else {
				return false;
			}
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
			$post_model -> small_text = substr($request -> post_full_text, 200);
			$post_model -> full_text = $request -> post_full_text;
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
		 * 
		 */
		public function PostAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			
			
			$n = Node::by_key('', 'ub_tree');
			$this -> view -> branch_list =  $n->getBranch();
			
			$id = (int)$this -> id;
			if ($id > 0){
				$this -> setModel("BlogTree");
				$this -> model -> resetSql();
				$this -> model -> load($id);
				$blog_id = (int)$this -> model -> get('blog_id');
				$this -> view -> blog_owner = $this -> checkOwner($blog_id, $user_id);
				$this -> setModel("BlogsModel");
				$this -> model -> resetSql();
				$this -> model -> load($blog_id);
				$blog_data = $this -> model -> getData();
			} else {
				$this -> view -> blog_owner = true;
				$this -> setModel("BlogsModel");
				$this -> model -> resetSql();
				$this -> model -> where('user_id='.(int)$user_id);
				$blog_data = $this -> model -> getOne();
				$blog_id = (int)$blog_data['blog_id'];
			}
			if ($blog_id == 0){
				//TODO:: no blog exists
			}
			$this -> blog_id = $blog_id;
			$this -> checkBranchAccess($id, $user_id);
			
			if ( ($number = $this -> getParam('post_per_page', self::DEFAULT_POST_PER_PAGE)) === 0){
				$number = self::DEFAULT_POST_PER_PAGE;
			}
			
			$this -> setModel("BlogPosts");
			$this -> model -> resetSql();
			$this -> model -> pager();
			$this -> model -> cols('blog_posts.*, count(blog_comments.id) as comments_count, blogs.user_id as user_id');
			$this -> model -> join('blog_comments', 'blog_comments.blog_post_id=blog_posts.id', 'LEFT');
			$this -> model -> join('blogs', 'blogs.id=blog_posts.blog_id', 'LEFT');
			$this -> model -> where("blog_posts.access>0");
			$this -> model -> where("blog_posts.blog_id=".(int)$blog_id);
			$this -> model -> group('blog_posts.id');
			if ($id > 0){
				$this -> model -> where("blog_posts.ub_tree_id=".(int)$id);
			}
			// TODO:: parameters by group?
			$this -> model -> limit($number, (int)$this -> pn*$number);
			$list = $this -> model -> getAll();
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			$this -> view -> current_controller = 'Blog';
			$this -> view -> current_action = 'Post';
			if ($id > 0){
				$this -> view -> pager_params = array('id'=>$id);
			}
			
			foreach ($list as $key=>$value){
				if ($value['user_id'] == $user_id){
					$list[$key]['owner'] = true;
				} else {
					$list[$key]['owner'] = false;
				}
				
			}
			$this -> view -> post_list = $list;
			$this->view->content .= $this->view->render(VIEWS_PATH.'blogs/posts.tpl.php');
			$this->view->display();
		}
		
		/**
		 * Удаление поста из раздела блога
		 */
		public function PostDeleteAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			$id = (int)$this -> id;
			$this -> setModel('BlogPosts');
			$this -> model -> resetSql();
			$this -> model -> load($id);
			$post_data = $this -> model -> getData();
			$blog_id = (int)$this -> model -> get('blog_id');
			$branch_id = (int)$this -> model -> get('ub_tree_id');
			$blog__check_id = $this -> checkBranchAccess($branch_id, $user_id);
			if ($blog__check_id != $blog_id){
				// TODO:: something wring: blog id from post != blog id from ub tree
				die('Something wrong->Check blog ID (ub_tree.blog_id) <> blog id from post(blog_post.blog_id)');
			}
			$this -> setModel('BlogComments');
			$this -> model -> resetSql();
			$this -> model -> deleteByItem($user_id, $id);
			
			$this -> setModel('BlogPosts');
			$this -> model -> resetSql();
			$this -> model -> id = $id;
			$this -> model -> delete();
			
			// TODO:: need to delete warnings?
			
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Blog', 'Post', array('id'=>$branch_id)));
		}
		
		/**
		 * 
		 */
		public function EditBranchAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			
			$branch_id = (int)$this -> id;
			
			$blog_id = $this -> checkBranchAccess($branch_id, $user_id);
			
			$this -> setModel("BlogTree");
			$this -> model -> resetSql();
			$this -> model -> load($branch_id);
			$this -> view -> branch_info = $this -> model -> getData();
			
			$n = Node::by_key('', 'ub_tree');
			$this -> view -> branch_list =  $n->getBranch();
	
			$this -> setModel("BlogsCatalog");
			$this -> model -> resetSql();
			$this -> model -> order("`name` ASC");
			$this -> view -> catalog_list =  $this -> model -> getAll();

			$this->view->content .= $this->view->render(VIEWS_PATH.'blogs/edit_branch.tpl.php');
			$this->view->display();
			
		}
		
		function SaveBranchAction(){
			//var_dump($this -> branch_name, $this -> branch_access, $this -> branch_parent, $this -> branch_catalog);
			
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			
			$this -> setModel("BlogsModel"); 
			$this -> model -> resetSql();
			$this -> model -> where('user_id = '.$user_id);
			$this -> model -> setData($this -> model -> getOne());
			// Set blog id for rightly check Branch Access
			$this -> blog_id = (int)$this -> model -> get('id');
			$branch_id = (int)$this -> branch_id;

			$this -> checkBranchAccess($branch_id, $user_id);
			
			$this -> setModel("BlogTree");
			$this -> model -> load($branch_id);
			$branch_data = $this -> model -> getData();
			
			// Set data to tree model
			$this -> setModel("BlogTree");
			$this -> model -> resetSql();
			$this -> model -> set('id', (isset($branch_data['id'])?(int)$branch_data['id']:null));
			$this -> model -> set('blog_id', $this -> blog_id);
			$this -> model -> set('name', $this -> branch_name);
			$this -> model -> set('access', (int)$this -> branch_access);
			$this -> model -> set('blogs_catalog_id', (int)$this -> branch_catalog);
			$this -> model -> set('blog_banner_id', 0); // TODO::0
			//$this -> model -> set('key', '');
			if (!count($branch_data)){
				$this -> model -> set('key', '');
			} else {
			}
			$this -> model -> set('level', 0);
			$branch_id = (int)$this -> model -> save();
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Blog', 'EditBranch', array('id'=>$branch_id)));

		}
		
		
		
		function show_tree($vars){
			$n = Node::by_key('', 'sitemap');
			$this->data['tree'] = $n->getBranch();
			$this->template_name = 'tree_test.tpl';
		}
		function move_up($vars){
			$n = Node::by_id($vars['id'], 'sitemap');
			$n->moveUp();
			$this->go_page();
		}
		function move_down($vars){
			$n = Node::by_id($vars['id'], 'sitemap');
			$n->moveDown();
			$this->go_page();
		}
		function delete($vars){
			$n = Node::by_id($vars['id'], 'sitemap');
			$n->delete();
			$this->go_page();
		}
		function change_parent($vars){
			$n = Node::by_id($vars['id'], 'sitemap');
			$parent = Node::by_id($vars['parent_id'], 'sitemap');
			$n->changeParent($parent);
			$this->go_page();
		}
	}
?>
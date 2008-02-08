<?php

/**
 * Контроллер для работы с блогами
 */
	class BlogController extends CBaseController{
		const DEFAULT_POST_PER_PAGE = 8;
		const DEFAULT_COMMENT_PER_PAGE = 8;
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this -> setModel("Blogs");
			parent::__construct($View, $params, $vars);
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
		
		public function PostEditAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			
			$id = (int)$this -> id;
			$this -> setModel("BlogPosts");
			$this -> model -> load($id);
			$this -> view -> post_info =  $this -> model -> getData();
			/*if ((int)$this -> model -> id <= 0){
				// TODO:: no post
				$router = getManager('CRouter');
				$router -> redirect($router -> createUrl('Blog', 'Post'));
			}*/
			
			$n = Node::by_key('', 'ub_tree');
			$this -> view -> branch_list =  $n->getBranch();
			
			
			$branch_id = (int)$this -> model -> get('ub_tree_id');
			
			$this -> setModel('BlogsModel');
			$this -> model -> resetSql();
			$this -> model -> where('user_id = '.$user_id);
			$this -> model -> setData($this -> model -> getOne());
			$this -> blog_id = $this -> model -> get('id');
			
			$blog_id = $this -> checkBranchAccess($branch_id, $user_id);
			
			$this -> setModel('Moods');
			$this -> model -> resetSql();
			$this -> model -> where('user_id='.(int)$user_id);
			$this -> view -> mood_list =  $this -> model -> getAll();
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'blogs/edit_post.tpl.php');
			$this->view->display();
			
		}
		
		function PostSaveAction(){

			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			$id = (int)$this -> post_id;
			$this -> setModel('BlogPosts');
			$this -> model -> resetSql();
			$this -> model -> load($id);
			$post_data = $this -> model -> getData();
			$branch_id = (int)$this -> model -> get('ub_tree_id');
			
			
			$this -> setModel('BlogsModel');
			$this -> model -> resetSql();
			$this -> model -> where('user_id = '.$user_id);
			$this -> model -> setData($this -> model -> getOne());
			$blog_id  = (int)$this -> model -> get('id');

			$this -> blog_id = $blog_id;
			$blog__check_id = $this -> checkBranchAccess($branch_id, $user_id);
			if ($blog__check_id != $blog_id){
				// TODO:: something wring: blog id from post != blog id from ub tree
				die('Something wrong->Check blog ID (ub_tree.blog_id) <> blog id from post(blog_post.blog_id)');
			}
			$post_data['blog_id'] = $blog_id;
			$post_data['title'] = $this -> post_name;
			$post_data['ub_tree_id'] = (int)$this -> post_branch;
			$post_data['access'] = (int)$this -> post_access;
			$post_data['small_text'] = $this -> small_text;
			$post_data['full_text'] = $this -> full_text;
			if ($this -> allowcomments == 'on'){
				$post_data['allowcomments'] = 1;
			} else {
				$post_data['allowcomments'] = 0;
			}
			$post_data['mood'] = (int)$this -> post_mood;
			$post_data['bbp_status'] = (int)$this -> post_best_status;
			$post_data['creation_date'] = date("Y-m-d");
			$post_data['bc_tags_id'] = 0; // TODO::tag handling
			$post_data['avatar_id'] = 0; // TODO:: avatar handling
			if ($id == 0){
				$post_data['comments'] = 0;
				$post_data['views'] = 0;
				$post_data['creation_ip'] = $_SERVER['REMOTE_ADDR'];
			}
			
			$this -> setModel('BlogPosts');
			$this -> model -> resetSql();
			$this -> model -> setData($post_data);
			$this -> model -> id = $id;
			$id = $this -> model -> save();
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Blog', 'PostEdit', array('id'=>$id)));
		}
		
		public function CommentsAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			
			$id = $this -> id;
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
			
			$this -> setModel("BlogPosts");
			$this -> model -> load($id);
			$post_data = $this -> model -> getData();
			$this -> view -> post_info =  $post_data;
			$post_data['views']++;
			$this -> model -> setData($post_data);
			$this -> model -> save();
			
			$n = Node::by_key('', 'ub_tree');
			$this -> view -> branch_list =  $n->getBranch();
			
			if ( ($number = $this -> getParam('post_comments_per_page', self::DEFAULT_COMMENT_PER_PAGE)) === 0){
				$number = self::DEFAULT_COMMENT_PER_PAGE;
			}
			
			$this -> setModel('BlogComments');
			$this -> model -> resetSql();
			$list = $this -> model -> loadByItem($id, false,(int)$this -> pn*$number,  $number);
			
			foreach ($list as $key=>$value){
				if ($value['user_id'] == $user_id){
					$list[$key]['comment_owner'] = true;
				}
				$list[$key]['delete_comment_param'] = array('id'=>$value['id']);
			}
			
			$this -> view -> delete_comment_controller = 'Blog';
			$this -> view -> delete_comment_action = 'DeleteComment';
			
			
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			$this -> view -> current_controller = 'Blog';
			$this -> view -> current_action = 'Comments';
			if ($id > 0){
				$this -> view -> pager_params = array('id'=>$id);
			}
			
			$this -> view -> allow_add_comment = ($user_id > 0) ? true : false;
			$this -> view -> add_comment_controller = 'Blog';
			$this -> view -> add_comment_action = 'SaveComment';
			$this -> view -> add_comment_item_id = $id;
			$this -> view -> add_comment_page_number = (int)$this -> pn;
			
			$this -> view -> comment_list = $list;
			
			
			
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'blogs/post_comments.tpl.php');
			$this->view->display();
		}
		
		public function SaveCommentAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			
			$this -> setModel('BlogComments');
			$this -> model -> addComment($user_id, 0, 0, $this -> id, $this -> comment, '');
			
			$this -> setModel("BlogPosts");
			$this -> model -> load($this -> id);
			$post_data = $this -> model -> getData();
			$this -> view -> post_info =  $post_data;
			$post_data['comments']++;
			$this -> model -> setData($post_data);
			$this -> model -> save();
			
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Blog', 'Comments', array('id'=>$this -> id, 'pn' => (int)$this -> pn)));
		}
		
		public function DeleteCommentAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			}
			$id = (int)$this -> id;
			$this -> setModel('BlogComments');
			$this -> model -> resetSql();
			$this -> model -> load($id);
			$post_id = $this -> model -> get('blog_post_id');
			
			$this -> setModel('BlogPosts');
			$this -> model -> resetSql();
			$this -> model -> load($post_id);
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
			$this -> model -> delete($user_id, $id);
			
			// Update comments number
			$this -> setModel('BlogPosts');
			$this -> model -> resetSql();
			$this -> model -> load($post_id);
			$n = $this -> model -> get('comments');
			$this -> model -> set('comments', $n - 1);
			$this -> model -> save();
			
			// TODO:: need to delete warnings?
			
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Blog', 'Comments', array('id'=>$post_id)));
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
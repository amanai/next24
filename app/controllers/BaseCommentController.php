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
		public function CommentList($item_id, $page_number, $page_size, $cur_controller, $cur_action, $item_name, $params){
		    $userModel = new UserModel();
		    $info = array();
		    if ((int)$page_size <= 0){
				$page_size = self::DEFAULT_COMMENT_PER_PAGE;
			}
			$request = Project::getRequest();
    		$user = Project::getUser()->getDbUser();
    	    $isAdmin = ($user->user_type_id == 1)?true:false;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$info['cur_controller'] = $cur_controller;
			$info['cur_action'] = $cur_action;
			$info['item_name'] = $item_name;
			$info['add_comment_element_id'] = $item_id;
			$info['add_comment_id'] = 0;
			$info['isAdmin'] = $isAdmin;
			$info['user_id'] = $user_id;
			$info['default_avatar'] = $userModel->getUserAvatar($user_id);
			$requested_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			
			$model = new CommentModel($item_name.'_comment', $item_name.'_id', 0);
			$pager = new DbPager($page_number, $page_size);
			$model -> setPager($pager);
			$list = $model -> loadByItem($item_id);
			foreach($list as &$item){
				if (($user_id > 0) && (($user_id === $requested_user_id) || ((int)$item['user_id'] === $user_id))){
					$item['del_link'] = $request -> createUrl("BaseComment", "DeleteComment", array($item_id, $item['id'], $item_name));
				} else {
					$item['del_link'] = false;
				}
			}
			$info['add_comment_url'] = $request -> createUrl('BaseComment', 'AddComment');
			$info['change_comment_url'] = $request -> createUrl('BaseComment', 'EditComment');
			$info['comment_list'] = $list;
			$pager_view = new SitePagerView();
			$info['comment_list_pager'] = $pager_view -> show2($model -> getPager(), $cur_controller, $cur_action, $params);
			
			$info['user_moods'] = $userModel->getAllUserMoods($user_id);
			$info['user_avatars'] = $userModel->getAllUserAvatars($user_id);
			
			
			
			$this -> _view -> CommentList($info);
			return $this -> _view -> parse();
		}
		
		// добавление комментария
    	public function AddCommentAction(){
    		$request = Project::getRequest();
    		$item_name = $request->item_name;
    		
    		$comment_model= new CommentModel($item_name.'_comment', $item_name.'_id', 0);
    		switch ($item_name){
    		    case 'article':
    		        $item_model = new ArticleModel();
    		        break;
    		    case 'questions':
    		        $item_model = new QuestionModel();
    		        break;
    		    case 'photo':
    		        $item_model = new PhotoModel();
    		        break;
    		    case 'bookmarks':
    		        $item_model = new BookmarksModel();
    		        break;
    		    case 'social':
    		        $item_model = new SocialModel();
    		        break;
    		        
    		}
    		$item_model->load($request->element_id);
    		if($item_model->id > 0 && $request->add_comment){
    		    
    			$comment_model->addComment(Project::getUser()->getDbUser()->id, $request->avatar_id, 0, $request->element_id, $request->comment, $request->mood_id, $request->mood_text, 0);
    			$item_model->comments++;
    			$item_model->save();
    			
    		}
    		Project::getResponse()->redirect($request->createUrl($request->cur_controller, $request->cur_action, array($item_model->id)));
    	}
    	
    	// удаление комментария
    	public function DeleteCommentAction(){
    		$request = Project::getRequest();
    		$request_user_id = (int)Project::getUser()->getShowedUser()->id;
    		$user = Project::getUser()->getDbUser();
    	    $isAdmin = ($user->user_type_id == 1)?true:false;
    		$user_id = (int)Project::getUser()->getDbUser()->id;
    		$item_id = $request->getKeyByNumber(0);
    		$comment_id = $request->getKeyByNumber(1);
    		$item_name = $request->getKeyByNumber(2);
    		
    		$comment_model = new CommentModel($item_name.'_comment', $item_name.'_id', $comment_id);
    		switch ($item_name){
    		    case 'article':
    		        $item_model = new ArticleModel();
    		        $item_controller = 'Article';
    		        $item_action = 'ArticleView';
    		        $item_name_id = $comment_model->article_id; 
    		        break;
    		    case 'questions':
    		        $item_model = new QuestionModel();
    		        $item_controller = 'QuestionAnswer';
    		        $item_action = 'ViewQuestion';
    		        $item_name_id = $comment_model->questions_id;
    		        break;
    		    case 'photo':
    		        $item_model = new PhotoModel();
    		        $item_controller = 'Photo';
    		        $item_action = 'View';
    		        $item_name_id = $comment_model->photo_id;
    		        break;
    		    case 'bookmarks':
    		        $item_model = new BookmarksModel();
    		        $item_controller = 'Bookmarks';
    		        $item_action = 'BookmarksView';
    		        $item_name_id = $comment_model->bookmarks_id;
    		        break;
    		    case 'social':
    		        $item_model = new SocialModel();
    		        $item_controller = 'Social';
    		        $item_action = 'SocialView';
    		        $item_name_id = $comment_model->social_id;
    		        break;
    		    
    		}

    		$item_model->load($item_id);
    		if (($comment_model->id > 0) && ($item_model->id > 0) && ($item_name_id == $item_model->id)){
    			if (($comment_model->user_id == $user_id) || ($item_model->user_id == $user_id) || $isAdmin){
    				$comment_model->delete($comment_model->user_id, $comment_id);
    				$item_model->comments--;
    				$item_model->save();
    			}
    		}
    		Project::getResponse()->redirect($request->createUrl($item_controller, $item_action, array($item_model->id)));
    	}
    	
    	// 
    	public function EditCommentAction(){
    		$request = Project::getRequest();
    		$user = Project::getUser()->getDbUser();
    	    $isAdmin = ($user->user_type_id == 1)?true:false;
    		$item_name = $request->item_name;
    		
    		switch ($item_name){
    		    case 'article':
    		        $item_controller = 'Article';
    		        $item_action = 'ArticleView';
    		        break;
    		    case 'questions':
    		        $item_controller = 'QuestionAnswer';
    		        $item_action = 'ViewQuestion';
    		        break;
    		    case 'photo':
    		        $item_controller = 'Photo';
    		        $item_action = 'View';
    		        break;
    		    case 'bookmarks':
    		        $item_controller = 'Bookmarks';
    		        $item_action = 'BookmarksView';
    		        break;
    		    case 'social':
    		        $item_controller = 'Social';
    		        $item_action = 'SocialView';
    		        break;
    		}
    		
    		$comment_model= new CommentModel($item_name.'_comment', $item_name.'_id', $request->comment_id);

    		if($request->change_comment && ($isAdmin || $comment_model->user_id == $user->id)){
    		    $warning_id = 0;
    		    if ($request->warning_text){
    		        $warningModel = new WarningModel();
    		        $warning_id = $warningModel->add($comment_model->user_id, $request->warning_text);
    		    }
    			$comment_model->editComment($comment_model->user_id, $warning_id, $request->editCommentArea, (int)$isAdmin);
    		}
    		Project::getResponse()->redirect($request->createUrl($item_controller, $item_action, array($request->element_id)));
    	}
	}
?>
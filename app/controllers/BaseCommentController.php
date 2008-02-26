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
		static public function CommentListAction(){
			$this -> initCommonData();
			
			$this -> view -> userData['comment_list'] = $this -> model -> loadByItem($this->params['id']);
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'base_comment.tpl.php');
			$this->view->display();
		}
	}
?>
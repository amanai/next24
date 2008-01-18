<?php
class BaseCommentController extends CBaseController{

		function __construct($Model, $View, $params, $vars){
			
			parent::__construct($View, $params, $vars);
			$this->setModel($Model);
		}	
		
		
		/**
		 * 
		 */
		function CommentListAction(){
			$this -> initCommonData();
			
			$this -> view -> userData['comment_list'] = $this -> model -> loadByItem($this->params['id']);
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'base_comment.tpl.php');
			$this->view->display();
			
					
		}
	}
?>
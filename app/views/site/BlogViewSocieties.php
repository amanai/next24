<?php
class BlogViewSocieties extends BaseSiteView{
	protected $_dir = 'blog_societies';
	
	
		function PostList($info){
			$this -> setTemplate($this -> _dir, 'post_list.tpl.php');
			$this -> set($info);
		}
		
		function CommentList($info){
			$this -> setTemplate($this -> _dir, 'post_comments.tpl.php');
			$this -> set($info);
		}
		
		function ControlPanel($info = array()){
			$this -> setTemplate($this -> _dir, 'control_panel.tpl.php');
			$this -> set($info);
		}
		
		function UnsubscribedText(){
			$this -> setTemplate($this -> _dir, 'unsubsctibe_text.tpl.php');
			return $this -> parse();
		}
		
		function PostEdit($info){
			$this -> setTemplate($this -> _dir, 'post_edit.tpl.php');
			$this -> set($info);
		}
		
		function AjaxChangeBranch($info = array()){
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'post_tag.tpl.php');
			$response -> block('tag_list', true, $this -> parse());
		}
		
		function BlogEdit($info){
			$this -> setTemplate($this -> _dir, 'blog_edit.tpl.php');
			$this -> set($info);
		}
		
		function BranchEdit($info){
			$this -> setTemplate($this -> _dir, 'branch_edit.tpl.php');
			$this -> set($info);
		}
		
}
?>
<?php
class BlogView extends BaseSiteView{
	protected $_dir = 'blog';
	
	
		function PostList($info){
			$this -> setTemplate($this -> _dir, 'post_list.tpl.php');
			$this -> set($info);
		}
		
		function CommentList($info){
		    $this->_js_files[] = 'jquery.js';
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
		function PublicPostList() {
			$this -> setTemplate($this -> _dir, 'public_posts.tpl.php');
			//$this -> set($info);			
		}
		function PublicPopList() {
			$this -> setTemplate($this -> _dir, 'public_pop_list.tpl.php');
			//$this -> set($info);			
		}
		function PublicTopWeekList() {
			$this -> setTemplate($this -> _dir, 'public_top_week_list.tpl.php');
			//$this -> set($info);			
		}
		function PublicTagsList() {
			$this -> setTemplate($this -> _dir, 'public_tags_list.tpl.php');
			//$this -> set($info);			
		}								
		
}
?>
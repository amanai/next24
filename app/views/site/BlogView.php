<?php
class BlogView extends BaseSiteView{
	protected $_dir = 'blog';
	
	
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
		
}
?>
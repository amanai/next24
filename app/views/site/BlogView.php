<?php
class BlogView extends BaseSiteView{
	protected $_dir = 'blog';
	
	
		function PostList($info){
			$request = Project::getRequest();
			$this -> setTemplate($this -> _dir, 'post_list.tpl.php');
			$this -> set($info);
		}
		
		function ControlPanel($info = array()){
			$this -> setTemplate($this -> _dir, 'control_panel.tpl.php');
			$this -> set($info);
		}
		
}
?>
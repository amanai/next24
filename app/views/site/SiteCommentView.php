<?php
class SiteCommentView extends BaseSiteView{
	
		function CommentList($info){
			$this -> setTemplate(null, 'comment_list.tpl.php');
			$this -> set($info);
			return $this -> parse();
		}
}
?>
<?php
class SiteCommentView extends BaseSiteView{
	
		function CommentList(){
			$this -> setTemplate(null, 'comment_list.tpl.php');
			return $this -> parse();
		}
}
?>
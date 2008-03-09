<?php
class BlogSubscribeModel extends BaseModel{
			function __construct(){
				parent::__construct('blog_subscribe');
			}
			
			function isSubscribed($user_id, $tree_id){
				return (int)Project::getDatabase() -> selectCol("SELECT id FROM ".$this -> _table." WHERE user_id=?d AND ub_tree_id=?d", $user_id, $tree_id);
			}
	}
?>
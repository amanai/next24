<?php
class BlogSubscribeModelSocieties extends BaseModel{
			function __construct(){
				parent::__construct('blog_subscribe_societies');
			}
			
			function isSubscribed($user_id, $tree_id){
				return (int)Project::getDatabase() -> selectCell("SELECT id FROM ".$this -> _table." WHERE user_id=?d AND ub_tree_id=?d", $user_id, $tree_id);
			}
			
			function changeSubscribe($user_id, $tree_id){
				if (($user_id > 0) &&  ($tree_id > 0)) {
					$result = Project::getDatabase() -> selectRow("SELECT * FROM ".$this -> _table." WHERE user_id=?d AND ub_tree_id=?d ", (int)$user_id, (int)$tree_id);
					$this -> bind($result);
					
					if ((int)$this -> id > 0){
						
						Project::getDatabase() -> query("DELETE FROM ".$this -> _table." WHERE id=?d", (int)$this -> id);
					} else {
						$this -> user_id = $user_id;
						$this -> ub_tree_id = $tree_id;
						$this -> save();
					}
				}
			}
	}
?>
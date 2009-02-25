<?php
class BlogTreeModelSocieties extends BaseModel{
			
			function __construct(){
				parent::__construct('ub_tree_societies');
			}
			
			function loadByKey($key){
				$result = array();
				$result = Project::getDatabase() -> selectRow("SELECT * FROM ".$this -> _table." WHERE LOWER(key) = LOWER(?)", $key);
				$this -> bind($result);
				return $result;
			}
			
			function getBranchList($blog_id, $logged_user_id, $level = null){
				$isFriend = (int)Project::getUser() -> isFriend();
				$sql = "SELECT " .
						" ubt.*, " .
						" bs.id as subscribe_id " .
					" FROM ub_tree_societies as ubt " .
					" LEFT JOIN blog_societies b ON b.id = ubt.blog_id " .
					" LEFT JOIN blog_subscribe_societies bs ON bs.user_id=".(int)$logged_user_id." AND bs.ub_tree_id=ubt.id " .
					" WHERE " .
					" ubt.blog_id = ".(int)$blog_id." " .
					//" AND ( (b.access=".ACCESS::ALL.") OR (".$isFriend." AND ubt.access=". ACCESS::FRIEND .") OR (b.user_id=".(int)$logged_user_id." AND b.access=".ACCESS::MYSELF.") )" .
					//" AND ( (b.user_id=".$logged_user_id.") OR (ubt.access=".ACCESS::ALL.") OR (".$isFriend." AND ubt.access=".ACCESS::FRIEND.") OR (b.user_id=".$logged_user_id." AND ubt.access=".ACCESS::MYSELF.") OR (ubt.id = bs.ub_tree_id  AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" AND ((b.user_id=".$logged_user_id.") OR ( ubt.access <> ".ACCESS::MYSELF." )) " .
					(($level === null)? "": " AND ubt.level= ".(int)$level . " ") .
					" ORDER BY `key`";

				return Project::getDatabase() -> select($sql);
			}
			
			function getNode(){
				return Node::by_id($this -> id, 'ub_tree_societies');
			}
			
			
			function getParentList($blog_id, $except_id = 0){
				return Project::getDatabase() -> select("SELECT * FROM ub_tree_societies WHERE blog_id=?d AND level=1 AND id <> ?d", (int)$blog_id, (int)$except_id);
			}
			
			function loadByCatalog($catalog_id, $level = 1){
				return Project::getDatabase() -> select("SELECT * FROM ub_tree_societies WHERE blog_catalog_id=?d", (int)$catalog_id, (int)$level);
			}
			
			function loadListByParentId($id){
				$n = Node::by_id($id, 'ub_tree_societies');
				return $n -> getBranch();
			}
			
			function countSubItems($id){
				$n = Node::by_id($id, 'ub_tree_societies');
				if ($n){
					$c = $n -> countSubItems() - 1;
					return $c;
				} else {
					return 0;
				}
			}
			
	}
?>
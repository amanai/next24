<?php
class BlogTreeModel extends BaseModel{
			
			function __construct(){
				parent::__construct('ub_tree');
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
						" ubt.* " .
					" FROM ub_tree as ubt " .
					" LEFT JOIN blog b ON b.id = ubt.blog_id " .
					" LEFT JOIN blog_subscribe bs ON bs.user_id=?d AND bs.ub_tree_id=ubt.id " .
					" WHERE " .
					" ubt.blog_id = ?d " .
					" AND ( (b.access=".ACCESS::ALL.") OR (?d AND ubt.access=". ACCESS::FRIEND .") OR (b.user_id=?d AND b.access=".ACCESS::MYSELF.") )" .
					" AND ( (ubt.access=".ACCESS::ALL.") OR (?d AND ubt.access=".ACCESS::FRIEND.") OR (b.user_id=?d AND ubt.access=".ACCESS::MYSELF.") OR (b.user_id = bs.user_id AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					(($level === null)? "": " AND ubt.level= ".(int)$level . " ") .
					" ORDER BY `key`";
				return Project::getDatabase() -> select($sql, $logged_user_id, (int)$blog_id, $isFriend, $logged_user_id, $isFriend, $logged_user_id);
			}
			
			function getNode(){
				return Node::by_id($this -> id, 'ub_tree');
			}
			
			
			function getParentList($blog_id, $except_id = 0){
				return Project::getDatabase() -> select("SELECT * FROM ub_tree WHERE blog_id=?d AND level=1 AND id <> ?d", (int)$blog_id, (int)$except_id);
			}
			
			function loadByCatalog($catalog_id, $level = 1){
				return Project::getDatabase() -> select("SELECT * FROM ub_tree WHERE blog_catalog_id=?d", (int)$catalog_id, (int)$level);
			}
			
			function loadListByParentId($id){
				$n = Node::by_id($id, 'ub_tree');
				return $n -> getBranch();
			}
			
			function countSubItems($id){
				$n = Node::by_id($id, 'ub_tree');
				if ($n){
					$c = $n -> countSubItems() - 1;
					return $c;
				} else {
					return 0;
				}
			}
			
	}
?>
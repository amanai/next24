<?php
class BlogTreeModel extends BaseModel{
			
			function __construct(){
				parent::__construct('ub_tree');
			}
			
			function getBranchList($blog_id, $logged_user_id){
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
					" ORDER BY `key`";
				return Project::getDatabase() -> select($sql, $logged_user_id, (int)$blog_id, $isFriend, $logged_user_id, $isFriend, $logged_user_id);
			}
	}
?>
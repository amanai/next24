<?php
class BlogPostModelSocieties extends BaseModel{
		function __construct(){
			parent::__construct('blog_post_societies');
		}
		
		function loadList($user_id, $request_user_id, $tree_id, $is_subscribed){
			$isFriend = (int)Project::getUser() -> isFriend();
			$sql = "SELECT " .
						" blog_post_societies.*, " .
						" count(blog_comment_societies.id) as comments_count, " .
						" blog_societies.user_id as user_id," .
						" bc_tag_societies.name as tag_name, " .
						" bs.id as subscribe_id " .
					" FROM blog_post_societies " .
					" LEFT JOIN blog_comment_societies ON blog_comment_societies.blog_id = blog_post_societies.id " .
					" LEFT JOIN ub_tree_societies ubt ON ubt.id = blog_post_societies.ub_tree_id " .
					" INNER JOIN blog_societies ON blog_societies.id = ubt.blog_id  " .
					" LEFT JOIN blog_subscribe_societies bs ON bs.user_id=".(int)$user_id." AND bs.ub_tree_id=ubt.id " .
					" LEFT JOIN bc_tag_societies ON bc_tag_societies.id=blog_post_societies.bc_tag_id " .
					" WHERE " .
					//(($tree_id > 0)?"  blog_post.ub_tree_id=".(int)$tree_id." AND ":" ") .
					(($tree_id > 0)?"  blog_post_societies.ub_tree_id=".(int)$tree_id." AND ":" blog_societies.user_id = ".(int)$request_user_id." AND ") .
					//"  blog_post.ub_tree_id=".(int)$tree_id." AND " .
					//" ( (ubt.access=".ACCESS::ALL.") OR (?d AND ubt.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (blog.user_id = bs.user_id AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					//" AND ( (blog_post.access=".ACCESS::ALL.") OR (?d AND blog_post.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (?d AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" ((blog_societies.user_id=".(int)$user_id.") OR ( blog_post_societies.access <> ".ACCESS::MYSELF." )) " .
					" GROUP BY blog_post_societies.id " .
					" LIMIT ?d, ?d";

			$result = Project::getDatabase() -> selectPage($this -> _countRecords, $sql, 
																					$this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize() // limit params
																					);
			$this -> updatePagerAmount();
			return $result;
		}
		
		function getPost($post_id, $user_id, $request_user_id){
		    $isFriend = (int)Project::getUser() -> isFriend();
			$sql = "SELECT " .
						" blog_post_societies.*, " .
						" blog_societies.user_id as user_id" .
					" FROM blog_post_societies " .
					" INNER JOIN ub_tree_societies ubt ON ubt.id = blog_post_societies.ub_tree_id " .
					" INNER JOIN blog_societies ON blog_societies.id = ubt.blog_id  " .
					" LEFT JOIN blog_subscribe_societies bs ON bs.user_id=".(int)$user_id." AND bs.ub_tree_id=ubt.id " .
					" WHERE " .
					" blog_post_societies.id = ".(int)$post_id." " .
					//" ( (ubt.access=".ACCESS::ALL.") OR (?d AND ubt.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (blog.user_id = bs.user_id AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" AND ( ".
					" (blog_societies.user_id = ".(int)$user_id.") ".
					" OR (blog_post_societies.access = ".ACCESS::ALL.") ". 
					" OR (".$isFriend." AND blog_post_societies.access=".ACCESS::FRIEND.") ".
					" OR (ubt.id = bs.ub_tree_id  AND blog_post_societies.access=".ACCESS::SUBSCRIBE.") ".
					"     )";

			return Project::getDatabase() -> selectRow($sql);
		}
}
?>
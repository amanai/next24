<?php
class BlogPostModel extends BaseModel{
		function __construct(){
			parent::__construct('blog_post');
		}
		
		function loadList($user_id, $logged_user_id, $tree_id, $is_subscribed){
			$isFriend = (int)Project::getUser() -> isFriend();
			$sql = "SELECT " .
						" blog_post.*, " .
						" count(blog_comment.id) as comments_count, " .
						" blog.user_id as user_id," .
						" bc_tag.name as tag_name " .
					" FROM blog_post " .
					" LEFT JOIN blog_comment ON blog_comment.blog_id = blog_post.id " .
					" LEFT JOIN ub_tree ubt ON ubt.id = blog_post.ub_tree_id " .
					" INNER JOIN blog ON blog.id = ubt.blog_id AND blog.user_id = ?d " .
					" LEFT JOIN blog_subscribe bs ON bs.user_id=?d AND bs.ub_tree_id=ubt.id " .
					" LEFT JOIN bc_tag ON bc_tag.id=blog_post.bc_tag_id " .
					" WHERE " .
					(($tree_id > 0)?"  blog_post.ub_tree_id=".(int)$tree_id." AND ":" ") .
					" ( (ubt.access=".ACCESS::ALL.") OR (?d AND ubt.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (blog.user_id = bs.user_id AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" AND ( (blog_post.access=".ACCESS::ALL.") OR (?d AND blog_post.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (?d AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" GROUP BY blog_post.id " .
					" LIMIT ?d, ?d";
			$result = Project::getDatabase() -> selectPage($this -> _countRecords, $sql, (int)$user_id, (int)$user_id,
																					$isFriend, (int)$logged_user_id, //blog tree access
																					$isFriend, (int)$logged_user_id, (int)$is_subscribed, // post access
																					$this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize() // limit params
																					);
			$this -> updatePagerAmount();
			return $result;
		}
}
?>
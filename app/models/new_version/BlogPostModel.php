<?php
class BlogPostModel extends BaseModel{
		function __construct(){
			parent::__construct('blog_post');
		}
		
		function loadList($blog_id){
			
			$sql = "SELECT " .
						" blog_posts.*, " .
						" count(blog_comments.id) as comments_count, " .
						" blogs.user_id as user_id " .
					" FROM blog_post " .
					" LEFT JOIN blog_comment ON blog_comment.blog_post_id = blog_posts.id " .
					" LEFT JOIN blog ON blog.id = blog_post.blog_id " .
					" WHERE " .
					"  blog_posts.blog_id=?d " .
					" AND" .
					" " .
					" GROOUP BY blog_post.id ";
			$result = Project::getDatabase() -> selectPage($this -> _countRecords, $sql, $blog_id);
			$this -> updatePagerAmount();
			return $result;
		}
}
?>
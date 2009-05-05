<?php
class BlogTagModel extends BaseModel{
		function __construct(){
			parent::__construct('bc_tag');
		}
		
		
		function loadList($catalog_id, $active = false){
			$this -> checkPager();
			$result = Project::getDatabase() -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." WHERE blog_catalog_id = ?d ".(($active === true)?" AND active=1 ":""). " ORDER BY sortfield ASC LIMIT ?d, ?d ", (int)$catalog_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
		
		
		
		function exists($name){
			$sql = "SELECT * " .
					   " FROM  bc_tag " .
						" WHERE " .
						" param_group_id = ?d" .
						" AND LOWER(name) = LOWER(?)";
			$rez = Project::getDatabase() -> selectRow($sql, $name);
			if (count($rez) === 0){
				return false;
			} else {
				return $rez;
			}
		}
		public function addTags($tags) {
			//foreach ($tags as $value)
		}
		/*********************************************************/
		function getTreeNameById($tree_id) {
			$db = Project::getDatabase();
			$sql = "SELECT name FROM ub_tree WHERE id = $tree_id";
			$result = $db->selectCell($sql);
			return $result;
		}
		function loadList($user_id, $request_user_id, $tree_id, $is_subscribed){
			$isFriend = (int)Project::getUser() -> isFriend();
			$sql = "SELECT " .
						" blog_post.*, " .
						" count(blog_comment.id) as comments_count, " .
						" blog.user_id as user_id," .
						" bc_tag.name as tag_name, " .
						" bs.id as subscribe_id, " .
						" ubt.name" .
					" FROM blog_post " .
					" LEFT JOIN blog_comment ON blog_comment.blog_id = blog_post.id " .
					" LEFT JOIN ub_tree ubt ON ubt.id = blog_post.ub_tree_id " .
					" INNER JOIN blog ON blog.id = ubt.blog_id  " .
					" LEFT JOIN blog_subscribe bs ON bs.user_id=".(int)$user_id." AND bs.ub_tree_id=ubt.id " .
					" LEFT JOIN bc_tag ON bc_tag.id=blog_post.bc_tag_id " .
					" WHERE " .
					//(($tree_id > 0)?"  blog_post.ub_tree_id=".(int)$tree_id." AND ":" ") .
					(($tree_id > 0)?"  blog_post.ub_tree_id=".(int)$tree_id." AND ":" blog.user_id = ".(int)$request_user_id." AND ") .
					//"  blog_post.ub_tree_id=".(int)$tree_id." AND " .
					//" ( (ubt.access=".ACCESS::ALL.") OR (?d AND ubt.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (blog.user_id = bs.user_id AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					//" AND ( (blog_post.access=".ACCESS::ALL.") OR (?d AND blog_post.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (?d AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" ((blog.user_id=".(int)$user_id.") OR ( blog_post.access <> ".ACCESS::MYSELF." )) " .
					" GROUP BY blog_post.id " .
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
						" blog_post.*, " .
						" blog.user_id as user_id" .
					" FROM blog_post " .
					" INNER JOIN ub_tree ubt ON ubt.id = blog_post.ub_tree_id " .
					" INNER JOIN blog ON blog.id = ubt.blog_id  " .
					" LEFT JOIN blog_subscribe bs ON bs.user_id=".(int)$user_id." AND bs.ub_tree_id=ubt.id " .
					" WHERE " .
					" blog_post.id = ".(int)$post_id." " .
					//" ( (ubt.access=".ACCESS::ALL.") OR (?d AND ubt.access=".ACCESS::FRIEND.") OR (blog.user_id=?d) OR (blog.user_id = bs.user_id AND ubt.access=".ACCESS::SUBSCRIBE.") )" .
					" AND ( ".
					" (blog.user_id = ".(int)$user_id.") ".
					" OR (blog_post.access = ".ACCESS::ALL.") ". 
					" OR (".$isFriend." AND blog_post.access=".ACCESS::FRIEND.") ".
					" OR (ubt.id = bs.ub_tree_id  AND blog_post.access=".ACCESS::SUBSCRIBE.") ".
					"     )";

			return Project::getDatabase() -> selectRow($sql);
		}
		function loadByUserId($user_id){
			$result = Project::getDatabase() -> selectRow("SELECT * FROM blog_societies WHERE user_id = ?d LIMIT 1", $user_id);
			$this -> bind($result);
			return $result;
		}
		
		function deletePostsByUb_tree_id($ub_tree_id){
		    $sql ="
		      DELETE FROM `blog_banners_societies`
		      WHERE ub_tree_id = '".$ub_tree_id."'
		    ";
		    Project::getDatabase() -> query($sql);
		}
		
		
		
		/* blog_banner */
		
		function getBlogBannerById($id){
		    $sql ="
		      SELECT * FROM `blog_banners_societies`
		      WHERE id = '".$id."'
		    ";
		    return Project::getDatabase() -> selectRow($sql);		    
		}
		
		function changeBlogBanner($id, $code){
		    $sql ="
		      UPDATE `blog_banners_societies` SET code = '".stripslashes($code)."'
		      WHERE id = '".$id."'
		    ";
		    Project::getDatabase() -> query($sql);		    
		}
		
		function addBlogBanner($code){
		    $sql ="
		      INSERT INTO `blog_banners_societies` (code)
		      VALUES ('".stripslashes($code)."')
		    ";
		    Project::getDatabase() -> query($sql);	
		    return mysql_insert_id();	    
		}
						
	}
?>
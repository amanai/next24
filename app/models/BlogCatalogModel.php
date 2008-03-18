<?php
class BlogCatalogModel extends BaseModel{
			function __construct(){
				parent::__construct('blog_catalog');
			}
			
			function loadSubscribedPage($user_id){
				$sql = "SELECT " .
							" bc.* " .
						" FROM blog_catalog bc " .
						" INNER JOIN ub_tree ubt ON ubt.blog_catalog_id=bc.id " .
						" INNER JOIN blog_subscribe bs ON bs.ub_tree_id= ubt.id AND bs.user_id = ?d " .
						" GROUP BY bc.id ";
				return Project::getDatabase() -> select($sql, $user_id);//, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize()
			}
			
			function loadAll(){
				$sql = "SELECT " .
							" bc.*," .
							" count(bs.id) as count_subitems " .
						" FROM blog_catalog bc " .
						" LEFT JOIN ub_tree ubt ON ubt.blog_catalog_id=bc.id " .
						" LEFT JOIN blog_subscribe bs ON bs.ub_tree_id= ubt.id " .
						" GROUP BY bc.id ";
				return Project::getDatabase() -> select($sql);
			}
	}
?>
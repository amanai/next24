<?php
class BlogCatalogModelSocieties extends BaseModel{
			function __construct(){
				parent::__construct('blog_catalog_societies');
			}
			
			function loadSubscribedPage($user_id){
				$sql = "SELECT " .
							" bc.*," .
							" count(bs.id) as count_subitems " .
						" FROM blog_catalog_societies bc " .
						" INNER JOIN ub_tree_societies ubt ON ubt.blog_catalog_id=bc.id " .
						" INNER JOIN blog_subscribe_societies bs ON bs.ub_tree_id= ubt.id AND bs.user_id = ?d " .
						" GROUP BY bc.id ";
				return Project::getDatabase() -> select($sql, $user_id);//, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize()
			}
			
			function loadAll(){
				$sql = "SELECT " .
							" bc.*," .
							" count(bs.id) as count_subitems " .
						" FROM blog_catalog_societies bc " .
						" LEFT JOIN ub_tree_societies ubt ON ubt.blog_catalog_id=bc.id " .
						" LEFT JOIN blog_subscribe_societies bs ON bs.ub_tree_id= ubt.id " .
						" GROUP BY bc.id ";
				return Project::getDatabase() -> select($sql);
			}
	}
?>
<?php
class BlogCatalogModel extends BaseModel{
			function __construct(){
				parent::__construct('blog_catalog');
			}
			
			function loadSubscribedPage($user_id){
				$this -> checkPager();
				$sql = "SELECT " .
							" bc.* " .
						" FROM blog_catalog bc " .
						" INNER JOIN ub_tree ubt ON ubt.blog_catalog_id=bc.id " .
						" INNER JOIN blog_subscribe bs ON bs.ub_tree_id= ubt.id AND bs.user_id = ?d " .
						" GROUP BY bc.id " .
						" LIMIT ?d, ?d ";
				$result = Project::getDatabase() -> selectPage($this -> _countRecords, $sql, $user_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
				
				$this -> updatePagerAmount();
				return $result;
			}
	}
?>
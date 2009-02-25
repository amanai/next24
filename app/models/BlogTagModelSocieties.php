<?php
class BlogTagModelSocieties extends BaseModel{
		function __construct(){
			parent::__construct('bc_tag_societies');
		}
		
		
		function loadList($catalog_id, $active = false){
			$this -> checkPager();
			$result = Project::getDatabase() -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." WHERE blog_catalog_id = ?d ".(($active === true)?" AND active=1 ":""). " ORDER BY sortfield ASC LIMIT ?d, ?d ", (int)$catalog_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
		
		
		
		function exists($name){
			$sql = "SELECT * " .
					   " FROM  bc_tag_societies " .
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
	}
?>
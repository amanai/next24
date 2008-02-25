<?php
class AlbumModel extends BaseModel{
		function __construct(){
			parent::__construct('album');
		}
		
		function loadAll($access = true, $on_main = true, $sortName = 'a.creation_date', $sortOrder = 'DESC', $defaultSortName = "a.id"){
			if (is_null($sortName)){
				$sortName = $defaultSortName;
			}
			$DE = Project::getDatabase();
			$this -> checkPager();
			$sortOrder = $this -> getSortDirection($sortOrder);
			if ($access === true){
				$a = "a.access > 0";
			} else {
				$a = 1;
			}
			if ($on_main === true){
				$om = "a.is_onmain = 1";
			} else {
				$om = 1;
			}
			$sql = "SELECT " .
						"a.id as id," .
						"a.name as name," .
						"a.creation_date as creation_date," .
						"u.login as login," .
						"p.thumbnail as thumbnail," .
						"IF (rate.voices > 0, rate.rating/rate.voices, 0) as album_rating " .
					" FROM album as a " .
					" LEFT JOIN users u ON u.id=a.user_id " .
					" LEFT JOIN photo p ON p.id=a.thumbnail_id AND p.album_id=a.id " .
					" LEFT JOIN photo rate ON rate.album_id = a.id AND rate.is_rating > 0 " .
					" WHERE " .
					" " . $a . " " .
					" AND " . $om . " " .
					" GROUP BY id ".
					" ORDER BY $sortName $sortOrder  LIMIT ?d, ?d ";
			$result = $DE -> selectPage($this -> _countRecords, $sql, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
}
?>
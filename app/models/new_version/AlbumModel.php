<?php
class AlbumModel extends BaseModel{
		function __construct(){
			parent::__construct('album');
		}
		
		
		
		function loadByUser($userid, $logged_user_id){
			$sql = "SELECT " .
						"a.id as id," .
						"a.name as name," .
						"a.creation_date as creation_date," .
						"u.login as login," .
						"p.thumbnail as thumbnail," .
						"IF (rate.voices > 0, rate.rating/rate.voices, 0) as album_rating," .
						"a.user_id as user_id " .
					" FROM album as a " .
					" LEFT JOIN users u ON u.id=a.user_id " .
					" LEFT JOIN photo p ON p.id=a.thumbnail_id AND p.album_id=a.id " .
					" LEFT JOIN photo rate ON rate.album_id = a.id AND rate.is_rating > 0 " .
					" WHERE " .
					" a.user_id = ?d " .
					" AND ( (a.access=".ACCESS::ALL.") OR (?d AND a.access=".ACCESS::FRIEND.") OR (a.user_id=?d AND a.access=".ACCESS::MYSELF.") )" .
					" GROUP BY id ";
			return Project::getDatabase() -> select($sql, (int)$userid, (int)Project::getUser() -> isFriend(), $logged_user_id);
		}
		
		function loadAll($userid, $logged_user_id, $sortName = 'a.creation_date', $sortOrder = 'DESC', $defaultSortName = "a.id"){
			$userid = (int)$userid;
			if (is_null($sortName)){
				$sortName = $defaultSortName;
			}
			$DE = Project::getDatabase();
			$this -> checkPager();
			$sortOrder = $this -> getSortDirection($sortOrder);
			if ($userid > 0){
				$om = 1;
			} else {
				$om = "a.is_onmain = 1";
			}
			if ($userid > 0){
				$u = "a.user_id = " . $userid;
			} else {
				$u = 1;
			}
			$sql = "SELECT " .
						"a.id as id," .
						"a.name as name," .
						"a.creation_date as creation_date," .
						"u.login as login," .
						"p.thumbnail as thumbnail," .
						"IF (rate.voices > 0, rate.rating/rate.voices, 0) as album_rating," .
						"a.user_id as user_id," .
						"a.access as access," .
						"a.is_onmain as is_onmain " .
					" FROM album as a " .
					" LEFT JOIN users u ON u.id=a.user_id " .
					" LEFT JOIN photo p ON p.id=a.thumbnail_id AND p.album_id=a.id " .
					" LEFT JOIN photo rate ON rate.album_id = a.id AND rate.is_rating > 0 " .
					" WHERE " .
					" " . $om . " " .
					" AND " . $u . " " .
					" AND ( (a.access=".ACCESS::ALL.") OR (?d AND a.access=".ACCESS::FRIEND.") OR (a.user_id=?d AND a.access=".ACCESS::MYSELF.") )" .
					" GROUP BY id ".
					" ORDER BY $sortName $sortOrder  LIMIT ?d, ?d ";
			$result = $DE -> selectPage($this -> _countRecords, $sql, (int)Project::getUser() -> isFriend(), $logged_user_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
}
?>
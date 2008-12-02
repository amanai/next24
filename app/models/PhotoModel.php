<?php
class PhotoModel extends BaseModel{
		function __construct(){
			parent::__construct('photo');
		}
		
		function loadByAlbumUser($user_id, $album_id, $sortName = 'creation_date', $sortOrder = 'DESC', $defaultSortName = 'id'){
			if (is_null($sortName)){
				$sortName = $defaultSortName;
			}
			$user_id = (int)$user_id;
			$album_id = (int)$album_id;
			$is_friend = (int)Project::getUser() -> isFriend();
			$logged_user_id = (int)Project::getUser() -> getDbUser() -> id;
			if (!is_array($this -> filter) || !count($this -> filter)){
				$filter = false;
			} else {
				$filter = $this -> filter;
			}
			$this -> filter = null;
			$sql = "SELECT " .
						"p.id as id," .
						"p.name as name," .
						"p.creation_date as creation_date," .
						"p.path as path," .
						"p.thumbnail as thumbnail," .
						"p.is_rating as is_rating," .
						"p.is_onmain as is_onmain," .
						"p.access as access," .
						"IF (p.voices > 0, p.rating/p.voices, 0) as photo_rating," .
						"u.login as login " .
					" FROM photo as p " .
					" INNER JOIN album a ON a.id=p.album_id " .
					" INNER JOIN users u ON u.id=p.user_id " .
					" WHERE " .
					" p.user_id = ?d " .
					" AND p.album_id = ?d " .
					(($filter !== false) ? " AND p.id IN (".implode(',', $filter).")":"" ). 
					" AND ( (a.access=".ACCESS::ALL.") OR (?d AND a.access=".ACCESS::FRIEND.") OR (a.user_id=?d AND a.access=".ACCESS::MYSELF.") )" .
					" AND ( (p.access=".ACCESS::ALL.") OR (?d AND p.access=".ACCESS::FRIEND.") OR (p.user_id=?d AND p.access=".ACCESS::MYSELF.") )" .
					" GROUP BY id ".
					" ORDER BY $sortName $sortOrder  LIMIT ?d, ?d ";
			$DE = Project::getDatabase();
			$this -> checkPager();
			$result = $DE -> selectPage($this -> _countRecords, $sql, $user_id, $album_id, $is_friend, $logged_user_id, $is_friend, $logged_user_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			
			$this -> updatePagerAmount();
			return $result;
		}
		
		function loadByAlbum($album_id){
			return Project::getDatabase() -> select("SELECT * FROM photo WHERE album_id=?d ", (int)$album_id);
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
			$is_friend = (int)Project::getUser() -> isFriend();
			$sql = "SELECT " .
						"p.id as id," .
						"p.thumbnail as thumbnail," .
						"p.album_id as album_id," .
						"p.name as name," .
						"p.creation_date as creation_date," .
						"u.login as login," .
						"a.name as album_name, " .
						"p.user_id as user_id " .
					" FROM photo as p " .
					" LEFT JOIN album a ON a.id=p.album_id " .
					" LEFT JOIN users u ON u.id=p.user_id " .
					" WHERE " .
					" " . $om . " " .
					" AND " . $u . " " .
					" AND ( (a.access=".ACCESS::ALL.") OR (?d AND a.access=".ACCESS::FRIEND.") OR (a.user_id=?d AND a.access=".ACCESS::MYSELF.") )" .
					" AND ( (p.access=".ACCESS::ALL.") OR (?d AND p.access=".ACCESS::FRIEND.") OR (p.user_id=?d AND p.access=".ACCESS::MYSELF.") )" .
					" GROUP BY id ".
					" ORDER BY $sortName $sortOrder  LIMIT ?d, ?d ";
			$result = $DE -> selectPage($this -> _countRecords, $sql, $is_friend, $logged_user_id, $is_friend, $logged_user_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			
			$this -> updatePagerAmount();
			return $result;
		}
		
		function delete($id){
			parent::delete($id);
			$comment_model = new PhotoCommentModel;
			$comment_model -> deleteAllByItem($id);
		}
		/*
		function load($id){
			$id = (int)$id;
			
			if ($this -> _load_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$result = $cache -> get($this -> getCachePrefix('_' . $id));
					if (is_array($result)){
						$this -> bind($result);
						return $result;
					}
				}
			}
			$DE = Project::getDatabase(); // Get DB driver
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE id = ?d", $id); // Load 1 row
			$this -> bind($result); // Bind to internal variables at class
			if ($this -> _load_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$cache -> set($this -> getCachePrefix('_' . $id), $result);
				}
			}
			return $result;
		}
		*/
}
?>
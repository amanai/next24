<?php
class UserRightModel extends BaseModel{
	
		function __construct(){
			parent::__construct('user_right');
			$this -> _caches(true, true, true);
		}
		
		function loadByUserType($user_type_id){
			if ($this -> _load_all_cahce === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$list = $cache -> get($this -> getCachePrefix('_list_user_type_'.$user_type_id));
					if (is_array($list)){
						return $list;
					}
				}
			}
			$result = Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE user_type_id=?d", (int)$user_type_id);
			if ($this -> _load_all_cahce === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$cache -> set($this -> getCachePrefix('_list_user_type_'.$user_type_id), $result);
				}
			}
			return $result;
		}
		
		function loadControllersByUserType($user_type_id){
			if ($this -> _load_all_cahce === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$list = $cache -> get($this -> getCachePrefix('_list_controller_user_type_' . $user_type_id));
					if (is_array($list)){
						return $list;
					}
				}
			}
			$DE = Project::getDatabase();
			$sql = "SELECT " .
										" ur.id as id, " .
										" ur.controller_id as controller_id, " .
										" CAST(ur.access AS UNSIGNED) as access, " .
										" c.name as name " .
								" FROM ".$this -> _table." as ur " .
								" INNER JOIN controller c ON c.id = ur.controller_id " .
								" WHERE " .
									" ur.user_type_id=?d " .
									" GROUP BY ur.controller_id";
			$result = $DE -> select($sql, (int)$user_type_id);
			if ($this -> _load_all_cahce === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$cache -> set($this -> getCachePrefix('_list_controller_user_type_' . $user_type_id), $result);
				}
			}
			return $result;
		}
		
		function loadByTypeControllerAction($user_type_id, $controller_id, $action_id){
			if ($this -> _load_all_cahce === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$list = $cache -> get($this -> getCachePrefix('_list_controller_action_user_type_'.$user_type_id.$controller_id.$action_id));
					if (is_array($list)){
						return $list;
					}
				}
			}
			$DE = Project::getDatabase();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE user_type_id = ?d AND controller_id=?d AND action_id = ?d", (int)$user_type_id, (int)$controller_id, (int)$action_id);
			$this -> bind($result);
			if ($this -> _load_all_cahce === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$cache -> set($this -> getCachePrefix('_list_controller_action_user_type_'.$user_type_id.$controller_id.$action_id), $result);
				}
			}
			return $result;
		}
		
		function save(){
			parent::save();
			$cache = Project::getDatabaseManager() -> getCache();
			if ($cache !== null){
				$cache -> delete($this -> getCachePrefix('_list_user_type_'.$this -> user_type_id));
				$cache -> delete($this -> getCachePrefix('_list_controller_user_type_'.$this -> user_type_id));
				$cache -> delete($this -> getCachePrefix('_list_controller_action_user_type_'.$this -> user_type_id.$this -> controller_id.$this->action_id));
			}
		}
}
?>
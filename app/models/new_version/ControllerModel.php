<?php
class ControllerModel extends BaseModel{
		function __construct(){
			parent::__construct('controller');
			$this -> _caches(true, true, true);
		}
		
		function loadByKey($key){
			$cache = Project::getDatabaseManager() -> getCache();
			if ($cache !== null){
				$result = $cache -> get($this -> getCachePrefix('_controller_by_key_'.$key));
				if ($result !== null){
					$this -> bind($result);
					return $result;
				}
			}
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE LOWER(request_key)=LOWER(?) LIMIT 1", $key);
			$this -> bind($result);
			if ($cache !== null){
				$cache -> set($this -> getCachePrefix('_controller_by_key_'.$key), $result);
			}
			return $result;
		}
		
		function loadDefault($admin = true){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE `default`=1 AND admin=?d LIMIT 1", $admin);
			$this -> bind($result);
			return $result;
		}
}
?>
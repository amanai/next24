<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'key.class.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'basic_node.class.php');
class Node extends BasicNode{
	// factory
		static function by_id($id, $tablename){
			$id = (int) $id;
			$r = Project::getDatabase() -> selectRow(
				" select
					*
				from
					$tablename
				where
					id = $id
				"
			);
			if ($r && isset($r['key'])){
				return new Node(new Key($r['key']), $tablename);
			}else{
				return false;
			}
		}
		static function by_key($key, $tablename){
			if ($key instanceof Key){
				return new Node($key, $tablename);
			}else{
				return new Node(new Key($key) ,$tablename);
			}
		}
		
		
	//methods
		function getBranch($field = null, $value = null){
			$sql = " select *
				from
					{$this->tablename}
				where
					`key` like '{$this->key}%' 
				order by
					`key`
				";
			//echo $sql;
			return Project::getDatabase() -> select($sql);
		}
		
		function countSubItems(){
			$sql = " select " .
					" count(id) as counter " .
				" from {$this->tablename} " .
				" where " .
				" `key` like '{$this->key}%' LIMIT 1";
			$counter = Project::getDatabase() -> selectCell($sql);
			return (int)$counter;
		}
}
?>
<?php
class StateModel extends BaseModel{
		function __construct(){
			parent::__construct('regions');
		}
		
		function loadAll(){
			return parent::loadAll('name');
		}
		
		function loadByCountry($country_id){
			return Project::getDatabase() -> select("SELECT * FROM ".$this -> _table." WHERE country_id=?d ORDER BY name", (int)$country_id);
		}
		function getStateNameById($id) {
			return Project::getDatabase() -> selectCell("SELECT name FROM ".$this -> _table." WHERE id=?d ORDER BY name", (int)$id);
		}
			function getFirstChildKey(){
				$child_level = $this->key->level + 1;
				$r = Project::getDatabase() -> selectRow(
					"select
						`key` as mk
					from
						{$this->tablename}
					where
						level = $child_level
						and 
						`key` like '{$this->key}%'
					order by 
						`key`
					limit 1
					"
				);
				if ($r){
					return new Key($r['mk']);
				}else{
					return null;
				}
			}
			function getLastChildKey(){
				$child_level = $this->key->level + 1;
				$r = Project::getDatabase() -> selectRow(
					"select
						`key` as mk
					from
						{$this->tablename}
					where
						level = $child_level
						and 
						`key` like '{$this->key}%'
					order by
						`key` desc
					limit 1
					"
				);
				if ($r){
					return new Key($r['mk']);
				}else{
					return null;
				}
			}
			
			function getNewChildKey($k = false){
				if (!$k){
					$k = $this->getLastChildKey();
				}
				if ($k){
					$k[$k->level -1] += 1;
				}else {
					$k = $this->key;
					$k[$k->level] = 1;
				}
				return $k;
			}
		// moving 
				
			function moveTo(Key $new_key){
				$level_diff = $new_key->level - $this->key->level;
				Project::getDatabase() -> query(
					" update
						{$this->tablename}
					set
						`key` = CONCAT('$new_key', TRIM( LEADING '{$this->key}' FROM `key`))
						, level = level + $level_diff
					where
						`key` like '{$this->key}%'
						and
						level >= {$this->key->level}
					"
				);
				$this->key = $new_key;
			}				
			function changeParent(BasicNode $new_parent){
				$new_key = $new_parent->getNewChildKey();
				$this->moveTo($new_key);
			}
			function moveUp(){
				$parent_key = $this->key->getParent();
				$r = Project::getDatabase() -> selectRow(
					" select
						`key`
					from
						{$this->tablename}
					where
						`key` < '{$this->key}'
						and `key` like '{$parent_key}%'
						and level = {$this->key->level}
					order by
						`key` desc
					limit 1
					"
				);
				if (!$r){
					return false;
				}
				$dst_key = new Key($r['key']);
				$dst_node = new self($dst_key, $this->tablename);
				$parent_node = new self($parent_key, $this->tablename);
				$tmp_key = $parent_node->getNewChildKey();
				$src_key = $this->key;
				// src -> tmp
				$this->moveTo($tmp_key);
				// dst -> src
				$dst_node->moveTo($src_key);
				// tmp -> dst
				$this->moveTo($dst_key);						
			}
			function moveDown(){
				$parent_key = $this->key->getParent();
				$r = Project::getDatabase() -> selectRow(
					" select
						`key`
					from
						{$this->tablename}
					where
						`key` > '{$this->key}'
						and `key` like '{$parent_key}%'
						and level = {$this->key->level}
					order by
						`key`
					limit 1
					"
				);
				if (!$r){
					return false;
				}
				$dst_key = new Key($r['key']);
				$dst_node = new self($dst_key, $this->tablename);
				$parent_node = new self($parent_key, $this->tablename);
				$tmp_key = $parent_node->getNewChildKey();
				$src_key = $this->key;
				// src -> tmp
				$this->moveTo($tmp_key);
				// dst -> src
				$dst_node->moveTo($src_key);
				// tmp -> dst
				$this->moveTo($dst_key);	
			}

		// deleteing
			function delete(){
				Project::getDatabase() -> query(
					"delete
					from
						{$this->tablename}
					where
						`key` like '{$this->key}%'
						and
						level >= {$this->key->level}
					"
				);				
			}		
}
?>
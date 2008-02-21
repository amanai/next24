<?php
class SQLiteCache extends BaseCache implements ICache, IManager{
	private $_cache_table;
		
		public function initialize(IConfigParameter $configuration){
			if(!extension_loaded('sqlite_open')){
				throw new SoftwareSupportException('SQL extension not loaded');
			}
			if($this -> _file===null){
				// TODO:: need getting directory to storing file and check permissions
				$this -> _file= 'sqlite.cache';
			}
			$error = '';
			if(($this -> _db = new SQLiteDatabase($this -> _file, 0666, $error)) === false){
				throw new CacheException('Error connection to sqlite server', $error);
			}
			if(@$this -> _db -> query('DELETE FROM '.$this -> _cache_table.' WHERE expire<>0 AND expire<'.time()) === false){
				if( $this-> _db -> query('CREATE TABLE '.$this -> _cache_table.' (key CHAR(128) PRIMARY KEY, value BLOB, expire INT)')===false)
					throw new CacheException('Errir creation sqlite table', sqlite_error_string(sqlite_last_error()));
			}
			$this->_initialized=true;
			parent::initialize($configuration);
			Project::getCacheManager() -> set($configuration -> get('id'), $this);
		}
	
		public function add($key, $value, $ttl = 0){
			$sql='INSERT INTO '.$this -> _cache_table.' VALUES(\''.$key.'\',\''.sqlite_escape_string($value).'\','.$ttl.')';
			return @$this->_db->query($sql)!==false;
		}
		
		public function set($key, $value, $ttl = 0){
			$sql='REPLACE INTO '.$this -> _cache_table.' VALUES(\''.$key.'\',\''.sqlite_escape_string($value).'\','.$ttl.')';
			return $this->_db->query($sql)!==false;
		}
		
	    public function get($key, $default = null){
	    	$sql='SELECT value FROM '.$this -> _cache_table.' WHERE key=\''.$key.'\' AND (expire=0 OR expire>'.time().') LIMIT 1';
			if(($ret=$this->_db->query($sql))!=false && ($row=$ret->fetch(SQLITE_ASSOC))!==false)
				return $row['value'];
			else
				return $default;
	    }
	    public function delete($key){
	    	return $this->_db->query('DELETE FROM '.$this -> _cache_table)!==false;
	    }
}
?>
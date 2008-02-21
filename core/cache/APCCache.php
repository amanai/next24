<?php
class APCCache extends BaseCache implements ICache, IManager{
	
		
		public function initialize(IConfigParameter $configuration){
			if (!extension_loaded('apc')){
				throw new SoftwareSupportException("APC extension not loaded");
			}
			if ($configuration -> get('id') === null){
				throw new CacheException("Cache module must have id");
			}
			// Need checking for necessary cache id
			Project::getCacheManager() -> set($configuration -> get('id'), $this);
			parent::initialize($configuration);
		}
		
		public function add($key, $value, $ttl = false){
			return $this -> set($key, $value, $ttl);
		}
	
		public function set($key, $value, $ttl = false){
			return apc_store($key, $value, $ttl);
		}
	    public function get($key, $default = null){
	    	$value = apc_fetch($key);
	    	return ($value === false) ? $default : $value;
	    }
	    public function delete($key){
	    	return apc_delete($key);
	    }
	    
	    public function clear(){
	    	return apc_clear_cache();
	    }
}
?>
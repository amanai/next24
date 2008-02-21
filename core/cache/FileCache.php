<?php
require_once(FRAMEWORK_CLASSES. 'Caches' . DIRECTORY_SEPARATOR . 'Cache_Lite.php');
class FileCache extends BaseCache implements ICache{
	
	private $_engine;
	
		public function initialize(IConfigParameter $configuration){
			parent::initialize($configuration);
			$engine = new Cache_Lite;
			if (!$configuration -> get('directory')){
				throw new CacheException('FileCache: cache directory not specified');
			}
			$engine -> _cacheDir = Project::NS() -> path($configuration -> get('directory'));
			if ($configuration -> get('file_name')){
				$engine -> _fileName = $configuration -> get('file_name');
			} else {
				$engine -> _fileName = "file.cache";
			}
			$this -> _engine = $engine;
			Project::getCacheManager() -> set($configuration -> get('id'), $this);
		}
	
		public function add($key, $value, $ttl = 0){
			return $this -> set($key, $value, $ttl = 0);
		}
		
		public function set($key, $value, $ttl = 0){
			return $this -> _engine -> save($value, $key);
		}
		
	    public function get($key, $default = null){
	    	$value = $this-> _engine -> get($key);
	    	return ($value === false) ? $default : $value;
	    }
	    public function delete($key){
	    	return $this-> _engine -> remove($key);
	    }
	    
	    public function clean(){
	    	return $this -> clean();
	    }
}
?>
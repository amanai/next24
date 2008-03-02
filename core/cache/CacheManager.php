<?php

/**
 * 
 */
class CacheManager extends ApplicationManager implements IManager{
	
		private $_caches;
		
			function initialize(IConfigParameter $configuration){
				Project::setCacheManager($this);
				$this -> _common_config($configuration);
			}
			
			function set($key, ICache $cache){
				$this -> _caches[$key] = $cache;
			}
			
			function get($key){
				return isset($this -> _caches[$key])?$this -> _caches[$key]:null;
			}
}
?>
<?php
class DatabaseManager extends ApplicationManager implements IManager{
	
	private $_driver;
	
	private $_DSN;
	
	private $_caching = false;
	private $_cache_prefix = '__db__';
	private $_cache_module_id = null;
	
			function initialize(IConfigParameter $configuration){
				$dsn = $configuration -> get('DSN');
				if (!$dsn){
					$connection_file = $configuration -> get('connection_file');
					if (!$connection_file){
						throw new DbException("Connection file not defined");
					}
					$p = pathinfo($connection_file);
					$dir = Project::NS() -> path($p['dirname']);
					$f = $dir . $p['basename'];
					if (!file_exists($f) || !is_file($f)){
						throw new DbException("Connection file not exists");
					}
					$config = new ConfigParameter(file_get_contents($f));
					$dsn = $config -> get('DSN');
					if (!$dsn){
						throw new DbException("DSN not exitsts at connection file");
					}
				}
				
				$this -> _caching = $configuration -> get('caching');
				if ($configuration -> get('cache_prefix')){
					$this -> _cache_prefix = $configuration -> get('cache_prefix');
				}
				
				if ($configuration -> get('cache_module_id')){
					$this -> _cache_module_id = $configuration -> get('cache_module_id');
				} else {
					// No cache module defined
					// TODO:: write NOTICE to log
					$this -> _caching = false;
				}
				
				
				$this -> _DSN = $dsn;
				$this -> _common_config($configuration);
				$this -> _driver = DbSimple_Generic::connect($this -> _DSN);
				if (!is_object($this -> _driver)){
					throw new DbException("No connection to database");
				}
				$this -> _driver -> query("SET NAMES utf8");
				$this -> _driver -> setLogger($configuration -> get('native_logger'));
				//$this -> _driver -> setLogger('myLogger');
				Project::setDatabase($this);
				
			}
			
			function hasCache(){
				return $this -> _caching;
			}
			
			function cachePrefix(){
				return $this -> _cache_prefix;
			}
			
			function getCache(){
				if ($this -> hasCache()){
					return Project::getCacheManager() -> get($this -> _cache_module_id);
				} else {
					return null;
				}
			}
			
			function getDriver(){
				return $this -> _driver;
			}
			
}

// TODO:: move to another functions?
function myLogger($db, $sql){
  $caller = $db->findLibraryCaller();
  $tip = "at ".@$caller['file'].' line '.@$caller['line'];
  // Печатаем запрос (конечно, Debug_HackerConsole лучше)
  //echo '<br>'.HelpFunctions::backtrace();
  echo "<xmp title=\"$tip\">"; print_r($sql); echo "</xmp>";
  $GLOBALS['query_counter']++;
  //echo '~~~'.print_r($sql).'~~~';
  if ( ($logger = Project::get("logger")) !== null){
		//$logger -> writeLog($tip."::".$sql);
  }
}
?>

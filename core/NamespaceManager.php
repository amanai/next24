<?php
class NamespaceManager extends ApplicationManager implements IManager{

	private $_script_dir;
	
			function initialize(IConfigParameter $configuration){
				$this -> _script_dir = dirname($_SERVER['SCRIPT_FILENAME']);
				// TODO:: need aliases from configuration
				Project::setNS($this);
				// last parameter true for skiping pathes
				$this -> _common_config($configuration);
			}
			
			function setPathes(IConfigParameter $configuration){
				$pc = $configuration -> get('include_path');
				$version = $configuration -> get('version');
				$pathes = explode(';', $pc);
				foreach($pathes as $path){
					$path = trim($path);
					if (is_string($path) && (strlen($path) > 0)){
						$this -> path($path, $version);
					}
					
				}
			}
			
			
			function path($path, $version = null, $set_include_path = true){
				// TODO:: caching by key md5(path)
				if (!is_string($path)){
					throw new InvalidValueException("Path can have STRING type: ".$path);
				}
				$path = trim($path);
				if (mb_substr($path, -1) == "/"){
					$path = mb_substr($path, 0, -1);
				}
				$path = str_replace('\\', '/', $path);
				if(preg_match('/^\\/|.:\\/|.:\\\\/',$path)){	// if absolute path
					$p = realpath($path);
				}
				else {
					$count = mb_substr_count($path, '..');
					$root = explode('/', $this -> _script_dir);
					for ($i = 0; $i < $count - 1; $i++){
						array_pop($root);
					}
					$new_script_dir = implode('/', $root);
					$last_dots = mb_strrpos($path, '..');
					$dir = $path;
					if ($last_dots !== false){
						$dir = mb_substr($path, $last_dots + 3 );
					}
					if ($version !== null){
						$dir .= DIRECTORY_SEPARATOR . $version;
					}
					$p=realpath($new_script_dir . DIRECTORY_SEPARATOR . $dir);
				}
				if ($p !== false){
					$p .= DIRECTORY_SEPARATOR;
				}
				if (($p == false) || !file_exists($p) || !is_dir($p)){
					throw new InvalidValueException("Invalid path: ".$path);
				}
				if ($set_include_path === true){
					set_include_path(get_include_path() . PATH_SEPARATOR . $p);
				}
				return $p;
			}
			
			function saveState(){
				if ($this -> _config -> get('state', false) === true){
					// Save state of debugger
				}
			}
			
			function restoreState(){
				if ($this -> _config -> get('state', false) === true){
					// Try to restore previous state of debugger
				}

			}
			
			// For this class have no sense, because it's debugger
			function debug($msg){
				return null;
			}
}
?>
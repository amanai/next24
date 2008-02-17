<?php
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'interfaces' . DIRECTORY_SEPARATOR . 'IManager.php');
abstract class ApplicationManager{
	protected $_debugger = null;
	protected $_config = null;
	protected $_initialized = false;
	protected $_app_cache_id;
	protected $_app_cache_key;
	
		protected function _common_config(IConfigParameter $configuration, $skip_pathes = false){
			$this -> _config = $configuration;
			$this -> _app_cache_id = $this -> _config -> get('cache_id');
			$this -> _app_cache_key = $this -> _config -> get('cache_key');
			$this -> _initialized = true;
			if ($skip_pathes === false){
				Project::NS() -> setPathes($configuration);
			}
		}

		public function setDebugger(IApplicationDebugger $d){
			$this -> _debugger = $d;
		}	
	
		public function getDebugger(){
			return $this -> _debugger;
		}
		
		public function hasDebugger(){
			if ($this -> _debugger instanceof IApplicationDebugger){
				return true;
			} else {
				return false;
			}
		}
}
?>

<?php
spl_autoload_register(array('Project','autoload'));
/**
 * Project class is registry and has base functions suah as _autoload etc.
 */
class Project{
	public $_stack;
 
	    function __construct() {
	        $this -> _stack = array(array());
	    }
	    
	    function getVersion(){
	    	return '0.1';
	    }
	    
	    function set($key, &$item) {
	    	$instance = Project::instance();
	        $instance -> _stack[0][$key] = &$item;
	    }
	    function &get($key) {
	    	$instance = Project::instance();
	    	if (isset($instance -> _stack[0][$key])){
	    		$ret = $instance -> _stack[0][$key];
	    	} else {
	    		$ret = null;
	    	}
	    	return $ret;
	    }
	    function exists($key) {
	    	$instance = Project::instance();
	        return ($instance -> get($key) !== null);
	    }
	    function &instance() {
	        static $registry = false;
	        if (!$registry) {
	            $registry = new Project();
	        }
	        return $registry;
	    }
	    function save() {
	    	$instance = Project::instance();
	        array_unshift($instance -> _stack, array());
	        if (!count($instance -> _stack)) {
	        	// Registry is lost
	            return false;
	        } else {
	        	return true;
	        }
	    }
	    function restore() {
	    	$instance = Project::instance();
	    	array_shift($instance -> _stack);
	    }
	    
	    function count(){
	    	$instance = Project::instance();
	    	return count($instance -> _stack[0]);
	    }
	    
	    function countLevel(){
	    	$instance = Project::instance();
	    	return count($instance -> _stack);
	    }
	    
	    /**
		 * Autoloader of class instanses
		 */
		public static function autoload($className) {
			if (!include_once($className.'.php')){
				// TODO:: write to log and send mail: class file is not exists!!!
			}
		}
		
		function setNS(IManager $ns){
	    	self::set('namespace_manager', $ns);
	    }
	    
	    function NS(){
	    	if (($ns = self::get('namespace_manager')) === null){
	    		throw new ConfigurationException("Namespace manager not defined");
	    	}
	    	return $ns;
	    }
	    
	    function path($path, $version = null, $set_include_path = true){
	    	self::NS() -> path($path, $version);
	    }
}
?>
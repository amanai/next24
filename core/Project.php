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
	    
	    
		public static function initErrorHandlers(){
			set_error_handler(array('Project','phpErrorHandler'),error_reporting());
			set_exception_handler(array('Project','exceptionHandler'));
		}
		
		/**
		 * PHP error handler.
		 * This method should be registered as PHP error handler using
		 */
		public static function phpErrorHandler($errno,$errstr,$errfile,$errline){
			$error_handler = self::getErrorHandler();
			if(error_reporting()!=0){
				$error_handler -> handlePhpError($errno,$errstr,$errfile,$errline);
			}
		}
		
		/**
		 * Default exception handler.
		 * @param Exception exception that is not caught
		 */
		public static function exceptionHandler($exception){
			if(($errorHandler=self::getErrorHandler())!==null){
				$errorHandler->handleException($exception);
			}
			else{
				echo $exception;
			}
			exit(1);
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
		
		
	    /**
	     * Set response handler
	     */
	    function setResponse(IManager $response){
	    	self::set('response', $response);
	    }
	    
	    /**
	     * Get response handler
	     */
	    function getResponse(){
	    	if (($response = self::get('response')) === null){
	    		$response = new HttpResponse();
	    		$response -> initialize(new ConfigParameter(array()));
	    		self::setResponse($response);
	    	}
	    	return $response;
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
	    
	    function setDatabase(IManager $de){
	    	self::set('database_engine', $de);
	    }
	    
	    function getDatabase(){
	    	$de = self::get('database_engine');
	    	if ($de === null){
	    		throw new ConfigurationException("Database engine is not configured or initialized");
	    	}
	    	return $de -> getDriver();
	    }
	    
	    function setErrorHandler(IManager $eh){
	    	self::set('error_handler', $eh);
	    }
	    
	    function getErrorHandler(){
	    	$eh = self::get('error_handler');
	    	if ($eh === null){
	    		throw new ConfigurationException("Error handler is not configured or initialized");
	    	}
	    	return $eh;
	    }
	    
	    function setRequest(IManager $r){
	    	self::set('request', $r);
	    }
	    
	    function getRequest(){
	    	$eh = self::get('request');
	    	if ($eh === null){
	    		throw new ConfigurationException("HttpRequest is not configured or initialized");
	    	}
	    	return $eh;
	    }
	    
	    /**
	     * Set request handler
	     */
	    function setSession(IManager $session){
	    	self::set('session', $session);
	    }
	    
	    /**
	     * Get request handler
	     */
	    function getSession(){
	    	if (($session = self::get('session')) === null){
	    		$session = new HttpSession();
	    		$session -> initialize(new ConfigParameter(array()));
	    		self::setSession($session);
	    	}
	    	return $session;
	    }
	    
	    function setTemplateManager($tm){
	    	self::set('template_manager', $tm);
	    }
	    
	    function getTemplateManager(){
	    	$tm = self::get('template_manager');
	    	if ($tm === null){
	    		throw new ConfigurationException("Template engine is not configured or initialized");
	    	}
	    	return $tm;
	    }
}
?>
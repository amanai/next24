<?php

/**
 * Handle all http requests
 */
class HttpRequestManager extends ApplicationManager implements IManager, IteratorAggregate, Countable{

	private $_request;
	private $_files;
	private $_current_controller = null;
	private $_current_action = null;
	private $_request_controller_key = null; // key of service at request when non-rewrite mode
	private $_request_action_key = null; // key of service at request when non-rewrite mode
	
	private $_controller_key_ext = null;
	private $_rewrite = false;
	private $_param_delimiter = '&amp;';
	private $_value_delimiter = '=';

	private $_requestMethod;
	
		function __get($param){
			return $this -> getKey($param);
		}
		
		public function initialize(IConfigParameter $configuration){
			if (get_magic_quotes_gpc()) {
				HelpFunctions::strips($_GET);
				HelpFunctions::strips($_POST);
				HelpFunctions::strips($_COOKIE);
				HelpFunctions::strips($_REQUEST);
			}
			$this -> _requestMethod = $_SERVER['REQUEST_METHOD'];
			if ($this -> _requestMethod == 'GET'){
				$this -> _request = $_GET;
			} elseif ($this -> _requestMethod == 'POST'){
				$this -> _request = $_POST;
			} else {
				$this -> _request = array();
			}
			$this -> _rewrite = (bool)$configuration -> get('rewrite');
			if ($this -> _rewrite){
				$request_key = $configuration -> get('request_key');
				$this -> _param_delimiter = $configuration -> get('param_delimiter');
				$this -> _value_delimiter = $configuration -> get('value_delimiter');
				$query = $_GET[$request_key];
				$d = explode('/', $query);
				if (isset($d[0]) && strlen($d[0])){
					$this -> _current_controller = trim($d[0]);
					$this -> _controller_key_ext = $configuration -> get('controller_name_extension');
					if ($this -> _controller_key_ext){
						$p = pathinfo($this -> _current_controller);
						$this -> _current_controller = $p['filename'];
					}
					unset($d[0]);// unset controller key
					if (isset($d[1]) && strlen($d[1])){
						$this -> _current_action = trim($d[1]);
						unset($d[1]);// unset action key
					} // TODO:: else we need to get default action for this controller from application
					
					foreach($d as $item){
						$tmp = explode(',', $item);
						if (isset($tmp[0])){
							$v0 = trim($tmp[0]);
							$v1 = isset($tmp[1])?trim($tmp[1]):null;
							if (strlen($v1 !== null)){
								if (($this -> _requestMethod == 'GET') || (($this -> _requestMethod == 'POST') && !isset($this -> _request[$v0]))){
									$this -> _request[$v0] = $v1;
								}
							}
						}
					}
				
				}
			} else {
				$this -> _request_controller_key = $configuration -> get('request_service_key'); // Only for non-rewrite mode
				$this -> _request_action_key = $configuration -> get('request_action_key'); // Only for non-rewrite mode
				if (!$this -> _request_controller_key) {
					throw new ConfigurationException('HttpRequest, non-rewrite mode: service key at request not configured');
				}
				if (isset($this -> _request[$this -> _request_controller_key])){
					$this -> _current_controller = $this -> _request[$this -> _request_controller_key];
				}
			}
			$this -> _files = $_FILES;
			Project::setRequest($this);
			$this -> _common_config($configuration);
		}
		
		function getController(){
			return $this -> _current_controller;
		}
		
		function getAction(){
			return $this -> _current_action;
		}
		
		/**
		 * Get all request array
		 */
		public function getKeys(){
			return $this -> _request;
		}
		
		/**
		 * Get specified key value from request
		 */
		public function getKey($key, $default = null){
			return isset($this -> _request[$key])?$this -> _request[$key]:$default;
		}
		
		/**
		 * Add parameter to request
		 */
		public function add($key, $value){
			$this -> _request[$key] = $value;
		}

		public function getIterator(){
		}
		
		public function count(){
			return count($this -> _request);
		}
		
		public function clear(){
			$this -> _request = array();
		}
		
		public function getApplicationFilePath(){
			return realpath($_SERVER['SCRIPT_FILENAME']);
		}
		
		public function getApplicationUrl(){
			return $_SERVER['SCRIPT_NAME'];
		}
		
		/**
		 * @return string entry script URL (w/ host part)
		 */
		public function getAbsoluteUrl(){
			return $this -> getBaseUrl() . $this -> getApplicationUrl();
		}
		
		
		
		/**
		 * Get application base url
		 */
		public function getBaseUrl()
		{
			return ($this -> IsSecure() ? "https://" : "http://") . $_SERVER ['HTTP_HOST'];
		}
		
		/**
		 * @return boolean check for secure channel (https)
		 */
		public function IsSecure(){
			return isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'off');
		}
		
		/**
		 * 
		 */
		public function getHost(){
			if ($this -> _rewrite){
				return pathinfo($this -> getAbsoluteUrl(), PATHINFO_DIRNAME).'/';
			} else {
				str_replace("index.php", "", $_SERVER['REQUEST_URI']);
				$pos = strrpos($_SERVER['REQUEST_URI'], "/");
				$url = "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'], 0, $pos);
				$url .= "/";
				return $url;
			}
		}
		
		public function createUrl($service = null, $action = null, $parameters = null){
			if ($service === null){
				$service = $this -> _current_controller;
			}
			
			if (!$this -> _rewrite){
				if ($action !== null) {
					$parameters = array_merge(array($this -> _request_action_key=>$action), $parameters);
				}
				$parameters = array_merge(array($this -> _request_controller_key=>$service), $parameters);
			}
			
			$query = http_build_query(is_array($parameters)?$parameters:array(), '', $this -> _param_delimiter);
			$url = '';
			if ($this -> _rewrite){
				$url = $service . (($this -> _controller_key_ext !== null)?'.'.$this -> _controller_key_ext:null );
			}
			
			if ($query){
				$query = str_replace('=', $this -> _value_delimiter, $query);
				$url .=  (($this -> _rewrite)?'/':'?') . $query . (($this -> _rewrite)?'/':null);
			}
			if ($this -> _rewrite){
				$url = $this -> getHost() . $url;
			} else {
				$url = $this -> getAbsoluteUrl() . $url;
			}
			return $url;
		}
}
?>

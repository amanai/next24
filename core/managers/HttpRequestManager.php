<?php

/**
 * Handle all http requests/
 */
class HttpRequestManager extends ApplicationManager implements IManager, IteratorAggregate, Countable{

	private $_request;
	public  $_files;
	private $_current_controller = null;
	private $_current_action = null;
	private $_request_controller_key = null; // key of service at request when non-rewrite mode
	private $_request_action_key = null; // key of service at request when non-rewrite mode
	
	private $_controller_key_ext = null;
	private $_rewrite = false;
	private $_param_delimiter = '&amp;';
	private $_value_delimiter = '=';

	private $_requestMethod;
	
	private $_username = null;
	
	private $_request_by_number = array();
	
	private $_after_init_process = false;
	
	private $_request_session_id = null;
		function __get($param){
			return $this -> getKey($param);
		}
		
		public function getCurrentControllerName() {
			return $this->_current_controller;
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
			
			$this -> _username = $this -> getSubDomain($configuration -> get('base_host'));
			
			$this -> _rewrite = (bool)$configuration -> get('rewrite');
			if ($this -> _rewrite){
				$request_key = $configuration -> get('request_key');
				$this -> _param_delimiter = $configuration -> get('param_delimiter');
				$this -> _value_delimiter = $configuration -> get('value_delimiter');
				$query = $_GET[$request_key];
				$d = explode($this -> _param_delimiter, $query);
				if (isset($d[0]) && strlen($d[0])){
					$this -> _current_action = trim($d[0]);
					unset($d[0]);// unset controller key
					foreach($d as $item){
						$tmp = explode($this -> _value_delimiter, $item);
						if (isset($tmp[0])){
							$v0 = trim($tmp[0]);
							$v1 = isset($tmp[1])?trim($tmp[1]):null;
							if (strlen($v0)){
								$this -> _request_by_number[] = $v0;
							}
							if (strlen($v1 !== null)){
								if (($this -> _requestMethod == 'GET') || (($this -> _requestMethod == 'POST') && !isset($this -> _request[$v0]))){
									$this -> _request[$v0] = $v1;
								}
							}
						}
					}
				}
			} else {
				die(__METHOD__."::".__LINE__."::Non-rewrite mode need some changes after last modification this manager!!!!");
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
		
		function getUsername(){
			return $this -> _username;
		}
		function setController($value){
			$this -> _current_controller = $value;
		}
		
		function getAction(){
			return $this -> _current_action;
		}
		
		/**
		 * Get all request array
		 */
		public function getKeys(){
			$this -> afterInitProcess();
			return $this -> _request;
		}
		
		/**
		 * Get specified key value from request
		 */
		public function getKey($key, $default = null){
			$this -> afterInitProcess();
			return isset($this -> _request[$key])?$this -> _request[$key]:$default;
		}
		
		public function getKeyByNumber($number, $default = null){
			$this -> afterInitProcess();
			if (isset($this -> _request_by_number[$number])){
				return $this -> _request_by_number[$number];
			} else {
				return $default;
			}
		}
		
		public function getValueByNumber($number, $default = null){
			$this -> afterInitProcess();
			if (isset($this -> _request_by_number[$number])){
				return $this -> getKey($this -> _request_by_number[$number], $default);
			} else {
				return $default;
			}
		}
		
		private function afterInitProcess(){
			if (!$this -> _after_init_process){
				$session_name = Project::getSession() -> getSessionName();
				if (isset($this -> _request[$session_name])){
					$this -> _request_session_id = $this -> _request[$session_name];
					$n_key = array_search($session_name, $this -> _request_by_number);
					if ($n_key !== false){
						// Unset from keys, sorted by number
						unset($this -> _request_by_number[$n_key]);
						// Rebuild indexes in right order
						$this -> _request_by_number = array_values($this -> _request_by_number);
					}
					// unset from request variables list
					unset($this -> _request[$session_name]);
				}
				$this -> _after_init_process = true;
			}
		}
		
		function getRequestSessionId(){
			$this -> afterInitProcess();
			return $this -> _request_session_id;
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
			$this -> _request_by_number = array();
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
		
		public function getSubDomain($base_host){
			$p = parse_url($this -> getBaseUrl());
			if (($pos = strpos($p['host'], '.'.strtolower($base_host))) !== false) {
				$subdomain = substr($p['host'], 0, $pos);
				if (!strlen($subdomain)){
					$subdomain = null;
				}
			} else {
				$subdomain = null;
			}
			return $subdomain;
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
		
		public function getParentHost(){
			$host = ($this -> IsSecure() ? "https://" : "http://") . $this -> _config -> get('base_host') . '/';
			return $host;
		}
		
		public function createUrl($service = null, $action = null, $parameters = null, $user = null){
			if ($service === null){
				$service = $this -> _current_controller;
			}
			
			if ($action === null){
				$action = $this -> _current_action;
			}
			// TODO:: need cache to service+action for getting request key!
			$controller_model = new ControllerModel;
			$controller_model -> loadByKey($service);
			if ((int)$controller_model -> id <= 0 ){
				throw new InvalidValueException("Can't create url, controller is not exists");
			}
			
			$action_model = new ActionModel;
			$action_model -> loadByKey($controller_model -> id, $action);
			if ((int)$action_model -> id <= 0 ){
				throw new InvalidValueException("Can't create url, action is not exists");
			}
			if (!strlen($action_model -> request_key)){
				throw new InvalidValueException(__METHOD__."::". __LINE__.":: Bad request key: controller - ".$controller_model -> name."; action - ".$action_model -> name.";action ID=".$action_model -> id);
			}
			
			// Default user controller action ----------
			if ($service=='User'&&$action_model->default&&$this->getUsername()) {
				$action_model -> request_key='';
			}
			// -----------------------------------------
			
			if (!$this -> _rewrite){
				if ($action !== null) {
					$parameters = array_merge(array($this -> _request_action_key=>$action), $parameters);
				}
				$parameters = array_merge(array($this -> _request_controller_key=>$service), $parameters);
			}
			
			if (!is_array($parameters)){
				$parameters = array();
			}
			
			$session_name = Project::getSession() -> getSessionName();
			/*if (($this -> _username != $user) && ($user !== null) && ((int)Project::getUser() -> getDbUser() -> id > 0)){
				$sid = Project::getSession() -> getSID();
				//var_dump($sid);die;
				$parameters[$session_name] = $sid;
			} else {
				if (isset($parameters[$session_name])){
					unset($parameters[$session_name]);
				}
			}*/
			
			$query = '';
			foreach ($parameters as $k=>$v){
				if (strlen($query)){
					$query .= $this -> _param_delimiter; 
				}
				if (!is_numeric($k) && strlen($k)){
					$query .= $k . $this -> _value_delimiter . $v;
				} else {
					$query .= $v;
				}
			}
			//$query = http_build_query(is_array($parameters)?$parameters:array(), '', $this -> _param_delimiter);
			
			$url = '';
			if ($this -> _rewrite){
				$url = $action_model -> request_key;
			}
			
			if ($query){
				//$query = str_replace('=', $this -> _value_delimiter, $query);
				//$query = str_replace($this -> _param_delimiter.$this -> _value_delimiter, $this -> _param_delimiter, $query);
				$url .=  (($this -> _rewrite)?'/':'?') . $query . (($this -> _rewrite)?'/':null);
			}
			if ($this -> _rewrite){
				if ($user === null){
					if ($this -> _username !== null){
						$user = $this -> _username;
					}
				}
				if ($user !== null) {
					$host = ($this -> IsSecure() ? "https://" : "http://") . $user . (strlen($user)?'.':'') . $this -> _config -> get('base_host') . '/';
				} else {
					
					$host = $this -> getHost();
				}
				$url = $host . $url;
			} else {
				$url = $this -> getAbsoluteUrl() . $url;
			}
			return $url;
		}
		
}
?>
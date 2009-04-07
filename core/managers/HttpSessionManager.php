<?php
/**
 * Handle session mechanisme
 */
class HttpSessionManager extends ApplicationManager implements IManager, Countable{
	private $_started = false;
	// TODO:: get from config
	private $_autoStart = false;

		
		public function initialize(IConfigParameter $configuration){
			$this -> _common_config($configuration);
			$this -> _autoStart = $configuration ->get('autoStart');
			if($this -> _autoStart === true){
				$this->open();
			}
			Project::setSession($this);
		}

	
		/**
		 * Start session
		 */
		public function open(){
			if (!$this -> _started){
				if(ini_get('session.auto_start')!=='1'){
					if (($session_name = $this -> _config -> get('session_name')) !== null){
						$this -> setSessionName($session_name);
					}
					session_name($session_name);
					if (($sid = Project::getRequest() -> getRequestSessionId()) !== null){
						session_id($sid);
					}
					session_start();  
					
				}
				$this -> _started=true;
			}
		}
		
		/**
		 * Write to disk and close session
		 */
		public function close(){
			if($this -> _started) {
				session_write_close();
				$this -> _started=false;
			}
		}
		
		/**
		 * Destroy session
		 */
		public function destoy(){
			if($this -> _started) {
			$_SESSION = array();
			$session_name = session_name();
			if(isset($_COOKIE[$session_name])) {
				unset($_COOKIE[$session_name]);
			}
			session_destroy();
				$this -> _started=false;
			}
		}
		
		/**
		 * Get session ID
		 */
		public function getSID()
		{
			return session_id();
		}
		
		/**
		 * Set session ID
		 */
		public function setSID($value){
			if(!$this -> _started) {
				session_id($value);
			} else {
				throw new InvalidActionException('Session already started and can"t be changed');
			}
			
		}
		
		/**
		 * Get name of current session
		 */
		public function getSessionName(){
			return session_name();
		}
		
		public function setSessionName($value){
			if( $this -> _started ){
				throw new InvalidActionException('Session already started and can"t be changed');
			} elseif(ctype_alnum($value)){
				session_name($value);
			} else {
				throw new InvalidValueException('Session name value is not valid: '.$value);
			}
				
		}
		
		
		/**
		 * Get current session save path
		 */
		public function getSavePath()
		{
			return session_save_path();
		}
		
		/**
		 * Get all keys of session array
		 */
		public function getKeys(){
			return array_keys($_SESSION);
		}
		
		/**
		 * Get value from session data by key
		 */
		public function getKey($key, $default=null){
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			} else {
				return $default;
			}
		}
		
		/**
		 * Add parameter to session
		 */
		public function add($key, $value){
			$_SESSION[$key] = $value;
		}
		
		public function __set($var, $val){
			if ($val!=null) $this->add($var, $val);
			else $this->remove($var);
		}
		
		public function __get($var){
			return $this->getKey($var);
		}
		
		/**
		 * Remove value from session
		 */
		public function remove($key){
			if( $this -> _started ){
				if (isset($_SESSION[$key])) {
					unset($_SESSION[$key]);
				}
			}
		}
		
		/**
		 * Clear session
		 */
		public function clear(){
			$_SESSION = array();
		}
		
		/**
		 * Get number of elements at session
		 */
		public function count(){
			return count($_SESSION);
		}
}
?>

<?php
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'interfaces' . DIRECTORY_SEPARATOR . 'IConfigParameter.php');

/**
 * Class for handling application/module parameters from xml 
 */
class ConfigParameter implements IConfigParameter{
	private $_parameters;
	private $_classes;
	
		function __construct($input){
			$this -> _parameters = array();
			$this -> _classes = array();
			if (is_array($input)){
				$input = HelpFunctions::Lower($input, true);
				$this -> _parameters = $input;
				foreach ($this -> _parameters as $key => $value){
					if (is_array($value)){
						if (isset($value['class'])){
							$this -> _classes[$key] = $value['class'];
						}
					}
				}
				
			} else {
				$xml = simplexml_load_string($input);
				$buffer = array();
				foreach ($xml -> attributes() as $attrName=>$attrValue){
					$this -> _parameters[strtolower($attrName)] = trim((string)$attrValue);
				}
				foreach ($xml -> children() as $param){
					$buffer = array();
					$key = false;
					$class = false;
					foreach ($param -> attributes() as $attrName=>$attrValue){
						$val = trim((string)$attrValue);
						if ($attrName == 'key'){
							$key = strtolower($val);
						}
						if ($attrName == 'class'){
							$class = $val;
						}
						if ($val === "true"){
							$val = true;
						} elseif ($val === "false"){
							$val = false;
						} elseif (is_numeric($val)) {
							$val = $val;
						}
						$buffer[$attrName] = $val;
					}
					if ($key && ((isset($buffer['enabled']) && ($buffer['enabled'] == true)) || (!isset($buffer['enabled'])))){
						unset($buffer['key']);
						unset($buffer['enabled']);
						if ((count($buffer) == 1)){
							reset($buffer);
							$buffer = current($buffer);
						}
						$this -> _parameters[$key] = $buffer;
						if ($class !== false){
							$this -> _classes[$key] = $class;
						}
					}
				}
			}
			return true;
		}
		
		public function getParameters(){
			return $this -> _parameters;
		}

		/**
		 * Return number of parameters
		 */
		public function count(){
			return count($this -> _parameters);
		}

		/**
		 * Clear parameters
		 */
		public function clear(){
			$this -> _parameters = array();
		}
		
		/**
		 * Get parameter value by key
		 */
		public function get($id, $default = null){
			$id = strtolower($id);
			if (!isset($this -> _parameters[$id])){
				return $default;
			}
			return (isset($this -> _parameters[$id]))?$this -> _parameters[$id]:$default;
		}
		
		/**
		 * Get defined class by key
		 */
		public function getClassByKey($id){
			return (isset($this -> _classes[$id]))?$this -> _classes[$id]:null;
		}
		
		/**
		 * Get key by defined class
		 */
		public function getKeyByClass($className){
			return (($key = array_search($className, $this -> _classes)) !== false)?$key:null;
		}
		
		/**
		 * Get parameter value by key from an array (by two keys)
		 */
		public function getWith2Key($key1, $key2, $default = null){
			if (!isset($this -> _parameters[$key1])){
				return $default;
			} else {
				if (!isset($this -> _parameters[$key1][$key2])){
					return $default;
				} else {
					return $this -> _parameters[$key1][$key2];
				}
			}
		}
}
?>

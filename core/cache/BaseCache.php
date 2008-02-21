<?php

class BaseCache  extends ApplicationManager{
	protected $_prefix;
		public function initialize(IConfigParameter $configuration){
			
			$this -> _config = $configuration;
			if (($prefix = $this -> _config -> get('Prefix', null)) !== null){
				$this -> _prefix = $prefix;
				unset($prefix);
			}
			$this->_initialized = true;
		}
		
		protected function getUniqueKey($key){
			return md5($this -> _prefix.$key);
		}
}
?>
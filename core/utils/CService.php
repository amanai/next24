<?php
class CService extends BaseModel implements IModel{
	
		function __construct(){
			parent::__construct('service');
		}
		
		function getServiceByKey($service_key){
			// TODO:: caching
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE client_id = ?d AND request_key = LOWER(?)", $this -> _client_id, strtolower($service_key));
			$this -> bind($result);
			
			return $result;
		}
		
		function getDefaultService(){
			// TODO:: caching
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE client_id = ?d AND `default` = 1", $this -> _client_id);
			$this -> bind($result);
			return $result;
		}
		
		function loadAcl($fieldId){
			return false;
		}
}
?>
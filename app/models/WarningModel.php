<?php
class WarningModel extends BaseModel{
		function __construct(){
			parent::__construct('warning');
		}
		
		function add($user_id, $cause){
			if (strlen(trim($cause))){
				$this -> clear();
				$this -> user_id = (int)$user_id;
				$this -> cause = $cause;
				return $this -> save();
			} else {
				return 0;
			}
		}
}
?>
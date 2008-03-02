<?php
class UserTypeModel extends BaseModel{
	
		function __construct(){
			parent::__construct('user_type');
			$this -> _caches(true, true, true);
		}
		
		function save(){
			$DE = Project::getDatabase();
			$DE -> query('UPDATE '.$this -> _table.' SET ?a WHERE id = ?d', $this -> _data, $this -> id);
			return $this -> id;
		}
}
?>

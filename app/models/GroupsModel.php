<?php
class GroupsModel extends BaseModel{
	private $db;
		function __construct(){
			parent::__construct('GTDCategories');
			$this->db = Project::getDatabase();
			$this -> _caches(true, true, true);
		}				
}		
?>
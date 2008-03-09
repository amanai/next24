<?php
class BlogModel extends BaseModel{
		function __construct(){
			parent::__construct('blog');
		}
		
		function loadByUserId($user_id){
			$result = Project::getDatabase() -> selectRow("SELECT * FROM blog WHERE user_id = ?d LIMIT 1", $user_id);
			$this -> bind($result);
			return $result;
		}
}
?>
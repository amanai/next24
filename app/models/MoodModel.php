<?php
class MoodModel extends BaseModel{
		function __construct(){
			parent::__construct('mood');
		}
		
		function getList($user_id){
			$sql = "SELECT * FROM mood WHERE user_id=?d";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
}
?>
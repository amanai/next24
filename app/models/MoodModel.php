<?php
class MoodModel extends BaseModel{
		function __construct(){
			parent::__construct('moods');
		}
		
		function getList($user_id){
			$sql = "SELECT * FROM moods WHERE user_id=?d";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
		
}
?>
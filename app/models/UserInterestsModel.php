<?php
class UserInterestsModel extends BaseModel{
		function __construct(){
			parent::__construct('users_interests');
		}
		
		function set($user_id, $interest_id){
			if (($user_id > 0) && ($interest_id > 0) ){
				$count = (int)Project::getDatabase() -> selectCell("SELECT count(*) FROM ".$this -> _table." WHERE user_id=?d AND interest_id=?d", (int)$user_id, (int)$interest_id);
				if ($count <= 0){
					$interest_model = new InterestsModel;
					if ($interest_model -> exists($interest_id)){
						Project::getDatabase() -> query("INSERT INTO ".$this -> _table." SET user_id = ?d, interest_id = ?d", $user_id, $interest_id);
						$interest_model -> increaseCounter($interest_id);
					}
				}
			}
		}
		
		function getInterests($user_id) {
			$sql="SELECT I.`name` FROM ".$this -> _table." as IC LEFT JOIN `interests` as I ON IC.`interest_id`=I.`id` WHERE IC.`user_id`=?";			
			return Project::getDatabase() -> selectCol($sql, (int)$user_id);
		}
}
?>
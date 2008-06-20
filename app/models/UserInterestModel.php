<?php
class UserInterestModel extends BaseModel{
		function __construct(){
			parent::__construct('user_interest');
		}
		
		function set($user_id, $interest_id){
			if (($user_id > 0) && ($interest_id > 0) ){
				$count = (int)Project::getDatabase() -> selectCell("SELECT count(*) FROM users_interests WHERE user_id=?d AND interest_id=?d", (int)$user_id, (int)$interest_id);
				if ($count <= 0){
					$interest_model = new InterestsModel;
					if ($interest_model -> exists($interest_id)){
						Project::getDatabase() -> query("INSERT INTO users_interests SET user_id = ?d, interest_id = ?d", $user_id, $interest_id);
						$interest_model -> increaseCounter($interest_id);
					}
				}
			}
		}
}
?>
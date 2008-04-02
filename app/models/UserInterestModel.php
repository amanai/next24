<?php
class UserInterestModel extends BaseModel{
		function __construct(){
			parent::__construct('user_interest');
		}
		
		function set($user_id, $interest_id){
			if (($user_id > 0) && ($interest_id > 0) ){
				$count = (int)Project::getDatabase() -> selectCell("SELECT count(*) FROM user_interest WHERE user_id=?d AND interest_id=?d", (int)$user_id, (int)$interest_id);
				if ($count <= 0){
					$interest_model = new InterestModel;
					if ($interest_model -> exists($interest_id)){
						Project::getDatabase() -> query("INSERT INTO user_interest SET user_id = ?d, interest_id = ?d", $user_id, $interest_id);
						$interest_model -> increaseCounter($interest_id);
					}
				}
			}
		}
}
?>
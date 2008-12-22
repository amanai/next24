<?php
class RelationsModel extends BaseModel{
		function __construct(){
			parent::__construct('relations');
		}
		
		function getList(){
			$sql = "SELECT * FROM `relations`";
			return Project::getDatabase() -> select($sql);
		}
		
		function getRelation($user1_id, $user2_id) {
			if ($res=Project::getDatabase() -> select("SELECT * FROM `users_relations` WHERE `user1_id`=?d AND `user2_id`=?d", $user1_id, $user2_id)) {
				return $res[0]['text'];
			} else {
				return false;
			}
		}
		
		function setRelation($user1_id, $user2_id, $text) {
			if (Project::getDatabase() -> select("SELECT * FROM `users_relations` WHERE `user1_id`=?d AND `user2_id`=?d", $user1_id, $user2_id)) {
				Project::getDatabase() -> query("UPDATE `users_relations` SET `text`=?s WHERE `user1_id`=?d AND `user2_id`=?d", htmlspecialchars($text), $user1_id, $user2_id);
			} else {
				Project::getDatabase() -> query("INSERT INTO `users_relations` SET `text`=?s, `user1_id`=?d, `user2_id`=?d", htmlspecialchars($text), $user1_id, $user2_id);
			}
		}
		
}
?>
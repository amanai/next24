<?php
class FriendModel extends BaseModel{
		function __construct(){
			parent::__construct('friend');
		}
		
		function isFriend($user_id, $friend_id){
			return (int) Project::getDatabase() -> selectCell("SELECT friend_id FROM ".$this -> _table." WHERE user_id=?d AND friend_id=?d LIMIT 1", (int)$user_id, (int)$friend_id);
		}
		
		function getFriends($user_id){
			$sql =  " SELECT " .
    				" u.id as user_id, u.login as login " .
    				" FROM friend as f " .
    				" INNER JOIN users u ON u.id=f.friend_id " .
    				" WHERE " .
    				" f.user_id=?d";
			return Project::getDatabase() -> selectCol($sql, (int)$user_id);
		}
		
		function getFriendsInGroup($user_id, $group_id){
			$sql =  " SELECT " .
    				" f.*, u.id as user_id, u.login as login " .
    				" FROM friend as f " .
    				" INNER JOIN users u ON u.id=f.friend_id " .
    				" WHERE " .
    				" f.user_id=".(int)$user_id." AND f.group_id = ".(int)$group_id;
			return Project::getDatabase() -> select($sql);
		}
		
		function getInFriends($user_id){
			$sql = "SELECT " .
												" u.login as login " .
											" FROM friend as f " .
											" INNER JOIN users u ON u.id=f.user_id " .
											" WHERE " .
												" f.friend_id=?d";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
		
		function getUserFriendGroups($user_id){
			$sql =  " SELECT * " .
    				" FROM friend_group " .
    				" WHERE user_id = ?d ";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
}
?>
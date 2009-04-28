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
												" u.id as user_id, u.login as login " .
											" FROM friend as f " .
											" INNER JOIN users u ON u.id=f.user_id " .
											" WHERE " .
												" f.friend_id=?d";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
		
		function getFriendById($friend_table_id){
		    $sql = "
		      SELECT friend.*, users.login as friend_login
		      FROM friend 
		      INNER JOIN users 
		          ON friend.friend_id = users.id
		      WHERE friend.id = '".$friend_table_id."'
		    ";
		    return Project::getDatabase() -> selectRow($sql);
		}
		
		
		function changeFriendsGroup($user_id, $old_group_id, $new_group_id){
		    $sql = "
		      UPDATE friend
		      SET group_id = '".$new_group_id."'
		      WHERE user_id = '".$user_id."' AND group_id = '".$old_group_id."'
		    ";
		    Project::getDatabase() -> query($sql);
		}
		
		/* Friend Groups */
		
		
		function getUserFriendGroups($user_id){
			$sql =  " SELECT * " .
    				" FROM friend_group " .
    				" WHERE user_id = ?d ";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
		
		function isDublicateGroup($user_id, $name){
			$sql =  " SELECT * " .
    				" FROM friend_group " .
    				" WHERE user_id = ?d  AND name = '".$name."'";
			$result = Project::getDatabase() -> select($sql, (int)$user_id);
			if ($result) return true;
			else return false;
		}
		
		function getFriendGroupById($group_id){
		    $sql =  " SELECT * " .
    				" FROM friend_group " .
    				" WHERE id = ?d ";
			return Project::getDatabase() -> selectRow($sql, (int)$group_id);
		}
		
		function addFriendGroup($user_id, $name, $editable = null){
		    $sql =  " INSERT INTO friend_group (`user_id`, `name`, `editable`) " .
    				" VALUES ('".$user_id."', '".htmlspecialchars($name)."', '".$editable."') ";
			Project::getDatabase() -> query($sql);
		}
		
		/* END Friend Groups */
		
}
?>
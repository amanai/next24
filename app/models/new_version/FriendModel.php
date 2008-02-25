<?php
class FriendModel extends BaseModel{
		function __construct(){
			parent::__construct('friend');
		}
		
		function isFriend($user_id, $friend_id){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectCell("SELECT id FROM ".$this -> _table." WHERE user_id=?d AND friend_id=?d LIMIT 1", (int)$user_id, (int)$friend_id);
			$this -> bind($result);
			return $result;
		}
}
?>
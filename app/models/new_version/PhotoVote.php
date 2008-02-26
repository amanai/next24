<?php
class PhotoVote extends BaseModel{
		function __construct(){
			parent::__construct('photo_vote');
		}
		
		static public function canVote($user_id, $photo_id){
			$user_id = (int)$user_id;
			$photo_id = (int)$photo_id;
			if (($user_id> 0) && ($photo_id > 0)){
				$sql = "SELECT id FROM photo_vote WHERE user_id=?d AND photo_id=?d";
				$rs = Project::getDatabase()->selectCell($sql, $user_id, $photo_id);
				if ((int)$rs > 0){
					return false;
				} else {
					return true;
				}
			}
			return false;
		}
		
		public function addVote($user_id, $photo_id, $remote_addr){
			$this -> id = 0;
			if ($this -> canVote($user_id, $photo_id)){
				$this -> user_id = (int)$user_id;
				$this -> photo_id = (int)$photo_id;
				$this -> ip = $remote_addr;
				$this -> save();
			}
		}
		
}
?>
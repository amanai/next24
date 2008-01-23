<?php
	class PhotoVotes extends CBaseModel{
		
		function __construct($id = null){
			$this->tableName = 'photo_votes';
			parent::__construct($id);
		}
		
		
		public function canVote($user_id, $photo_id){
			$this->resetSql();
			$user_id = (int)$user_id;
			$photo_id = (int)$photo_id;
			if (($user_id> 0) && ($photo_id > 0)){
				$sql = "SELECT id FROM photo_votes WHERE user_id=" . $user_id . " AND photo_id=".$photo_id;
				$rs = MySql::query_row($sql);
				if (count($rs) > 0){
					return false;
				}
				return true;
			}
			return false;
		}
		
		public function addVote($user_id, $photo_id){
			$this -> resetSql();
			$this -> set('user_id', $user_id);
			$this -> set('photo_id', $photo_id);
			$this -> set('ip', $_SERVER['REMOTE_ADDR']);
			$this -> save();
		}
	}
?>

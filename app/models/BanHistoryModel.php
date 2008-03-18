<?php
class BanHistoryModel extends BaseModel{
	const BANNED 	= 1;
	const UNBANNED 	= 2;
		function __construct(){
			parent::__construct('ban_history');
		}
		
		function ban($user_id, $action_by, $warning_id, $banned_till){
			$this -> clear();
			$this -> user_id = (int)$user_id;
			$this -> action_by = (int)$action_by;
			$this -> warning_id = (int)$warning_id;
			$this -> banned_till = $banned_till;
			$this -> action_date = date("Y-m-d H:i:s");
			$this -> type = self::BANNED;
			$this -> save();
			$user_model = new UserModel;
			$user_model -> ban($user_id);
		}
		
		function unban($user_id, $unbanned_by){
			if ($user_id && $unbanned_by) {
				$this -> clear();
				$this -> user_id = (int)$user_id;
				$this -> action_by = (int)$unbanned_by;
				$this -> action_date = date("Y-m-d H:i:s");
				$this -> type = self::UNBANNED;
				$this -> save();
				$user_model = new UserModel;
				$user_model -> unban($user_id);
			}
		}
		
		function isBanned($user_id){
			$sql = "SELECT * FROM ban_history WHERE user_id=?d ORDER BY action_date DESC LIMIT 1";
			$info = Project::getDatabase() -> selectRow($sql, (int)$user_id);
			if (!count($info)){
				return false;
			}
			$this -> bind($info);
			if (((int)$info['type'] == self::BANNED) || (strtotime($info['banned_till']) > time())){
				return true;
			} else {
				return false;
			}
		}
		
		function loadUserHistory($user_id){
			$sql = "SELECT " .
						" bh.*," .
						" b_by.login as baned_by_login," .
						" w.cause" .
					" FROM ban_history bh " .
					" LEFT JOIN users b_by ON b_by.id = bh.action_by " .
					" LEFT JOIN warning w ON w.id = bh.warning_id AND w.user_id = bh.user_id " .
					" WHERE" .
					" bh.user_id = ?d ";
			return Project::getDatabase() -> select($sql, (int)$user_id);
		}
		
}
?>
<?php

class SubjectVoteModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("subject_votes");
	}
	
	public function loadUserId($userId) {
		$sql = "SELECT * FROM $this->_table WHERE `user_id` = ?d";
		return Project::getDatabase()->select($sql, $userId);
	}
	
}
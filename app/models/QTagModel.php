<?php

class QTagModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('qq_tags');
	}
	
	public function loadWhere($q_id, $t_id = null) {
		$q_id = (int)$q_id;
		$t_id = (int)$t_id;
		$sql = "SELECT * FROM qq_tags WHERE question_id = ?d ";
		$t_id > 0 ? $sql.= "AND question_tag_id = ?d" : "";
		$result =  Project::getDatabase()->selectRow($sql, $q_id, $t_id);
		$this->bind($result);
		return $result;
	}
	
	public function deleteByQuestionId($id) {
		$id = (int) $id;
		$sql = "DELETE FROM qq_tags WHERE question_id = ?d";
		Project::getDatabase()->query($sql, $id);
	}
	
}


?>
<?php

class QuestionCatModel extends BaseModel {
	
	public function __construct() {
		parent::__construct('questions_cat');
	}
	
	public function save() {
		$sql =  "UPDATE questions_cat ".
				"SET `sortfield` = `sortfield`+1 ".
				"WHERE `sortfield` >= ?d";
		Project::getDatabase()->query($sql, $this->sortfield);
		parent::save();
	}
}

?>
<?php

class ArticleTreeModel extends BaseModel {
	
	public function __construct() {
		parent::__construct("articles_tree");
	}
	
	public function loadByParentId($id) {
		$id = (int)$id;
		$DE = Project::getDatabase();
		$parent = $DE->selectRow("SELECT * FROM $this->_table WHERE id = ?d", $id);
		$result = $DE->select("SELECT * FROM $this->_table WHERE $this->_table.key like '".$parent['key']."%' AND $this->_table.level = ?d AND $this->_table.active = 1 order by 'key'", $parent['level'] + 1);
		return $result;
	}
	
}

?>
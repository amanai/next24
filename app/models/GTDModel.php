<?php
class GTDModel extends BaseModel{
	private $db;
		function __construct(){
			parent::__construct('GTDCategories');
		//	$this -> _caches(true, true, true);
			$this->db = Project::getDatabase();
		}
		public function getCategories($id_root) {
			$sql = "select * from GTDCategories where id = $id_root";
			$root = $this->db->selectRow($sql);
			$sql = "select id from GTDCategories where parent_id = {$root['id']}";
			$nums = $this->db->selectCol($sql);
			foreach($nums as $key => $id) {
				$res = $this->getCategories($id['id']);
				$result[] = $res;
			}
			$root['subcategories'] = $result;
			return $root;
		}
		private function getSubcategories($id) {
			$sql = "select * from GTDCategories where id = $id";
			$result = $this->db->selectRow($sql);
			return $result;
		}
		public function addCategory($category_id,$parent_id,$category_name) {
			$sql = "insert into GTDCategories values(1,$parent_id,$category_name)";
			$result = $this->db->query($sql);
		}
}		
?>
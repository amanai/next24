<?php
class GTDModel extends BaseModel{
	private $db;
		function __construct(){
			parent::__construct('GTDCategories');
		//	$this -> _caches(true, true, true);
			$this->db = Project::getDatabase();
		}
		public function getRootCategories($id_root) {
			$result['subcategories'][0] = $this->getCategories($id_root);
			return $result;
		}		
		public function getCategories($id_root) {
			$sql = "select id,user_id,parent_id,category_name from GTDCategories where id = $id_root";
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
		public function addCategory($user_id,$parent_id,$category_name) {
			$sql = "INSERT INTO GTDCategories(user_id,parent_id,category_name) values($user_id,$parent_id,'$category_name')";
			$result = $this->db->query($sql);
			
		}			
}		
?>
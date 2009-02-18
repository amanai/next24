<?php
class GTDModel extends BaseModel{
	private $db;
		function __construct(){
			parent::__construct('GTDCategories');
		//	$this -> _caches(true, true, true);
			$this->db = Project::getDatabase();
		}
		public function getRootCategory($user_id) {
			$sql = "SELECT id FROM GTDCategories WHERE user_id = $user_id";
			$root_id = $this->db->selectCell($sql);
			$result['subcategories'][0] = $this->getCategories($root_id);
			return $result;					
		}
		public function getCategories($id) {
			$sql = "SELECT id,parent_id,category_name,level FROM GTDCategories WHERE id = $id";
			$result = $this->db->selectRow($sql);
			$root_id = $result['id'];
			$sql = "SELECT id FROM GTDCategories WHERE parent_id = $root_id";
			$nums = $this->db->selectCol($sql);
			foreach($nums as $k => $v) {
				$result['subcategories'][] = $this->getCategories($v);
			}
			return $result;
		}
		public function getRootFolder($category_id) {
			$sql = "SELECT id FROM GTDfolders WHERE category_id = $category_id";
			$root_id = $this->db->selectCell($sql);
			$result['subfolders'][0] = $this->getFolders($root_id);
			return $result;					
		}
		public function getFolders($id) {
			$sql = "SELECT id,parent_id,folder_name,level FROM GTDfolders WHERE id = $id";
			$result = $this->db->selectRow($sql);
			$root_id = $result['id'];
			$sql = "SELECT id FROM GTDfolders WHERE parent_id = $root_id";
			$nums = $this->db->selectCol($sql);
			foreach($nums as $k => $v) {
				$result['subfolders'][] = $this->getFolders($v);
			}
			return $result;
		}
		public function addFolder($category_id,$parent_id,$folder_name) {
			$sql = "INSERT INTO GTDfolders(category_id,parent_id,folder_name) VALUES($category_id,$parent_id,'$folder_name')";
			$result = $this->db->query($sql);
		}
		public function addCategory($user_id,$parent_id,$category_name) {
			$sql = "INSERT INTO GTDCategories(user_id,parent_id,category_name) VALUES($user_id,$parent_id,'$category_name')";
			$result = $this->db->query($sql);	
		}	
		public function deleteCategory($category_id) {
			$sql = "DELETE FROM GTDCategories WHERE id = $category_id";
			$result = $this->db->query($sql);			
		}
		public function deleteFolder($id_folder) {
			$sql = "DELETE FROM GTDfolders WHERE id = $id_folder";
			$result = $this->db->query($sql);	
		}
		public function getCategoryName($category_id) {
			$sql = "SELECT category_name FROM GTDCategories WHERE id = $category_id";
			$result = $this->db->selectCell($sql);
			return $result;				
		}
		public function getFolderFiles($id_folder) {
			$sql = "SELECT id AS ARRAY_KEY,file_name FROM GTDFiles WHERE id_folder = $id_folder";
			$result = $this->db->select($sql);
			return $result;
		}
}		
?>
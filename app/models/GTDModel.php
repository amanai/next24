<?php
class GTDModel extends BaseModel{
	private $db;
	private $delFolders;
	private $delCategories;
		function __construct(){
			parent::__construct('GTDCategories');
			$this->db = Project::getDatabase();
			$this -> _caches(true, true, true);
		}
		public function getRootCategory($user_id) {
			$sql = "SELECT id FROM GTDCategories WHERE user_id = $user_id AND parent_id = 0";
			$root_id = $this->db->selectCell($sql);
			$result['subcategories'][0] = $this->getCategories($root_id);
			return $result;					
		}
		public function getCategories($id) {
			$sql = "SELECT id,parent_id,category_name,level,secure FROM GTDCategories WHERE id = $id ORDER BY id";
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
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "SELECT id FROM GTDfolders WHERE category_id = $category_id and parent_id = 0 AND user_id = $cur_user_id";
			$root_id = $this->db->selectCell($sql);
			$result['subfolders'][0] = $this->getFolders($root_id);
			return $result;					
		}
		public function getFolders($id) {
			$sql = "SELECT id,parent_id,folder_name,level,secure FROM GTDfolders WHERE id = $id ORDER BY id";
			$result = $this->db->selectRow($sql);
			$root_id = $result['id'];
			$sql = "SELECT id FROM GTDfolders WHERE parent_id = $root_id";
			$nums = $this->db->selectCol($sql);
			foreach($nums as $k => $v) {
				$result['subfolders'][] = $this->getFolders($v);
			}
			return $result;
		}
		public function addFolder($category_id,$parent_id,$folder_name,$secure) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "INSERT INTO GTDfolders(category_id,parent_id,user_id,folder_name,secure) VALUES($category_id,$parent_id,$cur_user_id,'$folder_name',$secure)";
			$result = $this->db->query($sql);
		}
		public function addCategory($user_id,$parent_id,$category_name,$secure) {
			$sql = "INSERT INTO GTDCategories(user_id,parent_id,category_name,secure) VALUES($user_id,$parent_id,'$category_name',$secure)";
			$result = $this->db->query($sql);	
		}	
		public function deleteCategory($category_id) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "SELECT id FROM GTDCategories WHERE id = $category_id AND user_id = $cur_user_id";
			$root_id = $this->db->selectCell($sql);
			$this->delCategories[0] = $root_id;
			$this->deleteLoopCategories($root_id);
			$result = $this->db->query('DELETE FROM GTDCategories WHERE id IN(?a)', $this->delCategories);
			$result = $this->db->query('DELETE FROM GTDCategories_secure WHERE category_id IN(?a)', $this->delCategories);
			$folders_id = $this->db->selectCol('SELECT id FROM GTDfolders WHERE category_id IN(?a)',$this->delCategories);	
			$files_id = $this->db->selectCol('SELECT id FROM GTDFiles WHERE file_id IN(?a)',$folders_id);
//			print '<pre>';
//				print_r($files_id);
//			print '</pre>';		   
			$result = $this->db->query('DELETE FROM GTDFiles_secure WHERE file_id IN(?a)', $files_id);
			$result = $this->db->query('DELETE FROM GTDFiles WHERE folder_id IN(?a)', $folders_id);
			$result = $this->db->query('DELETE FROM GTDfolders_secure WHERE folder_id IN(?a)', $folders_id);								
			$result = $this->db->query('DELETE FROM GTDfolders WHERE id IN(?a)', $folders_id);					
		}
		public function deleteFolder($folder_id) {	
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "SELECT id FROM GTDfolders WHERE id = $folder_id AND user_id = $cur_user_id";
			$root_id = $this->db->selectCell($sql);
			$this->delFolders[0] = $root_id;
			$this->deleteLoopFolders($root_id);
			$result = $this->db->query('DELETE FROM GTDfolders WHERE id IN(?a)', $this->delFolders);
			$result = $this->db->query('DELETE FROM GTDfolders_secure WHERE folder_id IN(?a)', $this->delFolders);
			$files_id = $this->db->selectCol('SELECT id FROM GTDFiles WHERE file_id IN(?a)',$this->delFolders);
			$result = $this->db->query('DELETE FROM GTDFiles_secure WHERE file_id IN(?a)', $files_id);
			$result = $this->db->query('DELETE FROM GTDFiles WHERE folder_id IN(?a)', $this->delFolders);						
		}	
		public function deleteLoopCategories($id) {
			$sql = "SELECT id,parent_id FROM GTDCategories WHERE id = $id ORDER BY id";
			$result = $this->db->selectRow($sql);
			$root_id = $result['id'];
			$sql = "SELECT id FROM GTDCategories WHERE parent_id = $root_id";
			$nums = $this->db->selectCol($sql);
			foreach($nums as $k => $v) {
				$this->delCategories[] = $v;
				$this->deleteLoopCategories($v);
			}				
		}
		public function deleteLoopFolders($id) {
			$sql = "SELECT id,parent_id FROM GTDfolders WHERE id = $id ORDER BY id";
			$result = $this->db->selectRow($sql);
			$root_id = $result['id'];
			$sql = "SELECT id FROM GTDfolders WHERE parent_id = $root_id";
			$nums = $this->db->selectCol($sql);
			foreach($nums as $k => $v) {
				$this->delFolders[] = $v;
				$this->deleteLoopFolders($v);
			}	
		}
		public function deleteFile($file_id) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "DELETE FROM GTDFiles WHERE id = $file_id AND user_id = $cur_user_id";
			$result = $this->db->query($sql);
		}
		public function getCategoryName($category_id) {
			$sql = "SELECT category_name FROM GTDCategories WHERE id = $category_id";
			$result = $this->db->selectCell($sql);
			return $result;				
		}
		public function getFolderName($id_folder) {
			$sql = "SELECT folder_name FROM GTDfolders WHERE id = $id_folder";
			$result = $this->db->selectCell($sql);
			return $result;				
		}
		public function getFolderFiles($id_folder) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "SELECT id AS ARRAY_KEY,file_name,file_path,secure FROM GTDFiles WHERE folder_id = $id_folder AND user_id = $cur_user_id";
			$result = $this->db->select($sql);
			return $result;
		}
		public function addFolderFile($id_folder,$fname,$path,$secure) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "INSERT INTO GTDFiles(folder_id,user_id,file_name,file_path,secure) VALUES($id_folder,$cur_user_id,'$fname','$path',$secure)";
			$result = $this->db->query($sql);
		}
		public function getUserList() {
			$sql = "SELECT id AS ARRAY_KEY,CONCAT(first_name,' ',middle_name,' ',last_name) AS full_name FROM users ORDER BY id";
			$result = $this->db->select($sql);
			return $result;
		}
		public function addSecureUser($id,$section,$user_id) {
			switch($section) {
				case 1:
					$sql = "INSERT INTO GTDCategories_secure VALUES($id,$user_id)";
					$result = $this->db->query($sql);
				break;
				case 2:
					$sql = "INSERT INTO GTDfolders_secure VALUES($id,$user_id)";
					$result = $this->db->query($sql);
				case 3:
					$sql = "INSERT INTO GTDFiles_secure VALUES($id,$user_id)";
					$result = $this->db->query($sql);
				break;			
			}
		}
		public function getAnotherUserRootCategory($user_id) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;	
			$sql = "SELECT id,secure FROM GTDCategories WHERE user_id = $user_id and parent_id = 0";
			$root_row = $this->db->selectRow($sql);
			$root_id = $root_row['id'];
			$secure = $root_row['secure'];
			if(!$secure) {
				$result['subcategories'][0] = $this->getAnotherUserCategories($root_id,$cur_user_id);
			}
			else {
				$sql = "SELECT user_id FROM GTDCategories_secure WHERE category_id = $root_id";
				$subsecure = $this->db->selectCell($sql);
				if($subsecure == $cur_user_id) {
					$result['subcategories'][0] = $this->getAnotherUserCategories($root_id,$cur_user_id);	
				}
				else {
					$result = null;	
				}	
			}
			return $result;				
		}
		public function getAnotherUserCategories($id,$cur_user_id) {
			$sql = "SELECT id,parent_id,category_name,level,secure FROM GTDCategories WHERE id = $id ORDER BY id";
			$result = $this->db->selectRow($sql);
				$root_id = $result['id'];
				$sql = "SELECT id AS ARRAY_KEY,secure FROM GTDCategories WHERE parent_id = $root_id";
				$nums = $this->db->select($sql);
				foreach($nums as $k => $v) {
					if(!$v['secure']) {
						$result['subcategories'][] = $this->getAnotherUserCategories($k,$cur_user_id);
					}
					else {
						$sql = "SELECT user_id FROM GTDCategories_secure WHERE category_id = $k";
						$secure = $this->db->selectCell($sql);
						if($secure == $cur_user_id) {
							$result['subcategories'][] = $this->getAnotherUserCategories($k,$cur_user_id);
						}
					}		
				}
			return $result;
		}	
		public function getAnotherUserRootFolder($category_id) {			
			$cur_user_id = Project::getUser() -> getDbUser() -> id;	
			$sql = "SELECT id,secure FROM GTDfolders WHERE category_id = $category_id and parent_id = 0";
			$root_row = $this->db->selectRow($sql);
			$root_id = $root_row['id'];
			$secure = $root_row['secure'];
			if(!$secure) {
				$result['subfolders'][0] = $this->getAnotherUserFolders($root_id,$cur_user_id);
			}
			else {
				$sql = "SELECT user_id FROM GTDfolders_secure WHERE folder_id = $root_id";
				$subsecure = $this->db->selectCell($sql);
				if($subsecure == $cur_user_id) {
					$result['subfolders'][0] = $this->getAnotherUserFolders($root_id,$cur_user_id);	
				}
				else {
					$result = null;	
				}	
			}
			return $result;								
		}
		public function getAnotherUserFolders($id,$cur_user_id) {
			$sql = "SELECT id,parent_id,folder_name,level,secure FROM GTDfolders WHERE id = $id ORDER BY id";
			$result = $this->db->selectRow($sql);
			$root_id = $result['id'];
			$sql = "SELECT id AS ARRAY_KEY,secure FROM GTDfolders WHERE parent_id = $root_id";
			$nums = $this->db->select($sql);
			foreach($nums as $k => $v) {
				if(!$v['secure']) {
					$result['subfolders'][] = $this->getAnotherUserFolders($k,$cur_user_id);
				}
				else {
					$sql = "SELECT user_id FROM GTDfolders_secure WHERE folder_id = $k";
					$secure = $this->db->selectCell($sql);
					if($secure == $cur_user_id) {
						$result['subfolders'][] = $this->getAnotherUserFolders($k,$cur_user_id);
					}									
				}
			}
			return $result;
		}	
		public function getAnotherUserFolderFiles($id_folder) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "SELECT id AS ARRAY_KEY,file_name,file_path,secure FROM GTDFiles WHERE folder_id = $id_folder";
			$result_unsort = $this->db->select($sql);
			foreach ($result_unsort as $k => $v) {
				if(!$v['secure']) {
					$result[$k] = $v;
				}
				else {
					$sql = "SELECT user_id FROM GTDFiles_secure WHERE file_id = $k";
					$secure = $this->db->selectCell($sql);
					if($secure == $cur_user_id) {
						$result[$k] = $v;	
					}
				}	
			}
			return $result;
		}				
}		
?>
<?php
class GroupsModel extends BaseModel{
	private $db;
	public function __construct(){
		parent::__construct('groups');
		$this->db = Project::getDatabase();
		$this -> _caches(true, true, true);
	}
	public function selectAllGroups() {
		$sql = "SELECT t1.id, t1.id_user, t1.full_name, t1.description, t1.create_time, t1.access_rule, t2.group_name, t3.access_read, t3.add_subgroup, t3.accept_user, t3.mod_subgroup, t3.mod_photo, t3.make_posts
				FROM groups t1
				LEFT JOIN groups_names t2 ON t1.id_group_name = t2.id
				LEFT JOIN groups_user_access t3 ON t1.id = t3.id_group AND t1.id_user = t3.id_user
				WHERE t1.pid =0";
		$result = $this->db->select($sql);
		return $result;				
	}
	public function addGroup($request) {
		if(is_array($request)) {
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$create_time = time();
			$sql = "INSERT INTO groups(pid,id_user,id_group_name,full_name,description,create_time,access_rule) VALUES({$request['pid']},$cur_user_id,{$request['id_group_name']},'{$request['full_name']}','{$request['description']}','{$create_time}',{$request['access_rule']})";
			$result_id = $this->db->query($sql);
			if($request['access_rule']) {
				foreach ($request['users'] as $id_user) {
					$sql = "INSERT INTO groups_user_access(id_group,id_user,access_read,make_posts) VALUES($result_id,$id_user,1,1)";
					$this->db->query($sql);
				}
			}
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}
	}
	public function alterGroup($request) {
			if(is_array($request)) {
			$create_time = time();
			$sql = "UPDATE groups SET id_group_name = {$request['id_group_name']},full_name = '{$request['full_name']}',description = '{$request['description']}',create_time = '{$create_time}',access_rule = {$request['access_rule']} WHERE id = {$request['id']}";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}			
	}
	public function selectAlterGroup($id_group) {
		$sql = "SELECT t1.id,t1.id_user, t1.full_name,t1.description,t1.create_time,t1.access_rule,t2.group_name FROM groups t1 
				LEFT JOIN groups_names t2 ON t1.id_group_name = t2.id
				WHERE t1.pid = 0 AND t1.id = $id_group";
		$result = $this->db->selectRow($sql);
		return $result;				
	}
	public function deleteGroup($id_group) {
		$sql = "DELETE FROM groups_topic_messages WHERE id_topic IN (SELECT id FROM groups_topics WHERE group_id IN (SELECT id FROM groups WHERE pid = $id_group))";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM groups_topics WHERE group_id IN (SELECT id FROM groups_topics WHERE group_id IN (SELECT id FROM groups WHERE pid = $id_group)";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM groups WHERE pid = $id_group";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM groups WHERE id = $id_group";
		$result = $this->db->query($sql);		
	}	
	public function selectSubGroups($id) {
		$sql = "SELECT t1.id,t1.id_user, t1.full_name,t1.description,t1.create_time,t1.access_rule,t2.group_name FROM groups t1 
				LEFT JOIN groups_names t2 ON t1.id_group_name = t2.id
				WHERE t1.pid = $id";
		$result = $this->db->select($sql);
		return $result;	
	}
	public function addSubGroup($request) {
		if(is_array($request)) {
			$create_time = time();
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "INSERT INTO groups(pid,id_user,id_group_name,full_name,description,create_time,access_rule) VALUES({$request['pid']},$cur_user_id,0,'{$request['full_name']}','{$request['description']}','{$create_time}',0)";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}		
	}
	public function alterSubGroup($request) {
		if(is_array($request)) {
			$create_time = time();
			$sql = "UPDATE groups SET id_group_name = 0,full_name = '{$request['full_name']}',description = '{$request['description']}',create_time = $create_time,access_rule = 0 WHERE id = {$request['pid']}";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}			
	}
	public function selectAlterSubGroup($id) {
		$sql = "SELECT t1.id,t1.id_user, t1.full_name,t1.description,t1.create_time,t1.access_rule,t2.group_name FROM groups t1 
				LEFT JOIN groups_names t2 ON t1.id_group_name = t2.id
				WHERE t1.id = $id";
		$result = $this->db->selectRow($sql);
		return $result;			
	}
	public function deleteSubGroup($id_group) {
		$sql = "DELETE FROM groups_topic_messages WHERE id_topic IN (SELECT id FROM groups_topics WHERE group_id = $id_group)";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM groups_topics WHERE group_id = $id_group";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM groups WHERE id = $id_group";
		$result = $this->db->query($sql);
	}
	public function selectTopics($group_id) {
		$sql = "SELECT id,group_id,id_user,full_name,description,create_time,photo_album FROM groups_topics WHERE group_id = $group_id";
		$result = $this->db->select($sql);
		return $result;			
	}
	public function addTopics($request) {
		if(is_array($request)) {
			$create_time = time();
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			if(!$request['photo_album']) {
				$request['photo_album'] = 0;
			}
			$sql = "INSERT INTO groups_topics(group_id,id_user,full_name,description,create_time,photo_album) VALUES({$request['pid']},$cur_user_id,'{$request['full_name']}','{$request['description']}','{$create_time}',{$request['photo_album']})";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}			
	}
	public function alterTopic($request) {
		$create_time = time();
		if(!$request['photo_album']) {
			$request['photo_album'] = 0;
		}		
		$sql = "UPDATE groups_topics SET full_name = '{$request['full_name']}',description = '{$request['description']}',create_time = '{$create_time}',photo_album = {$request['photo_album']} WHERE id = {$request['tid']} AND group_id = {$request['pid']}";
		$result = $this->db->query($sql);
	}
	public function selectAlterTopic($id_group,$id_topic) {
		$sql = "SELECT id,group_id,id_user,full_name,description,create_time,photo_album FROM groups_topics WHERE group_id = $id_group AND id = $id_topic";
		$result = $this->db->selectRow($sql);
		return $result;			
	}
	public function deleteTopic($id_topic) {
		$sql = "DELTE FROM groups_topic_messages WHERE id_topic = $id_topic";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM groups_topics WHERE id = $id_topic";
		$result = $this->db->query($sql);
	}
	public function selectMessages($topic_id) {
		$sql = "SELECT id,id_user,id_topic,message_name,message_content,create_time FROM groups_topic_messages WHERE id_topic = $topic_id";
		$result = $this->db->select($sql);
		return $result;				
	}
	public function addMessage($request) {
		if(is_array($request)) {
			$create_time = time();
			$cur_user_id = Project::getUser() -> getDbUser() -> id;
			$sql = "INSERT INTO groups_topic_messages(id_user,id_topic,message_name,message_content,create_time) VALUES($cur_user_id,{$request['tid']},'{$request['message_name']}','{$request['message_content']}','{$create_time}')";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}			
	}
	public function selectAlterMessage($topic_id,$message_id) {
		$sql = "SELECT id,id_user,id_topic,message_name,message_content,create_time FROM groups_topic_messages WHERE id_topic = $topic_id AND id = $message_id";
		$result = $this->db->selectRow($sql);
		return $result;			
	}
	public function alterMessage($request) {
		if(is_array($request)) {
			$create_time = time();
			$sql = "UPDATE groups_topic_messages SET id_topic = {$request['tid']},message_name = '{$request['message_name']}',message_content = '{$request['message_content']}',create_time = '{$create_time}' WHERE id = {$request['mid']}";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}			
	}
	public function deleteMessage($id_message) {
		$sql = "DELETE FROM groups_topic_messages WHERE id = $id_message";
		$result = $this->db->query($sql);
	}
	public function getUserList() {
		$sql = "SELECT id AS ARRAY_KEY,CONCAT(first_name,' ',middle_name,' ',last_name) AS full_name FROM users ORDER BY id";
		$result = $this->db->select($sql);
		return $result;
	}	
	public function getGroupUserList($id_group) {
		$sql = "SELECT t1.id AS ARRAY_KEY,CONCAT(t1.first_name,' ',t1.middle_name,' ',t1.last_name) AS full_name, t2.access_read, t2.add_subgroup, t2.accept_user, t2.mod_subgroup, t2.mod_photo, t2.make_posts FROM users t1
		INNER JOIN groups_user_access t2 on (t1.id = t2.id_user)
		WHERE t2.id_group=$id_group
		ORDER BY t1.id";
		$result = $this->db->select($sql);
		return $result;
	}
}		
?>
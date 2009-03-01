<?php
class GroupsModel extends BaseModel{
	private $db;
	public function __construct(){
		parent::__construct('groups');
		$this->db = Project::getDatabase();
		$this -> _caches(true, true, true);
	}
	public function selectAllGroups() {
		$sql = "SELECT t1.id,t1.full_name,t1.description,t1.create_time,t1.access_rule,t2.group_name FROM groups t1 
				LEFT JOIN groups_names t2 ON t1.id_group_name = t2.id
				WHERE t1.pid = 0";
		$result = $this->db->select($sql);
		return $result;				
	}
	public function addGroup($request) {
		if(is_array($request)) {
			$create_time = time();
			$sql = "INSERT INTO groups(pid,id_group_name,full_name,description,create_time,access_rule) VALUES({$request['pid']},{$request['id_group_name']},'{$request['full_name']}','{$request['description']}','{$create_time}',0)";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}
	}
	public function selectSubGroups($id) {
		$sql = "SELECT t1.id,t1.full_name,t1.description,t1.create_time,t1.access_rule,t2.group_name FROM groups t1 
				LEFT JOIN groups_names t2 ON t1.id_group_name = t2.id
				WHERE t1.pid = $id";
		$result = $this->db->select($sql);
		return $result;	
	}
	public function addSubGroup($request) {
		if(is_array($request)) {
			$create_time = time();
			$sql = "INSERT INTO groups(pid,id_group_name,full_name,description,create_time,access_rule) VALUES({$request['pid']},0,'{$request['full_name']}','{$request['description']}','{$create_time}',0)";
			$result = $this->db->query($sql);	
		}
		else {
			throw new TemplateException("Входная переменная - не массив !");
		}		
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
}		
?>
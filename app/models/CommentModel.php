<?php

abstract class CommentModel extends CBaseModel{
	
	/**
	 * ��� ����, ������� ���������� ��� ������ ����� ������������: photo_id, news_id etc.
	 */
	protected $_object_field_name;
	
	
		/**
		 * �������� �� �������!!!, ��� ����, ����� �� ���������� � ����������� ��� ����
		 * ������: parent::__construct('photo_id');
		 */
		function __construct($field_name, $id = null){
			$this -> _object_field_name = $field_name;
			parent::__construct($id);
		}
		
		/**
		 * �������� ���� ������������
		 */
		function loadAll(){
			// TODO::������������ ����������!
			$this -> resetSql();
			$sql = "SELECT * FROM `" . $this->tableNameDB . "`";
			return MySql::query_array($sql);
		}
		
		/**
		 * �������� ���� ������������ ������������
		 */
		function loadByOwner($userId){
			// TODO::������������ ����������!
			$userId = (int)$userId;
			$this -> resetSql();
			if ($userId > 0){
				$sql = "SELECT `" . $this->tableNameDB . "`.*, user.name FROM `" . $this->tableNameDB . "`" .
						" LEFT JOIN user on user.id = `" . $this->tableNameDB . "`.user_id 
						WHERE `user_id` = " . $userId;
				return MySql::query_array($sql);
			} else {
				return array();
			}
		}
		
		/**
		 * �������� ������ ������������ ��������
		 */
		function loadByItem($itemId, $desc = true, $start = null, $end = null){
			if ($desc === true){
				$d = "DESC";
			} else {
				$d = "ASC";
			}
			
			if (($start !== null) && ($end !== null)){
				$l = " LIMIT $start, $end "; 
			} else {
				$l = null;
			}
			
			// TODO::������������ ����������!
			$this -> resetSql();
			$itemId = (int)$itemId;
			if ($itemId > 0){
				$sql = "SELECT SQL_CALC_FOUND_ROWS `" . $this->tableNameDB . "`.*, users.first_name as first_name, users.login as login FROM `" . $this->tableNameDB . "`" .
						" LEFT JOIN users on users.id = `" . $this->tableNameDB . "`.user_id 
						WHERE `".$this -> _object_field_name."` = " . $itemId . " GROUP BY `" . $this->tableNameDB . "`.id ORDER BY `" . $this->tableNameDB . "`.creation_date ".$d." ".$l;
				return MySql::query_array($sql);
			} else {
				return array();
			}
		}
		
		
		/**
		 * ���������� �����������
		 */
		public function addComment($user_id, $avatar_id, $warning_id, $field_id, $text, $mood){
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$this -> resetSql();
			$this -> set('user_id', (int)$user_id);
			$this -> set('avatar_id', (int)$avatar_id);
			$this -> set('warning_id', (int)$warning_id);
			$this -> set($this -> _object_field_name, (int)$field_id);
			$this -> set('text', $text);
			$this -> set('mood', (int)$mood);
			$this -> set('creation_date', date("Y-m-d H:i:s"));
			$this -> set('adm_redacted', 0);
			return $this -> save();
		}
		
		/**
		 * �������� �����������
		 */
		public function delete($user_id, $id){
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$id = (int)$id;
			$user_id = (int)$user_id;
			$this -> resetSql();
			$sql = "DELETE FROM `" . $this->tableNameDB . "`
						WHERE `id` = " . $id . " AND user_id=".$user_id;
			
			return MySql::query($sql);
		}
		
		/**
		 * �������� ���� ������������ �������
		 */
		public function deleteByItem($user_id, $field_id){
			$this -> resetSql();
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$field_id = (int)$field_id;
			if ($field_id > 0){
				$sql = "DELETE FROM `" . $this->tableNameDB . "`
						WHERE `".$this -> _object_field_name."` = " . $field_id . " AND user_id=".(int)$user_id;
				//var_dump($sql);die;
				return MySql::query($sql);
			} else {
				return false;
			}
		}
		
		/**
		 * �������� ��� ����������� ������������
		 */
		public function deleteByOwner($user_id){
			$this -> resetSql();
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$user_id = (int)$user_id;
			if ($user_id > 0){
				$sql = "DELETE FROM `" . $this->tableNameDB . "`
						WHERE `user_id` = " . $user_id;
				return MySql::query($sql);
			} else {
				return false;
			}
		}
		
}
?>
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
		 * ���������� �����������
		 */
		public function addComment($user_id, $avatar_id, $warning_id, $field_id, $text, $mood){
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$this -> resetSql();
			$this -> set('user_id', (int)$user_id);
			$this -> set('avatar_id', (int)$avatar_id);
			$this -> set('warning_id', (int)$warning_id);
			$this -> set($this -> _object_field_name, (int)$field_id);
			$this -> set('text', (int)$text);
			$this -> set('mood', (int)$mood);
			return $this -> save();
		}
		
		/**
		 * �������� �����������
		 */
		public function delete($id = 0){
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$id = (int)$id;
			if ($id > 0){
				$this -> id = $id;
			}
			$this -> resetSql();
			return $this -> delete();
		}
		
		/**
		 * �������� ���� ������������ �������
		 */
		public function deleteByItem($field_id){
			$this -> resetSql();
			// TODO:: �������� ����������� ���� �� ���������/���������� ������
			$field_id = (int)$field_id;
			if ($field_id > 0){
				$sql = "DELETE FROM `" . $this->tableNameDB . "`
						WHERE `".$this -> _object_field_name."` = " . $field_id;
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
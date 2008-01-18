<?php

abstract class CommentModel extends CBaseModel{
	
	/**
	 * Имя поля, которое отличается для разных видов комментариев: photo_id, news_id etc.
	 */
	protected $_object_field_name;
	
	
		/**
		 * Вызывать из потомка!!!, для того, чтобы не передавать в конструктор имя поля
		 * Пример: parent::__construct('photo_id');
		 */
		function __construct($field_name, $id = null){
			$this -> _object_field_name = $field_name;
			parent::__construct($id);
		}
		
		
		/**
		 * Добавление комментария
		 */
		public function addComment($user_id, $avatar_id, $warning_id, $field_id, $text, $mood){
			// TODO:: добавить определение прав на изменение/добавление записи
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
		 * Удаления комментария
		 */
		public function delete($id = 0){
			// TODO:: добавить определение прав на изменение/добавление записи
			$id = (int)$id;
			if ($id > 0){
				$this -> id = $id;
			}
			$this -> resetSql();
			return $this -> delete();
		}
		
		/**
		 * Удаление всех комментариев объекта
		 */
		public function deleteByItem($field_id){
			$this -> resetSql();
			// TODO:: добавить определение прав на изменение/добавление записи
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
		 * Удаление все комментарии пользователя
		 */
		public function deleteByOwner($user_id){
			$this -> resetSql();
			// TODO:: добавить определение прав на изменение/добавление записи
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
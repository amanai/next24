<?php

class CommentModel extends BaseModel{
	
	/**
	 * Имя поля, которое отличается для разных видов комментариев: photo_id, news_id etc.
	 */
	protected $_object_field_name;
	
	
		/**
		 * Вызывать из потомка!!!, для того, чтобы не передавать в конструктор имя поля
		 * Пример: parent::__construct('photo_id');
		 */
		function __construct($table_name, $field_name, $id = 0){
			$this -> _object_field_name = $field_name;
			parent::__construct($table_name);
			if ((int)$id > 0){
				$this -> load($id);
			}
		}
		
		/**
		 * Загрузка всех комментариев пользователя
		 */
		function loadByOwner($user_id, $sortName = null, $sortOrder = "DESC", $defaultSortName = "creation_date"){
			if (is_null($sortName)){
				$sortName = "`".$this->_table."`.".$defaultSortName;
			}
			// TODO::постраничнос считывание!
			$user_id = (int)$user_id;
			$sql = "SELECT SQL_CALC_FOUND_ROWS `" . $this->_table . "`.*, user.name FROM `" . $this->_table . "`" .
					" LEFT JOIN users on users.id = `" . $this->_table . "`.user_id 
					WHERE `" . $this->_table . "`.user_id = ?d ORDER BY $sortName $sortOrder LIMIT ?d,?d";
			$this -> checkPager();
			$result = Project::getDatabase() -> selectPage($this -> _countRecords, $sql, $user_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
		
		/**
		 * Загрузка списка комментариев элемента
		 */
		function loadByItem($item_id, $sortName = null, $sortOrder = "DESC", $defaultSortName = "creation_date"){
			if (is_null($sortName)){
				$sortName = "`".$this->_table."`.".$defaultSortName;
			}
			$item_id = (int)$item_id;
			$sql = "SELECT " .
						" SQL_CALC_FOUND_ROWS " .
						" `" . $this->_table . "`.*, " .
						" users.first_name as first_name, " .
						" users.login as login, " .
						" avatars.id as base_avatar_id, avatars.sys_av_id as sys_av_id,  avatars.path as avatar_path, avatars.av_name as avatar_name,  " .
						" sys_av.path as sys_av_path, " .
						" moods.name as mood_name, " .
						" warning.cause as warning_cause " .
					" FROM `" . $this->_table . "` " .
					" LEFT JOIN users on users.id = `" . $this->_table . "`.user_id " .
					" LEFT JOIN avatars on `" . $this->_table . "`.avatar_id = avatars.id " .
					" LEFT JOIN sys_av on sys_av.id = avatars.sys_av_id " .
					" LEFT JOIN moods on `" . $this->_table . "`.mood = moods.id " .
					" LEFT JOIN warning on `" . $this->_table . "`.warning_id = warning.id " .
					" WHERE " .
					" `" . $this->_table . "`.".$this -> _object_field_name." = ?d " .
					" GROUP BY `" . $this->_table . "`.id " .
					" ORDER BY $sortName $sortOrder " .
					" LIMIT ?d,?d";
					//echo $sql; exit;
			$this -> checkPager();
			$result = Project::getDatabase() -> selectPage($this -> _countRecords, $sql, $item_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
		
		
		/**
		 * Добавление комментария
		 */
		public function addComment($user_id, $avatar_id, $warning_id, $field_id, $text, $mood, $mood_text, $adm_redacted = 0){
			if ((int)$user_id > 0){
			    $fn = $this -> _object_field_name;
			    /*
			    $sql = "
			    INSERT INTO `article_comment` ( `".$fn."` , `user_id` , `avatar_id` , `warning_id` , `mood` , `mod_text` , `adm_redacted` , `text` , `creation_date` )
                VALUES (
                '".$field_id."', '".(int)$user_id."', '".(int)$avatar_id."', '".(int)$warning_id."', '".(int)$mood."', 
                '".stripslashes(htmlspecialchars($mood_text))."', '".(int)$adm_redacted."', '".$text."', '".date("Y-m-d H:i:s")."'
                )
			    ";
			    Project::getDatabase() -> query($sql);
			    return mysql_insert_id();
			    */
				$this -> user_id = (int)$user_id;
				$this -> avatar_id = (int)$avatar_id;
				$this -> warning_id = (int)$warning_id;
				$this -> $fn = $field_id;
				$this -> text = $text;
				$this -> mood = (int)$mood;
				$this -> mood_text = stripslashes(htmlspecialchars($mood_text));
				$this -> creation_date = date("Y-m-d H:i:s");
				$this -> adm_redacted = (int)$adm_redacted;
				return $this -> save();

			} else {
				return false;
			}
		}
		
		public function editComment($user_id, $warning_id, $text, $adm_redacted = 0){
			if ((int)$user_id > 0){
			    //$fn = $this -> _object_field_name;
			    /*
			    $sql = "
			    INSERT INTO `article_comment` ( `".$fn."` , `user_id` , `avatar_id` , `warning_id` , `mood` , `mod_text` , `adm_redacted` , `text` , `creation_date` )
                VALUES (
                '".$field_id."', '".(int)$user_id."', '".(int)$avatar_id."', '".(int)$warning_id."', '".(int)$mood."', 
                '".stripslashes(htmlspecialchars($mood_text))."', '".(int)$adm_redacted."', '".$text."', '".date("Y-m-d H:i:s")."'
                )
			    ";
			    Project::getDatabase() -> query($sql);
			    return mysql_insert_id();
			    */

				$this -> warning_id = (int)$warning_id;
				//$this -> $fn = $field_id;
				$this -> text = $text;
				$this -> adm_redacted = (int)$adm_redacted;
				return $this -> save();

			} else {
				return false;
			}
		}
		
		/**
		 * Удаления комментария
		 */
		public function delete($user_id, $id){
			$sql = "DELETE FROM `" . $this->_table . "`
						WHERE id = ?d AND user_id=?d";
			Project::getDatabase() -> query($sql, (int)$id, (int)$user_id);
		}
		
		/**
		 * Удаление всех комментариев объекта
		 */
		public function deleteByItem($user_id, $field_id){
			$sql = "DELETE FROM `" . $this->_table . "`
					WHERE `".$this -> _object_field_name."` = ?d AND user_id=?d";
			Project::getDatabase() -> query($sql, (int)$field_id, (int)$user_id);
		}
		
		/**
		 * Удаление всех комментариев объекта
		 */
		public function deleteAllByItem($field_id){
			$sql = "DELETE FROM `" . $this->_table . "`
					WHERE `".$this -> _object_field_name."` = ?d";
			Project::getDatabase() -> query($sql, (int)$field_id);
		}
		
		/**
		 * Удаление все комментарии пользователя
		 */
		public function deleteByOwner($user_id){
			$sql = "DELETE FROM `" . $this->tableNameDB . "`
					WHERE user_id = ?d";
			Project::getDatabase() -> query($sql, (int)$user_id);
		}
		
		public function getWarningById($warning_id){
		    $sql = "SELECT cause FROM `warning` WHERE id = ?d ";
			$result = Project::getDatabase() -> selectRow($sql, (int)$warning_id);
			if ($result) return $result['cause'];
			else return '';
		}
}
?>
<?php
	class Users extends CBaseModel{
		public function loginUser($login, $pass){
			$this->resetSql();			
			$this->where('login="'.$login.'"');
			$this->where('pass="'.$pass.'"');
			$this->join('user_types', "user_types.id=users.user_type_id");
			$rez = $this->getOne();
			if(is_array($rez))
				return $rez;
			else 
				return true;
		}
		
		public function login($login, $pass){
			$this->resetSql();			
			$this->where('login="'.$this -> escape($login).'"');
			$this->where('pass="'.$this -> escape($pass).'"');
			$this->join('user_types', "user_types.id=users.user_type_id");
			$rez = $this->getOne();
			if(is_array($rez) && count($rez))
				return $rez;
			else 
				return false;
		}
		
		
		public function getRights($usertypeId){
			$tmp = MySql::query_row("SELECT rights FROM user_types WHERE id='" . $usertypeId . "'");
			return $tmp['rights'];
		}
		
	}
?>

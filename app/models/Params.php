<?php
	class Params extends CBaseModel{
		
		public function getParam($name){
			$this->resetSql();
			$this->where('item_name="'.$name.'"');
			$this->cols('value');
			$rez = $this->getOne();
			if(isset($rez['value'])) return $rez['value'];
			else return null;			
		}
		
		function getParamsGroup($name){
			$this->resetSql();
			$this->where('group_name="'.$name.'"');
			$this->cols('item_name, value');			
			$sqlRez = $this->getAll();
			$rez = array();
			foreach($sqlRez as $item){
				$rez[$item['item_name']] = $item['value'];
			}
			return $rez;
		}
	}
?>
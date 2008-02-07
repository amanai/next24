<?php
	class CParams extends CBaseManager {
		
		public function __construct(){
			
		}
		
		public function getParam($param_group, $name){
			$this->setModel('Params');
			return $this->model->getParam($param_group, $name);
		}
		
		public function getParamsOfGroup($group_name){
			$this->setModel('Params');
			$this->resetSql();
			$this-> join('params_group', 'params_group.id = params.params_group_id AND LOWER(params_group.label)=LOWER("'.$this -> escape($group_name).'")', "INNER");
			$this->cols('params.name as name, params.value as value, params.php_type as php_type');
			return $this->getAll();
		}
	}
?>
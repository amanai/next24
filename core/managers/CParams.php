<?php
	class CParams extends CBaseManager {
		
		public function __construct(){
			$this->setModel('Params');
		}
		
		public function getParam($name){
			return $this->model->getParam($name);
		}
		
		public function getParamsGroup($name){
			return $this->model->getParamsGroup($name);
		}
	}
?>
<?php
	
	class CBaseManager{
		public $inited = false;
		
		protected $model;
		
		public function init(){
			$this->inited = true;
		}
		
		protected function setModel($modelName){
			if(file_exists(MODELS_PATH.$modelName.'.php')){
				require_once(MODELS_PATH.$modelName.'.php');
				$this->model = new $modelName;
			}
		}
	}
?>
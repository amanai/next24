<?php
/**
 * Контролер для управления фотоальбомами
 */
	class PhotoController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this->setModel("Photos");
			parent::__construct($View, $params, $vars);
		}				
		
		
		/**
		 * Вывод топовых фотографий
		 */
		public function TopListAction(){
			
		}
		
		
	}
?>
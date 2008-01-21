<?php
/**
 * Контролер для управления фотоальбомами
 */
	class AlbumController extends CBaseController{
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this->setModel("Album");
			parent::__construct($View, $params, $vars);
		}				
		
		
		/**
		 * Вывод списка последних альбомов.
		 * Кол-во для вывода берется из конфиг параметров: параметр last_per_page
		 */
		public function LastListAction(){
			
		}
		
		/**
		 * Вывод топовых альбомов
		 * Кол-во для вывода берется из конфиг параметров: параметр top_per_page
		 */
		public function TopListAction(){
			
		}
	}
?>
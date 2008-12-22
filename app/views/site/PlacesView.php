<?php
class PlacesView extends BaseSiteView{
	protected $_dir = 'places';
	private $depends=array();
		
		public function __construct(){
			$this->depends=array(
								'geo_type'=>array(),
								'country'=>array('geo_type'),
								'city'=>array('country'),
								'geo_subtype'=>array('city'),
								'geo_place'=>array('geo_subtype')
								);
			parent::__construct();
		}
		
		private function getDependsList($entity_name) {
			$arr=$this->depends[$entity_name];
			$result=$arr;
			foreach ($arr as $item) {
				$result=array_merge($result, $this->getDependsList($item));
			}
			return $result;
		}
		
		private function clearEntityName($entity_name) {
			return str_replace("_id","",$entity_name);
		}
		
		public function isClosed($entity_name) {
			$entity_name=$this->clearEntityName($entity_name);
			$depends=$this->getDependsList($entity_name);
			if (is_array($depends)) {
				foreach ($depends as $depend) {
					$name=$depend.'_id';
					if (!$this->session->$name) return true;
				}
			}
			return false;
		}
		
		public function ListPlaces(){
			$this -> setTemplate(null, 'places_main.tpl.php');
		}
			
		public function _dropdown($name, $message1, $message2) {
			return $this->generateTemplate(null,'dropdown.tpl.php',array('_drop_down_name'=>$name, '_message1'=>$message1, '_message2'=>$message2))
			//$this->assign('_drop_down_name', $name);
			//$this -> setTemplate(null, 'places_main.tpl.php');
		}	
}
?>
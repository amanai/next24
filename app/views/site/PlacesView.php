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
		    $this->_js_files[] = 'jquery.js';
		    $this->_js_files[]='blockUI.js';
		    $this->_js_files[]='ajax.js';
		    $this->_js_files[] = 'places.js';
		    $this->_css_files[] = 'gobjects.css';
		}
		
		private function getDependsList($entity_name) {
			$arr=$this->depends[$entity_name];
			$result=$arr;
			foreach ($arr as $item) {
				$result=array_merge($result, $this->getDependsList($item));
			}
			return $result;
		}
		
		public function getReverceDependsList($entity_name) {
			$result=array();
			foreach ($this->depends as $k=>$d) {
				foreach ($d as $depend) {
					if ($depend==$entity_name) { 
						$result[]=$k; 
						$result=array_merge($result, $this->getReverceDependsList($k));
					}
				}
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
		
		public function ReloadDropDowns($depends) {
			$response = Project::getAjaxResponse();
			if (in_array('country',$depends)) $response -> block('country_block', true, $this->_dropdown('country', 'выберите тип', '- выберите страну -', $this->countries));
			if (in_array('city',$depends)) $response -> block('city_block', true, $this->_dropdown('city', 'выберите страну', '- выберите город -', $this->cities));
			if (in_array('geo_subtype',$depends)) $response -> block('geo_subtype_block', true, $this->_dropdown('geo_subtype', 'выберите город', '- выберите тип -', $this->geo_subtypes));
			if (in_array('geo_place',$depends)) $response -> block('geo_place_block', true, $this->_dropdown('geo_place', 'выберите тип', '- выберите место -', $this->geo_places));
		}
			
		public function _dropdown($name, $message1, $message2, $entities) {
			return $this->generateTemplate(null,'dropdown.tpl.php',array('drop_down_name'=>$name, 'message1'=>$message1, 'message2'=>$message2,  'entities'=>$entities));
		}	
}
?>
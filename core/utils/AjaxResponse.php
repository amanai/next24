<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AppJson.php');

class AjaxResponse{
	
	private $_response = array();
	private $_states = array(array());
	

		function save(){
			array_push($this -> _states, array($this -> _response));
			$this -> clear();
		}
		
		function restore(){
			$this -> _response = array_pop($this -> _states);
		}
		
		function clear(){
			$this -> _response = array();
		}
		
		function location($controller, $action, $params){
			$this -> _response['location'] = Project::getRequest() -> createUrl($controller, $action, $params);
		}
		
		function clearBlock($id){
			$this -> _response['clear_blocks'][] = $id;
		}
		
		public function addBlock($id, $parent_id, $html, $class = null){
			$param = array('id'=>$id, 'parent_id'=>$parent_id, 'html' => $html, 'class' => $class);
			$this -> _response['new_blocks'][] = $param;
		}
		
		public function block($id, $show = true, $html = null){
			$param = array('id'=>$id, 'show'=>(bool)$show);
			if ($show === true){
				$param['html'] = $html;
			}
			$this -> _response['blocks'][] = $param;
		}
		
		public function error($id, $show = true, $msg = null){
			$param = array('id'=>$id, 'show'=>(bool)$show);
			if ($show === true){
				$param['msg'] = $msg;
			}
			$this -> _response['errors'][] = $param;
		}
		
		public function disable($id){
			$this -> _response['disable'][] = $id;
		}
		
		public function enable($id){
			$this -> _response['enable'][] = $id;
		}
		
		public function hide($id){
			$this -> _response['hide'][] = $id;
		}
		
		public function show($id){
			$this -> _response['show'][] = $id;
		}
		
		
		
		public function effect($id, $value, $properties=array()){
			$this -> _response['effects'][] = array("id"=>$id, "effect_name"=>$value, "properties"=>$properties);
		}
		
		
		function getResponse(){
			return AppJson::encode($this -> _response);
		}
		
}
?>

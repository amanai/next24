<?php
class AdminParameterView extends BaseAdminView{
	protected $_dir = 'parameters';
	
		function GroupList($info){
			$number = 1;
			$request = Project::getRequest();
			foreach ($info['group_list'] as &$item){
				$item['edit_link'] = $request -> createUrl($info['edit_controller'], $info['edit_action'], array('id'=>$item['controller_id'])); 
				$item['number'] = $number;
				$number++;
			}
			$this -> setTemplate($this -> _dir, 'main.tpl.php');
			$this -> set($info);
		}
		
		function ParamList($info){
			$number = 1;
			$request = Project::getRequest();
			foreach ($info['param_list'] as &$item){
				$item['number'] = $number;
				$item['delete_link'] = Project::getRequest() -> createUrl($info['delete_controller'], $info['delete_action'], array('id' => $item['id'], 'cid' => $info['controller_id']));
				//$item['delete_link'] = $request -> createUrl($info['delete_controller'], $info['delete_action'], array('id' => $item['id']));
				$number++;
			}
			$info['save_action'] = Project::getRequest() -> createUrl($info['save_controller'], $info['save_action']);
			
			$this -> setTemplate($this -> _dir, 'param_list.tpl.php');
			$this -> set($info);
		}
}
?>
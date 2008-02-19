<?php
class AdminUserTypeView extends BaseAdminView{
	protected $_dir = 'user_group';
	
		private function createList(&$info){
			$number = 1;
			foreach ($info['group_list'] as &$item){
				$item['edit_link'] = AjaxRequest::getJsonParam($info['edit_controller'], $info['edit_action'], array('id'=>$item['id']));
				$item['right_link'] = AjaxRequest::getJsonParam($info['right_controller'], $info['right_action'], array('id'=>$item['id']));
				$item['number'] = $number;
				$number++;
			}
		}
	
		function GroupList($info){
			$this -> createList($info);
			$this -> setTemplate($this -> _dir, 'main.tpl.php');
			$this -> set($info);
		}
		
		function AjaxGroupList($info){
			$this -> createList($info);
			
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'list.tpl.php');
			$response -> clearBlock('edit_block');
			$response -> hide('edit_block');
			$response -> enable('list_block');
			$response -> block('list_block', true, $this -> parse());
		}
		
		function AjaxEdit($info){
			$id = isset($info['edit_data']['id']) ? (int)$info['edit_data']['id'] : 0;
			$response = Project::getAjaxResponse();
			$response -> save();
			$response -> clearBlock($this -> _flesh_messages_block);
			$response -> hide('edit_block');
			$response -> enable('list_block');
			$info['cancel_param'] = $response -> getResponse();
			$response -> restore();
			$info['save_param'] = AjaxRequest::getJsonParam($info['save_controller'], $info['save_action'], array('id'=>$id, 'form_id' => 'edit_form'), "POST");
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'edit.tpl.php');
			$response -> block('edit_block', true, $this -> parse());
			$response -> disable('list_block');
		}
		
		function AjaxControllerList($info){
			$response = Project::getAjaxResponse();
			$response -> save();
			$response -> hide('edit_block');
			$response -> enable('list_block');
			$info['cancel_param'] = $response -> getResponse();
			$response -> restore();
			
			$number = 1;
			foreach($info['controllers_list'] as &$item){
				$item['number'] = $number;
				$item['action_list_link'] = AjaxRequest::getJsonParam($info['action_list_controller'], $info['action_list_action'], array('id'=>$item['id'], 'gid' => $info['user_type_id']));
				
				$number++;
			}
			
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'controller_list.tpl.php');
			$response -> block('edit_block', true, $this -> parse());
			$response -> disable('list_block');
		}
		
		function AjaxActionList($info){
			$response = Project::getAjaxResponse();
			$response -> save();
			$response -> hide('action_list_'.$info['controller_id']);
			//$response -> enable('list_block');
			$info['cancel_param'] = $response -> getResponse();
			$response -> restore();
			$number = 1;
			foreach($info['actions_list'] as &$item){
				$item['number'] = $number;
				
				$item['change_access_link'] = AjaxRequest::getJsonParam($info['change_access_controller'], $info['change_access_action'], array('id'=>$item['id'], 'gid' => $info['user_type_id'], 'cid' => $info['controller_id']));
				
				$number++;
			}
			
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'action_list.tpl.php');
			$response -> block('action_list_'.$info['controller_id'], true, $this -> parse());
			//$response -> disable('list_block');
		}
}
?>
<?php
class AdminUserTypeView extends BaseAdminView{
	protected $_dir = 'user_group';
		function GroupList($info){
			foreach ($info['group_list'] as &$item){
				$item['edit_link'] = AjaxRequest::getJsonParam($item['edit_controller'], $item['edit_action'], array('id'=>$item['id']));
			}
			$this -> setTemplate($this -> _dir, 'main.tpl.php');
			$this -> set($info);
		}
		
		function Edit($info){
			$id = (int)$this -> id;
			$response = Project::getAjaxResponse();
			$info = array();
			$response -> save();
			$response -> hide('edit_user');
			$response -> enable('users_list');
			$info['cancel_param'] = $response -> getResponse();
			$response -> restore();
			
			
			$info['save_param'] = AjaxRequest::getJsonParam($info['save_controller'], $info['save_action'], array('id'=>$id, 'form_id' => 'edit_form'), "POST");
			
			
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'edit.tpl.php');
			$response -> block('edit_block', true, $this -> render());
			$response -> disable('list_block');
			
			
			/*$this -> view -> response($response);
			$this -> setTemplate('user_group', 'edit.tpl.php');*/
		}
}
?>
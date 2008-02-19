<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AdminController.php');
class AdminParameterController extends AdminController{
	
		function __construct(){
			parent::__construct("AdminParameterView");
			
		}
		
		
		function BaseAdminData(){
			parent::BaseAdminData();
			$this -> view -> title = 'Параметры системы';
		}
	
	
		function GroupListAction(){
			
			
			$this -> BaseAdminData();
			$request = Project::getRequest();
			$info = array();

			
			$param_model = new ParamModel;
			$item = array();
			$item['number'] = 1;
			$item['controller_description'] = 'Общие параметры конфигурации';
			$item['count_param'] = $param_model -> count(0);
			$item['controller_id'] = 0;
			$item['label'] = 'Common';

			$model = new ParamGroupModel;
			$info['group_list'] = $model -> loadAll();
			array_unshift($info['group_list'], $item);
			$info['edit_controller'] = null;
			$info['edit_action'] = 'EditGroup';
			$this -> _view -> GroupList($info);
			$this -> _view -> parse();
		}
		
		
		function EditGroupAction($rid = null){
			$this -> BaseAdminData();
			$request = Project::getRequest();
			$info = array();
			
			if ((int)$rid > 0){
				$controller_id = $rid;
			} else {
				$controller_id = (int)$request -> id;
			}
			
			$controller_model = new ControllerModel;
			$controller_model -> load($controller_id);
			
			$param_group_model = new ParamGroupModel;
			if ($controller_id > 0){
				$param_group_model -> loadByLabel($controller_model -> name);
				if ($param_group_model -> id > 0){
					$param_group_id = $param_group_model -> id;
				} else {
					// Group is not exists yet, so create it
					$param_group_model -> label = $controller_model -> name;
					$param_group_id = $param_group_model -> save();
				}
			} else {
				$param_group_id = 0;
			}
			
			$info['controller_id'] = $controller_id;
			$info['param_group_id'] = $param_group_id;
			$info['php_types'] = array(			'string'=>'строка',
												'integer'=>'целое',
												'float'=>'с плавающей точкой'
												);
			
			$param_model = new ParamModel;
			$list = $param_model -> getByGroupId($param_group_id);
			array_push($list, array('id'=>0, 'name'=>'', 'value'=>''));
			$info['param_list'] = $list;
			$info['save_controller'] = null;
			$info['save_action'] = 'SaveParams';
			$info['save_controller'] = null;
			$info['delete_controller'] = null;
			$info['delete_action'] = 'DeleteParam';
			
			$this -> _view -> ParamList($info);
			$this -> _view -> parse();
		}
		
		function SaveParamsAction(){
			$request = Project::getRequest();
			/*echo '<pre>';
			print_r($request -> getKeys());*/
			// TODO:: this id is id from params_group table!
			if (is_array($request -> ids) && count($request -> ids)){
				foreach($request -> ids as $id){
					$id = (int)$id;
					$model = new ParamModel;
					if ($id === 0){
						if (isset($request -> param_name[$id]) && strlen($request -> param_name[$id]) && isset($request -> param_value[$id]) && strlen($request -> param_value[$id])){
							// New param
							$data = array();
						} else {
							// Data for new params is not valid
							continue;
						}
					} else {
						$data = $model -> load($id);
					}
					
					$tmp = $model -> exists($request -> param_group_id, $request -> param_name[$id]);
					if ($tmp !== false){
						if (isset($data['id'])){
							if ((int)$data['id'] === (int)$tmp['id']){
								// Exists param is current item: so ok, we can update it
								$can_update = true;
							} else{
								// Param with the same name alrady exists
								$can_update = false;
							}
						} else {
							// It's new parameter, but name already busy
							$can_update = false;
						}
					} else {
						// Param is not exists, we can add it
						$can_update = true;
					}
					if ($can_update){
						$model -> param_group_id = $request -> param_group_id;
						$model -> name = $request -> param_name[$id];
						$model -> value = $request -> param_value[$id];
						$model -> php_type = $request -> php_type[$id];
						$model -> casting();
						$model -> save();
					} else {
						// TODO:: Flash message that parameter already exists
						$this -> _view -> addFlashMessage(FM::ERROR, "Параметр с таким названием уже существует:". $request -> param_name[$id]);
					}
				}
			}
			$this -> EditGroupAction($request -> controller_id);
			//Project::getResponse() -> redirect($request -> createUrl(null, 'EditGroup', array('id' => $request -> controller_id)));
		}
		
		function DeleteParamAction(){
			$request = Project::getRequest();
			$model = new ParamModel;
			$model -> delete($request -> id);
			Project::getResponse() -> redirect($request -> createUrl('AdminParameter', 'EditGroup', array('id' => $request -> cid)));
		}
		
		
}
?>
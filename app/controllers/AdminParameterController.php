<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AdminController.php');
class AdminParameterController extends AdminController{
	
	
	
	
		function GroupListAction(){
			$this -> BaseAdminData();
			$this -> setModel("Controllers_list");
			$list = $this -> model -> getAll();
			$counter = 2;
			foreach($list as &$item){
				$item['number'] = $counter;
				$counter++;
			}
			array_unshift($list, array('number'=>1, 'id'=>0, 'name'=>'CommonParameters', 'description'=>'����� ���������, �� ����������� �� � ������ �����������'));
			$this -> view -> group_list = $list;
			$this -> view -> content .= $this->view->render(VIEWS_PATH.'admin/parameters/group_list.tpl.php');
			$this -> view -> display();
		}
		
		
		function EditGroupAction(){
			$this -> BaseAdminData();
			// TODO:: id is ID from controllers_list!
			$group_id = (int)$this -> id;
			$this -> setModel("Controllers_list");
			$this -> model -> resetSql();
			$this -> model -> setData($this -> model -> getById($group_id));
			$group_id = (int)$this -> model -> get('id');
			$controller_name = $this -> model -> get('name');
			$this -> view -> controller_name = $controller_name;
			$this -> view -> controller_id = $group_id;
			$this -> view -> controller_description = $this -> model -> get('description');
			
			if ($group_id > 0){
				// TODO:: check param group, if not exists - create group
				$this -> setModel("ParamsGroup");
				$this -> model -> resetSql();
				$this -> model -> where('label="'.$this -> model -> escape($controller_name).'"');
				$group_data = $this -> model -> getOne();
				if (is_array($group_data) && count($group_data)){
					$param_group_id = (int)$group_data['id'];
				} else {
					// Group not exists
					$this -> model -> resetSql();
					$this -> model -> set('label', $controller_name);
					$param_group_id = (int)$this -> model -> save();
				}
			} else {
				$param_group_id = 0;
			}
			$this -> view -> param_group_id = $param_group_id;
			$this -> view -> php_types = array(
												'string'=>'string',
												'integer'=>'integer',
												'float'=>'float',
												'array'=>'array'
												);
			
			$this -> setModel("Params");
			$this -> model -> resetSql();
			$this -> model -> where('params_group_id='.(int)$param_group_id);
			$list = $this -> model -> getAll();
			$counter = 1;
			foreach($list as &$item){
				$item['number'] = $counter;
				$counter++;
			}
			array_push($list, array('number'=>$counter, 'id'=>0, 'name'=>'', 'value'=>''));
			$this -> view -> group_list = $list;
			$this -> view -> content .= $this->view->render(VIEWS_PATH.'admin/parameters/param_list.tpl.php');
			$this -> view -> display();
		}
		
		function SaveParamsAction(){
			// TODO:: this id is id from params_group table!
			if (is_array($this -> ids) && count($this -> ids)){
				foreach($this -> ids as $id){
					$id = (int)$id;
					$this -> setModel("Params");
					$this -> model -> resetSql();
					if ($id === 0){
						if (isset($this -> param_name[$id]) && strlen($this -> param_name[$id]) && isset($this -> param_value[$id]) && strlen($this -> param_value[$id])){
							// New param
						} else {
							// Data for new params is not valid
							continue;
						}
					} else {
						$this -> model -> setData($this -> model -> getById($id));
					}
					$this -> model -> set('params_group_id', $this -> id);
					$this -> model -> set('name', $this -> param_name[$id]);
					$this -> model -> set('value', $this -> param_value[$id]);
					$this -> model -> set('php_type', $this -> php_type[$id]);
					$this -> model -> casting();
					$this -> model -> save();
				}
			}
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('AdminParameter', 'EditGroup', array('id' => $this -> controller_id)));
		}
		
		function DeleteParamAction(){
			$this -> setModel('Params');
			$this -> model -> id = (int)$this -> id;
			$this -> model -> delete();
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('AdminParameter', 'EditGroup', array('id' => $this -> controller_id)));
		}
		
		
}
?>
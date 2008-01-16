<?php
	class RightsController extends CBaseController{
				
/*		function __construct($View=null, $params = array(), $vars = array()){			
			parent::__construct($View, $params, $vars);
		}		*/
		
		public function IndexAction(){
			$this->initCommonData();
			
			$this->setModel("User_types");
			$this->model->resetSql();
			$this->model->cols('id, name');
			$userTypes = $this->model->getAll();
			
			isset($this->params['userType']) ? $userType = $this->params['userType'] : $userType = 0;
			
			$this->view->assign('userTypes', $userTypes);
			$this->view->assign('userType', $userType);
			$this->view->assign('title', '”правление правами прользователей');
			
			$list = $this->drawList($userType);
			$this->view->assign('rightsData', $list);
			$this->view->render(VIEWS_PATH.'admin/rigtsAdmin.tpl.php');
			$this->view->display();
		}
		
		public function SaveAction(){
			$actions = $this->params['action'];
			$subactions = $this->params['subaction'];

			$controllerRez = array();
			if(is_array($subactions)){
				foreach($subactions as $controllerName=>$controllerData){
					foreach($controllerData as $actionName=>$actionData){
						foreach($actionData as $subactionName=>$tmp){
							$controllerRez[$controllerName][$actionName][] = $subactionName;
						}
					}
				}
			}
			
			if(is_array($actions)){
				foreach($actions as $controllerName=>$controllerData){
					foreach($controllerData as $actionName=>$tmp){
						if(!isset($controllerRez[$controllerName][$actionName]))
							$controllerRez[$controllerName][$actionName] = array();
					}
				}
			}		
			
			$this->setModel("User_types");
			$rights = serialize($controllerRez);
			
			$this->model->load($this->params['userType']);
			$this->model->set("rights", $rights);
			$this->model->update();
			
			$router = getManager('CRouter');
			$router->redirect($router->createUrl("Rights", "Index", array("userType"=>$this->params['userType'])));
		}
		
		private function drawList($typeId){	
			$this->setModel("Users");
			$rights = @unserialize($this->model->getRights($typeId));
			$this->setModel("Controllers_list");
			$this->model->resetSql();
			$controllers = $this->model->getAll();
			
			$rez = array();
			foreach($controllers as $controller){
				$actionsRez = array();
				$this->setModel("Actions_list");
				$this->model->resetSql();
				$this->model->where("controller_id=".$controller['id']);
				$actions = $this->model->getAll();
			
				foreach($actions as $action){
					$subactionsRez = array();
					$this->setModel("Subactions_list");
					$this->model->resetSql();
					$this->model->where("action_id=".$action['id']);
					$subactions = $this->model->getAll();
				
					foreach($subactions as $subaction){
						$allowed = in_array($subaction['name'], $rights[$controller["name"]][$action["name"]]);
						$subactionsRez[$subaction['id']] = array("name"=>$subaction['name'], "allowed"=>$allowed);
					}
					
					$allowed = isset($rights[$controller["name"]][$action["name"]]);
					$actionsRez[$action['id']] = array("name"=>$action["name"], "allowed"=>$allowed, "subactions"=>$subactionsRez);
				}
				$allowed = isset($rights[$controller["name"]]);
				$rez[$controller['id']] = array("name"=>$controller["name"], "allowed"=>$allowed, "actions"=>$actionsRez);
			}

			return $rez;
		}
		
	}
?>
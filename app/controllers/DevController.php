<?php
	class DevController extends SiteController{
		private $request;
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "DevView";
			}
			$this->request = Project::getRequest();
			parent::__construct($view_class);
		}		
		
		/*
		 * *********** Работа с контроллерами *************
		 */
		function ControllersAction(){
			$c = new ControllerModel;
			$c->_caches(); // Не брать данные из кеша
			$this -> _view -> assign('controllers', $c -> loadAll('admin, name'));
			if ($this->request -> id) {
				$this -> _view -> assign('econtroller', $c -> load($this->request->id));
			}
			$this -> _view -> Controllers();
			$this -> _view -> parse();
		}
		
		function ControllerSaveAction() {
			if ($this->request->id&&$this->request->name) {
				$c = new ControllerModel;
				$c -> load($this->request->id);
				$c -> name = $this->request->name;
				$c -> description = $this->request->description;
				$c -> admin = $this->request->admin;
				$c -> __set('default', $this->request->default);
				$c -> save();
			}
			$this->ControllersAction();
		}
		
		function ControllerAddAction() {
			if ($this->request->name) {
				$c = new ControllerModel;
				$c -> name = $this->request->name;
				$c -> description = $this->request->description;
				$c -> admin = $this->request->admin;
				$c -> __set('default', $this->request->default);
				$id = $c -> save();
				Project::getResponse()->redirect($this->request->createUrl('Dev', 'Controllers', array('id'=>$id)));
			}
			Project::getResponse()->redirect($this->request->createUrl('Dev', 'Controllers'));
		}
		
		function ControllerDeleteAction() {
			if ($this->request->id) {
				$c = new ControllerModel;
				$c->delete($this->request->id);
			}
			Project::getResponse()->redirect($this->request->createUrl('Dev', 'Controllers'));
		}
		
		/*
		 * *********** Работа с действиями *************
		 */
		
		function ActionsAction(){
			$c = new ControllerModel;
			$c->_caches();
			$c->load($this->request->cid);
			$this -> _view -> assign('controller',  $c);
			
			$a = new ActionModel;
			$a->_caches();
			$this -> _view -> assign('actions',  $a -> loadByController($c->id));
			
			if ($this->request -> id) {
				$this -> _view -> assign('eaction', $a -> load($this->request->id));
			}
			$this -> _view -> Actions();
			$this -> _view -> parse();
		}
		
		function ActionSaveAction() {
			if ($this->request->id&&$this->request->name) {
				$a = new ActionModel;
				$a -> load($this->request->id);
				$a -> name = $this->request->name;
				$a -> page_title = $this->request->page_title;
				$a -> request_key = $this->request->request_key;
				$a -> __set('default', $this->request->default);
				$a -> save();
			}
			$this->ActionsAction();
		}
		
		function ActionAddAction() {
			if ($this->request->name) {
				$a = new ActionModel;
				$a -> controller_id = $this->request->cid;
				$a -> name = $this->request->name;
				$a -> page_title = $this->request->page_title;
				$a -> request_key = $this->request->request_key;
				$a -> __set('default', $this->request->default);
				
				$id = $a -> save();
				Project::getResponse()->redirect($this->request->createUrl('Dev', 'Actions', array('id'=>$id, 'cid'=>$this->request->cid)));
			}
			Project::getResponse()->redirect($this->request->createUrl('Dev', 'Actions', array('cid'=>$this->request->cid)));
		}
		
		function ActionDeleteAction() {
			if ($this->request->id) {
				$a = new ActionModel;
				$a->delete($this->request->id);
			}
			Project::getResponse()->redirect($this->request->createUrl('Dev', 'Actions', array('cid'=>$this->request->cid)));
		}
			
	}
?>
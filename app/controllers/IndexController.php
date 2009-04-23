<?php
	class IndexController extends SiteController{
	    private $tabs_map = array();
		
		function __construct($view_class = null){
		    $this->tabs_map['main_tabs'][0] = array('name'=>'Новости');
			$this->tabs_map['main_tabs'][1] = array('name'=>'Статьи');
		    $this->tabs_map['main_tabs'][2] = array('name'=>'Фотоальбом');
		    $this->tabs_map['main_tabs'][3] = array('name'=>'Вопросы-ответы');
		    
			if ($view_class === null){
				$view_class = "HomeView";
			}
			parent::__construct($view_class);
		}
		
		public function IndexAction(){	
			//$this -> BaseSiteData();	
			$v_request = Project::getRequest();
    		$v_session = Project::getSession();
    		$request_keys = $v_request->getKeys();			
			$userModel = new UserModel();
			$user = Project::getUser() -> getDbUser();
			$tabs_map = $this->tabs_map;
			$needToSave = false;
			$desktops = unserialize($userModel->getDesktops());
			if(!$request_keys['d']) {
			if ($user->id){
			    $tabs_map['selected_tabs'] = unserialize($user->tabs_map);
			    if (!$tabs_map['selected_tabs']){
			        $needToSave = true;
			    }
			}
			if (!$user->id || !$tabs_map['selected_tabs']){
			    $tabs_map['selected_tabs'][0] = array('id'=>'0', 'selected'=>true);
			    $tabs_map['selected_tabs'][1] = array('id'=>'1', 'selected'=>true);
			    $tabs_map['selected_tabs'][2] = array('id'=>'2', 'selected'=>true);
			    $tabs_map['selected_tabs'][3] = array('id'=>'3', 'selected'=>true);
			}
			$this -> _view -> assign('tabs_map', $tabs_map);
			$this -> _view -> assign('user_id', $user->id);
			if ($needToSave) $userModel->saveUserTabsMap($user->id, $tabs_map['selected_tabs']);
			}
			$this -> _view -> assign('desktops', $desktops);
			if(!isset($request_keys['d'])) {
				$this -> _view -> Home();
			}
			else {
				$this -> _view -> HomeBlank();	
			}
			$this -> _view -> parse();
		}
		
		// Ajax, меняет состав табс-меню для пользователя
		public function ChangeIndexTabsAction(){
    	    $userModel = new UserModel();
    	    $user = Project::getUser() -> getDbUser();
    	    $request = Project::getRequest();
    	    $tabs_map = $this->tabs_map;
			$checkBoxes = $request->checkBoxes;
			
			if ($user){
			    $old_selected_tabs = unserialize($user->tabs_map);
			    foreach ($checkBoxes as $tabActiveId){
			        $tabs_map['selected_tabs'][] = array('id'=>$tabActiveId, 'selected'=>true);
			    }
			    foreach ($old_selected_tabs as $old_tab){
			        if (!in_array($old_tab['id'], $checkBoxes)){
                        $tabs_map['selected_tabs'][] = array('id'=>$old_tab['id'], 'selected'=>false);
			        }
			    }
			    if (!$checkBoxes) $tabs_map['selected_tabs'][0]['selected'] = true;
			    $userModel->saveUserTabsMap($user->id, $tabs_map['selected_tabs']);
			}else{
			    return;
			}
			$message['tabs_map'] = $tabs_map;
			$message['user_id'] = $user->id;
    	    
    	    
    	    
    	    $this -> _view -> returnTabs($message);
            $this -> _view -> ajax();
		}
		public function addDesktopAction() {
			//echo '!!!!!!!!!!!!!';
			$v_request = Project::getRequest();
    		$v_session = Project::getSession();
    		$request_keys = $v_request->getKeys();			
			$userModel = new UserModel();
			$desktops = unserialize($userModel->getDesktops());
			//$desktops[] = $v_request['tab_name'];
			$desktops[] = 'Новая вкладка';
			$desktops = serialize($desktops);
			$userModel->addDesktop($desktops);
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Index", "Index"));
		}	
	}
?>
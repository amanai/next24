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
			$this -> BaseSiteData();	
			$userModel = new UserModel();
			$user = Project::getUser() -> getDbUser();
			$tabs_map = $this->tabs_map;
			
			if ($user){
			    $tabs_map['selected_tabs'] = unserialize($user->tabs_map);
			}else {
			    $tabs_map['selected_tabs'][0] = array('id'=>'0', 'selected'=>true);
			    $tabs_map['selected_tabs'][1] = array('id'=>'1', 'selected'=>true);
			    $tabs_map['selected_tabs'][2] = array('id'=>'2', 'selected'=>true);
			    $tabs_map['selected_tabs'][3] = array('id'=>'3', 'selected'=>true);
			}
			
			$this -> _view -> assign('tabs_map', $tabs_map);
			//$userModel->saveUserTabsMap($user->id, $tabs_map['selected_tabs']);
			
			$this -> _view -> Home();
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
			    foreach ($old_selected_tabs as $old_tab){
			        if (in_array($old_tab['id'], $checkBoxes)){
			            $selected = true;
			        }else{
			            $selected = false;
			        }
			        $tabs_map['selected_tabs'][] = array('id'=>$old_tab['id'], 'selected'=>$selected);
			    }
			    if (!$checkBoxes) $tabs_map['selected_tabs'][0]['selected'] = true;
			    $userModel->saveUserTabsMap($user->id, $tabs_map['selected_tabs']);
			}else{
			    return;
			}
			$message['tabs_map'] = $tabs_map;
    	    
    	    
    	    
    	    $this -> _view -> returnTabs($message);
            $this -> _view -> ajax();
		}
		
	}
?>
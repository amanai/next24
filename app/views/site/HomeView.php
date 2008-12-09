<?php
class HomeView extends BaseSiteView{
	
    public function getTabsNames($tabs_map){
        $htmlStr = "";
        foreach ($tabs_map['selected_tabs'] as $tab){
            if ($tab['selected']){
                $tab_id = $tab['id'];
                $tab_name = $tabs_map['main_tabs'][$tab_id]['name'];
                $htmlStr .= '
                    <div onmouseout="TabOut(this);" onmouseover="TabOver(this);" id="tab'.$tab_id.'" class="tab"><a onclick="return ActivateTab('.$tab_id.');" href="#">'.$tab_name.'</a> <a onclick="return UserCloseTab('.$tab_id.');" href="#"><img height="11" width="8" src="'.$this->image_url.'w3.png"/></a></div>
                ';
            }
        }
        return $htmlStr;
    }
    
    public function getAddTabsInputs($tabs_map){
        $htmlStr = "";
        foreach ($tabs_map['selected_tabs'] as $tab){
            if ($tab['selected']) $checked = 'checked="checked"'; else $checked = '';
            $tab_id = $tab['id'];
            $tab_name = $tabs_map['main_tabs'][$tab_id]['name'];
            $htmlStr .= '<input name="tabInputs" type="checkbox" '.$checked.' value="'.$tab_id.'" id="manager_tab'.$tab_id.'"/> '.$tab_name.'<br/>';
        }
        return $htmlStr;
    }
    
    public function getTabsPages($tabs_map){
        $htmlStr = "";
        foreach ($tabs_map['selected_tabs'] as $tab){
                $tab_id = $tab['id'];
                $tab_name = $tabs_map['main_tabs'][$tab_id]['name'];
                $htmlStr .= '
                    <div id="page'.$tab_id.'" class="tab-page">
                    '.$tab_name.'
                    </div>
                ';
        }
        return $htmlStr;
    }
    
    
    // PAGE
	function Home(){
	    $this->_js_files[] = 'jquery.js';
	    $this->_js_files[]='blockUI.js';
	    $this->_js_files[]='ajax.js';
	    $this->_js_files[]='tabs_main.js';
	    $this->_css_files[] = 'tabs_main.css';
		$this -> setTemplate(null, 'home.tpl.php');
	}
	// END PAGE
	
	
	// AJAX
	
	function returnTabs($message){
	    $response = Project::getAjaxResponse();
	    $tabs_map = $message['tabs_map'];
	    $htmlTopTabs = $this->getTabsNames($tabs_map);
	    $htmlInputs = $this->getAddTabsInputs($tabs_map);
	    
		$response -> block('top_tabs', true, $htmlTopTabs);
		$response -> block('AddTabsInputs', true, $htmlInputs);
		$response -> runFunction('CloseAllTabs(1)');
	}
	// END AJAX
}
?>
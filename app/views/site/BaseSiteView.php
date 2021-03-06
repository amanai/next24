<?php
class BaseSiteView extends BaseView{
	protected $_js_files;
	protected $_css_files;
	
	function __construct(){
		$user = Project::getUser() -> getShowedUser();
		$this->assign('showed_user_profile',$user->data());
		$this -> _base_dir = 'site';
	//	$this -> _js_files=array('sys.js', 'tab.js','jquery-1.3.2.js','ui.core.js','ui.draggable.js','ui.droppable.js','dropdown.js');
	//	$this -> _js_files=array('jquery-1.3.2.js','ui.core.js','ui.draggable.js','ui.droppable.js');
	//	$this -> _js_files=array('dropdown.js');
	//	$this -> _js_files=array('sys.js');
	//	$this -> _js_files=array('jquery.js','dropdown.js');
	//	$this -> _js_files=array('sys.js', 'tab.js','jquery-1.3.2.min.js','ui.core.js','ui.draggable.js','ui.droppable.js','dropdown.js');
		$this -> _js_files=array('jquery.min.js','dropdown.js');
		$this -> _css_files=array('screen.css');
		parent::__construct();
	}
	public function unhtmlentities ($string) {
		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);
		return strtr ($string, $trans_tbl);
	}		
}
?>

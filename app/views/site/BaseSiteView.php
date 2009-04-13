<?php
class BaseSiteView extends BaseView{
	protected $_js_files;
	protected $_css_files;
	
	function __construct(){
		$this -> _base_dir = 'site';
		$this -> _js_files=array('sys.js', 'tab.js','jquery.js','dropdown.js');
		$this -> _css_files=array('screen.css');
		parent::__construct();
	}
}
?>

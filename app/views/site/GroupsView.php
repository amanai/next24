<?php
class GTDView extends BaseSiteView{
	protected $_dir = 'groups';
	private $_stack;
	
	public function __set($name,$var) {
		$this->_stack[$name] = $var;
	}
	public function groupsView() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtd.tpl.php');
	//	$this->set($data);
	}	
}		
?>
<?php
class DefaultPagerView extends BaseAdminView{
	
		function show(IDbPager $pager, $controller = null, $action = null, $params = array()){
			$this -> setTemplate(null, 'default_pager.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', $pager -> getPageCount());
			$this -> assign('current_page_number', $pager -> getPageNumber());
			return $this -> parse();
		}
}
?>
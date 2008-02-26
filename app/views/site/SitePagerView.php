<?php
class SitePagerView extends BaseSiteView{
	
		function show(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null){
			$this -> setTemplate(null, 'pager.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('current_user', $user);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', (int)$pager -> getPageCount());
			$this -> assign('current_page_number', $pager -> getPageNumber());
			return $this -> parse();
		}
		
		function show2(IDbPager $pager, $controller = null, $action = null, $params = array(), $user = null){
			$this -> setTemplate(null, 'pager2.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('current_user', $user);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', (int)$pager -> getPageCount());
			$this -> assign('current_page_number', $pager -> getPageNumber());
			return $this -> parse();
		}
}
?>
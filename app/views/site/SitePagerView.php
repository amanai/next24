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
		
		function show3($controller = null, $action = null, $params = array(), $pages_number, $current_page_number){
			$this -> setTemplate(null, 'pager2.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('current_user', $user);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', $pages_number);
			$this -> assign('current_page_number', $current_page_number);
			return $this -> parse();
		}
		
		function show_ajax($controller = null, $action = null, $params = array(), $pages_number, $current_page_number){
			$this -> setTemplate(null, 'pager_ajax.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('current_user', $user);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', $pages_number);
			$this -> assign('current_page_number', $current_page_number);
			return $this -> parse();
		}
		
		function getPagesNumber($record_count, $record_on_page){
		    $div=$record_count/$record_on_page;
		    if (($div-intval($div))==0) $one=0; else $one=1;
    	    $pages_number=intval($div)+$one; // количество страниц
    	    return $pages_number;
		}
}
?>
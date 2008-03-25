<?php

class ArticlePagerView extends BaseSiteView{
	
	function ShowPager($count_pages, $current_page, $controller = null, $action = null, $params = array(), $user = null){
			$this -> setTemplate(null, 'pager2.tpl.php');
			$this -> assign('current_controller', $controller);
			$this -> assign('current_action', $action);
			$this -> assign('current_user', $user);
			$this -> assign('pager_params', $params);
			$this -> assign('pages_number', (int)$count_pages);
			$this -> assign('current_page_number', (int)$current_page);
			return $this -> parse();
	}
	
}

?>
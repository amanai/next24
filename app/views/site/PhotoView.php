<?php
class PhotoView extends BaseSiteView{
	protected $_dir = 'album';
	
		function PhotoList($info){
			
			$pagerView = new SitePagerView();
			$info['list_pager_html'] = $pagerView -> show($info['list_pager'], $info['list_controller'], $info['list_action'], $info['list_user']);
			$this -> setTemplate(null, 'photo_list.tpl.php');
			$this -> set($info);
		}
}
?>
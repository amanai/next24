<?php
class AlbumView extends BaseSiteView{
	protected $_dir = 'album';
	
		function AlbumList($info){
			$pagerView = new SitePagerView();
			$info['list_pager_html'] = $pagerView -> show($info['list_pager'], $info['list_controller'], $info['list_action'], $info['list_user']);
			$this -> setTemplate(null, 'list.tpl.php');
			$this -> set($info);
		}
		
		function AlbumMenu($info){
			$this -> setTemplate(null, 'album_menu_list.tpl.php');
			$this -> set($info);
		}
		
		function ControlPanel(){
			$this -> setTemplate(null, 'control_panel.tpl.php');
		}
}
?>
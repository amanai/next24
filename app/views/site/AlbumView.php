<?php
class AlbumView extends BaseSiteView{
	protected $_dir = 'album';
	
		function AlbumList($info){
			/*$pagerView = new SitePagerView();
			$info['list_pager_html'] = $pagerView -> show($info['list_pager'], $info['list_controller'], $info['list_action'], $info['list_user']);*/
			if (!isset($info['left_panel'])){
				$info['left_panel'] = true;
			}
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
		
		function CreateForm($info){
			$info['tab_name'] = 'Создание фотоальбома';
			$info['access_list'] = HelpFunctions::getAccessList();
			$this -> setTemplate(null, 'create_album.tpl.php');
			$this -> set($info);
		}
		
		function UploadForm($info){
			$info['tab_name'] = 'Загрузка фотографий';
			$info['access_list'] = HelpFunctions::getAccessList();
			$this -> setTemplate(null, 'upload_photo.tpl.php');
			$this -> set($info);
		}
}
?>
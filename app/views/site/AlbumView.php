<?php
class AlbumView extends BaseSiteView{
	protected $_dir = 'album';
	
		function AlbumList($info){
			$this -> setTemplate(null, 'list.tpl.php');
			$this -> set($info);
		}
}
?>
<?php
class AlbumView extends BaseSiteView{
	protected $_dir = 'users';
	
		function AlbumList(){
			$this -> setTemplate(null, 'list.tpl.php');
			
		}
}
?>
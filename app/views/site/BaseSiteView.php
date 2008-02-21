<?php
class BaseSiteView extends BaseView{
	
		function __construct(){
			$this -> _base_dir = 'site';
			parent::__construct();
		}
}
?>

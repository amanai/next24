<?php
class BaseAdminView extends BaseView{
	
		function __construct(){
			$this -> _base_dir = 'admin';
			parent::__construct();
		}
}
?>

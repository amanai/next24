<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
		<?php 
		echo $this->viewCategoryName();
		echo $this->viewTreeCategories();
		$v_request = Project::getRequest();
		$temp = $v_request->getKeys();
		print '<pre>';
		print_r($temp);
		print '</pre>';
		
		
		?>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>	
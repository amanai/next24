<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
		<?php 
		echo $this->viewFolderName();
		echo '<br /><br />';
		echo $this->loadFileView();	
		echo '<br />';
		echo $this->TreeFilesView();	
		?>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>	
<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
		<div style="float:left;">
		<?php echo $this->viewTreeCategories();	?>
		</div>
		<div style="float: right;">
			<?php echo $this->viewSelectUserList();	?>
		</div>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>	
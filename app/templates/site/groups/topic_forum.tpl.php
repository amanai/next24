<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	
	<div class="tab-page tab-page-selected">
		<div>
			<?php echo $this->createMessagesTree();	?>
		</div>
		<hr />
		<div>
			<?php echo $this->createNewMessageForm();	?>
		</div>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>	
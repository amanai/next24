<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
	<div class="debate-page">
		<input type="hidden" name="currEtap" id="currEtap" value="Results" />
		<input type="hidden" name="refreshNow" id="refreshNow" value="0" />				
		<ul class="view-filter clearfix">
			<?php include($this -> _include('../tab_panel.tpl.php')); ?>
		</ul>
	</div>
<!-- /debate-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
	<div class="columns-page clearfix">
		<div class="main"><div class="wrap">
			<?php echo $this -> flash_messages; ?>
			<?php include($this -> _include('/form_upload.tpl.php')); ?>
			</div></div>
			<!-- /main -->
			<div class="sidebar">
				<?php echo $this -> control_panel;?>
				<div class="navigation">
					<div class="title">
						<h2>Фотоальбомы</h2>
						<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
					</div>
					<ul class="nav-list">
						<?php echo $this -> album_menu;?>							
					</ul>
				</div>
			</div>
		<!-- /sidebar -->
	</div>
				<!-- /columns-page -->
	<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
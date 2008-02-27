<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab"><?php echo $this -> tab_name;?></h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<tr>
							<td class="next24_right">
								<table width="100%" height="100%" cellpadding="0">
									<tr>
										<td class="next24u_left">
										<!-- левый блок -->
											<?php echo $this -> album_menu;?>
											<?php echo $this -> control_panel;?>
										<!-- /левый блок -->
						</td>
						<td class="next24u_right">
							<div class="info" id="flash_message"><?php echo $this -> flash_messages; ?></div>
							<!-- Создание нового альбома -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
							<?php include($this -> _include('/form_upload.tpl.php')); ?>
							</div></div></div></div>
							<!-- /Создание нового альбома -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
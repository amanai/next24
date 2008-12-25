<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">
					<!-- Фотоальбом -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<tr>
							<td class="next24u_left">
								<table width="100%" height="100%" cellpadding="0">
									<tr>
										<td class="next24u_left">
										<!-- левый блок -->
											<?php echo $this -> album_menu;?>
											<?php echo $this -> control_panel;?>
										<!-- /левый блок -->
										</td>
									</tr>
								</table>
						</td>
						<td class="next24u_right">
							<?php echo $this -> flash_messages; ?>
							<!-- Создание нового альбома -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
							<?php include($this -> _include('/form_album.tpl.php')); ?>
							</div></div></div></div>
							<!-- /Создание нового альбома -->
						</td>
					</tr>
					</table>
					<!-- /Фотоальбом -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
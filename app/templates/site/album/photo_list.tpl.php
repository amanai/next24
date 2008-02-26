<?php include($this -> _include('../header.tpl.php')); ?>
			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">Фотоальбом</h2>
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
							<table class="photo_table">
								<?php foreach($this->photo_list as $key => $item){ ?>
									<?php if ($key%4 == 0){ ?><tr><?php } ?>
										<td>
											<div class="block_ee1" style="width: 160px;">
												<div class="block_ee2">
													<div class="block_ee3">
														<div class="block_ee4">
															<div class="block_title">
																<h2><a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a></h2>
															</div>
															<div style="width: 140px; height: 112px; text-align: center;">
																<a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>"><img src="<?php echo ($item['thumbnail'] ===false)?$this -> image_url.'noimage.gif' :$item['thumbnail'];?>" width="140" /></a>
															</div>
															<div class="block_title2">
																<a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a><br />
																<span id="micro"><?php echo date("j F Y", strtotime($item['creation_date']));?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
								<?php }?>
							</table>
							
							<br/><br/><br/>

							
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
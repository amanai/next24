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
								<style type="text/css">
									@import url(<?php echo $this -> css_url;?>show_photo.css);
								</style>
								<div class="block_ee1">
									<div class="block_ee2">
										<div class="block_ee3">
											<div class="block_ee4">
												<div class="block_title">		
													<div class="block_title_left"><h2>
														<a href="<?php echo PhotoController::getAlbumUrl($this->album_id, $this->photo_owner_login);?>"><?php echo $this->album_name;?></a>&nbsp;&raquo;&nbsp;<?php echo $this->photo_name;?>
													</h2>
													</div>
													<div class="block_title_right"><?php echo date("j F Y", strtotime($this->photo_creation_date));?></div>
												</div>
												<center>
													<div class="photoRating">
														Рейтинг фотографии: <?php echo round($this->photo_rating, 2); ?><br>
														Количество голосов: <?php echo $this->photo_voices; ?>
													</div>
													<?php if ($this->photo_info['path'] !== false) { ?>
													<img src="<?php echo $this->photo_file; ?>" id="iborder"/>
													<?php } else { ?>
														<img src="<?php echo $this -> image_url; ?>noimage.gif" id="iborder"/>
													<?php } ?>
													<br><br /><br />
													<?php if ($this->can_vote === true){?>
														<form action="<?php echo $this->createUrl('Photo', 'RatePhoto');?>" method="post">
															<input type="hidden" name="id" value="<?php echo $this->photo_id;?>" />
															<table>
																<tr align="center">
																	<td>-5</td>
																	<td>-4</td>
																	<td>-3</td>
																	<td>-2</td>
																	<td>-1</td>
																	<td>0</td>
																	<td>1</td>
																	<td>2</td>
																	<td>3</td>
																	<td>4</td>
																	<td>5</td>
																<tr align="center">
																	<td><input type="radio" name="rate_value" value="-5" /></td>
																	<td><input type="radio" name="rate_value" value="-4" /></td>
																	<td><input type="radio" name="rate_value" value="-3" /></td>
																	<td><input type="radio" name="rate_value" value="-2" /></td>
																	<td><input type="radio" name="rate_value" value="-1" /></td>
											
																	<td><input type="radio" name="rate_value" value="0" checked="checked" /></td>
																	<td><input type="radio" name="rate_value" value="1" /></td>
																	<td><input type="radio" name="rate_value" value="2" /></td>
																	<td><input type="radio" name="rate_value" value="3" /></td>
																	<td><input type="radio" name="rate_value" value="4" /></td>
																	<td><input type="radio" name="rate_value" value="5" /></td>
																</tr>
																<tr>
																	<td colspan="11" align="center">
																		<input type="submit" value="Оценить фото" />
																	</td>
																</tr>
															</table>
														</form>
													<?php } else { ?>
															Ваш голос принят.
													<?php } ?>	
												</center>
											
											</div>
										</div>
									</div>
								</div>
							</table>
							
							<br/><br/><br/>
							Список фото альбома
					<!-- Комменты -->
						Комменты
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
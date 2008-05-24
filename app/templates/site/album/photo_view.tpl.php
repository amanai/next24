<?php include($this -> _include('../header.tpl.php')); ?>
			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
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
								<style type="text/css">
									@import url(<?php echo $this -> css_url;?>show_photo.css);
								</style>
								<div class="block_ee1">
									<div class="block_ee2">
										<div class="block_ee3">
											<div class="block_ee4">
												<div class="block_title">		
													<div class="block_title_left">
														<h2>
															<a href="<?php echo PhotoController::getAlbumUrl($this->album_id, $this->photo_owner_login);?>"><?php echo $this->album_name;?></a>
															&nbsp;&raquo;&nbsp;<?php echo $this->photo_name;?>
														</h2>
													</div>
													<div class="block_title_right"><?php echo date("j F Y", strtotime($this->photo_creation_date));?></div>
												</div>
												<center>
													<?php if ($this -> have_rating === true) {?>
													<div class="photoRating">
														Рейтинг фотографии: <?php echo round($this->photo_rating, 2); ?><br>
														Количество голосов: <?php echo $this->photo_voices; ?>
													</div>
													<?php } ?>
													<div>
														<?php if ($this->photo_info['path'] !== false) { ?>
														<img src="<?php echo $this->photo_file; ?>" id="iborder"/>
														<?php } else { ?>
															<img src="<?php echo $this -> image_url; ?>noimage.gif" id="iborder"/>
														<?php } ?>
													</div>
													<div>
														<?php
															if ($this -> have_rating === true) { 
																if ($this -> can_vote === true){
																	include($this -> _include('../form_vote.tpl.php'));
																} else {
																	echo 'Ваш голос принят';
																}
															}
														?>
													</div>
												</center>
											
											</div>
										</div>
									</div>
								</div>
							<br/><br/><br/>
							<?php echo $this -> bottom_list;?>
					<!-- Комменты -->
							<?php echo $this -> comment_list;?>
							<?php 
								if ($this -> is_logged){
									include($this -> _include('../form_add_comment.tpl.php'));
								}
								  
							?>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
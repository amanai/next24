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
									@import url(<?php echo CSS_URL;?>show_photo.css);
								</style>
								<div class="block_ee1">
									<div class="block_ee2">
										<div class="block_ee3">
											<div class="block_ee4">
												<div class="block_title">		
													<div class="block_title_left"><h2>
														<a href="<?php echo PhotoController::getAlbumUrl($this->album_id);?>"><?php echo $this->album_name;?></a>&nbsp;&raquo;&nbsp;<?php echo $this->photo_name;?>
													</h2>
													</div>
													<div class="block_title_right"><?php echo date("j F Y", strtotime($this->photo_creation_date));?></div>
												</div>
												<center>
													<div class="photoRating">
														Рейтинг фотографии: <?php echo round((($this->photo_info['voices'] > 0)?$this->photo_info['rating']/($this->photo_info['voices']):0), 2); ?><br>
														Количество голосов: <?php echo $this->photo_info['voices']; ?>
													</div>
													<?php if ($this->photo_info['path'] !== false) { ?>
													<img src="<?php echo $this->photo_file; ?>" id="iborder"/>
													<?php } else { ?>
														<img src="<?php echo IMG_URL; ?>noimage.gif" id="iborder"/>
													<?php } ?>
													<br><br /><br />
													<?php if ($this->can_rate === true){?>
														<form action="<?php echo $this->createUrl('Photo', 'RatePhoto');?>" method="post">
															<input type="hidden" name="id" value="<?php echo $this->photo_info['id'];?>" />
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

							<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<table class="neighbours">
												<?php foreach($this->photo_list as $key => $item){ ?>
													<?php if ($key%5 == 0){ ?><tr><?php } ?>
														<td class="neigh5">
															<a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>">
																<?php if ($item['thumbnail'] !== false){ ?>
																	<img src="<?php echo BASE_URL.$item['thumbnail']; ?>" id="iborder"/>
																<?php } else { ?>
																	<img src="<?php echo IMG_URL; ?>noimage.gif" id="iborder"/>
																<?php } ?>
															</a>
															<br>
																<a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>"><?php echo $item['name']; ?></a>
																				<br />
										
															<div class="ndate"><?php echo date("j F Y", strtotime($item['creation_date']));?></div>
														</td>
												<?php }?>
											</table>
										</div>
									</div>
								</div>
							</div>
							
							
							
					<!-- Комменты -->
						<?php foreach($this->comment_list as $key => $item){ ?>
							<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div class="block_title" id="comment[21]">
												<div class="block_title_left">
													<h2><a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a></h2>
												</div>
												<div class="block_title_right">
													<span class="dellink"> (<a href="<?php echo $this->createUrl('Photo', 'CommentDelete', array('photo_id'=>$item['photo_id'],'id'=>$item['id']));?>" >Удалить комментарий</a>)</span><?php echo date("j F Y H:i", strtotime($item['creation_date']));?>
												</div>
											</div>
										</div>
											
										<div>
											<?php echo $item['text'];?>					
										</div>
										<div class="rmb14">
										</div>
									</div>
								</div>
							</div>
						<?php }?>
						<form action="<?php echo $this->createUrl('Photo', 'Comment');?>" method="post">
						    <input type="hidden" name="id" value="<?php echo $this->photo_info['id'];?>" />
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
								<table width="100%">
								<tr>
									<td><h2>Оставить комментарий</h2></td>
								</tr>
						
								<tr>
									<td><textarea name="comment" style="width: 100%; height: 100px;"></textarea></td>
								</tr>
								<tr>
									<td align="right" style="padding-right: 5px;"><input type="submit" name="Submit" value="Комментировать"></td>
								</tr>
								</table>
							</div></div></div></div>
							</form>
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
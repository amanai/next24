<?php include($this -> _include('../header.tpl.php')); ?>
			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab"><?php echo $this -> tab_name;?></h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
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
								<?php if ($this -> can_edit) { ?>
									<form action="<?php echo $this -> createUrl('Album', 'ListSave'); ?>" method="post">
								<?php } ?>
								<?php foreach($this->album_list as $key => $item){ ?>
									<?php if ($key%4 == 0){ ?><tr><?php } ?>
										<td>
											<div class="block_ee1" style="width: 160px;">
												<div class="block_ee2">
													<div class="block_ee3">
														<div class="block_ee4">
															<div class="block_title">
																<?php if ($this -> can_edit) { ?>
																	<input type="hidden" name="album_id[<?php echo $item['id'];?>]" value="<?php echo $item['id'];?>" />
																	<input type="text" name="album_name[<?php echo $item['id'];?>]" value="<?php echo $item['name'];?>" />
																<?php } else { ?>
																	<h2><a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a></h2>
																<?php } ?>
															</div>
															<div style="width: 140px; height: 112px; text-align: center;">
																<a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>"><img src="<?php echo ($item['thumbnail'] ===false)?$this -> image_url.'noimage.gif' :$item['thumbnail'];?>" width="140" /></a>
															</div>
															<div class="block_title2">
																<a href="<?php echo  UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a><br />
																<span id="micro"><?php echo date("j F Y", strtotime($item['creation_date']));?></span>
															</div>
															<?php if ($this -> can_edit) { ?>
																<div class="block_title2">
																	<div>
																		<select style="" name="album_access[<?php echo $item['id'];?>]">
																			<?php foreach ($this -> access_list as $key=>$value){?>
																				<option value="<?php echo $key;?>" <?php if ((int)$key === (int)$item['access']) {echo 'selected';} ?>><?php echo $value;?></option>
																			<?php } ?>
																		</select>
																	</div>
																	<div>
																		На главной: <input type="checkbox" name="is_onmain[<?php echo $item['id'];?>]" <?php if (1 === (int)$item['is_onmain']) {echo 'checked';} ?> />
																	</div>
																	<div>
																		Удалить: <input type="checkbox" name="delete[<?php echo $item['id'];?>]"   />
																	</div>
																</div>
															<?php } ?>
														</div>
													</div>
												</div>
											</div>
										</td>
								<?php }?>
								<?php if ($this -> can_edit) { ?>
										<tr><td><input type="submit" value="Сохранить" /></td></tr>
									</form>
								<?php } ?>
							</table>
							<!-- листинг -->
							<!-- TODO::INCLUDE PAGER HERE -->
							<?php echo $this -> album_list_pager; ?>
							<!-- /листинг -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
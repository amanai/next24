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
											<div class="block_ee1"><div class="block_ee2">
												<div class="block_ee3">
													<div class="block_ee4">
														<div class="block_title"><h2>Фотоальбомы</h2></div>
															<?php foreach($this->album_list as $key => $item){ ?>
																<p>
																	<?php if ($this->album_id != $item['id']){ ?><a href="<?php echo BASE_URL;?>Photo/Album/id:<?php echo $item['id'];?>"><?php } ?><img src="<?php echo IMG_URL;?>/folder.png" width="15" height="12" id="ico2" /><?php echo $item['name'];?><?php if ($this->album_id != $item['id']){ ?></a><?php } ?>
																	
																	<?php if ($this->album_owner) {?>
																	<a href="<?php echo $this->router->createUrl('Photo', 'Edit', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>edit.gif" alt="Редактировать альбом" class="editbtn" height="12" width="11"></a>
																	<?php }?>
																</p>
															<?php } ?>
														</div>
													</div>
												</div>
											</div>
											<?php if ($this->album_owner) {?>
												<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
													<div class="block_title"><h2>Управление альбомами</h2></div>
													<p><a href="<?php echo $this->router->createUrl('Album', 'CreateForm');?>">Создать альбом</a></p>
													<p><a href="<?php echo $this->router->createUrl('Album', 'UploadForm');?>">Загрузить фотографии</a></p>
													<p><a href="<?php echo $this->router->createUrl('Album', 'List');?>">Список альбомов</a></p>
												</div></div></div></div>
											<?php } ?>
				
									<!-- /левый блок -->
				
						
						</td>
						<td class="next24u_right">
							<form  action="<?php echo $this->router->createUrl('Photo', 'Save');?>" method="post">
							<table class="photo_table">
								<?php foreach($this->photo_list as $key => $item){ ?>
									<?php if ($key%4 == 0){ ?><tr><?php } ?>
										<td>
											<div class="block_ee1" style="width: 160px;">
												<div class="block_ee2">
													<div class="block_ee3">
														<div class="block_ee4">
															<div class="block_title">
																<input type="hidden" name="photo_ids[<?php echo $item['id'];?>]" value="<?php echo $item['id'];?>" />
																<input type="text" name="photo_name[<?php echo $item['id'];?>]" value="<?php echo $item['name'];?>" />
															</div>
															<div style="width: 140px; height: 112px; text-align: center;">
																<a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>"><img src="<?php echo ($item['thumbnail'] ===false)?IMG_URL.'noimage.gif' :BASE_URL.$item['thumbnail'];?>" width="140" /></a>
															</div>
															<div class="block_title2">
																<span id="micro">Участвует в рейтинге</span> &nbsp; <input type="checkbox" name="photo_rating[<?php echo $item['id'];?>]" <?php if ($item['is_rating'] == 1) echo 'checked'; ?> class="delcheck" /><br />
																<span id="micro">Обложка альбома</span> &nbsp; <input type="radio" name="thumb_photo" value="<?php echo $item['id'];?>" class="delcheck" <?php if ($item['id'] == $this->album_thumbnail_id){echo 'checked';} ?> /><br />
																<span id="micro">Удалить</span> &nbsp;<input type="checkbox" name="photo_del[<?php echo $item['id'];?>]" class="delcheck" />		
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
								<?php }?>
							</table>
							<input type="submit" value="Сохранить изменения" />
							<br/><br/><br/>

							<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<table class="neighbours">
												<?php foreach($this->album_list as $key => $item){ ?>
													<?php if ($key%5 == 0){ ?><tr><?php } ?>
														<td class="neigh1">
															<?php if ($this->album_id != $item['id']){ ?>
																<a href="<?php echo BASE_URL;?>Photo/Album/id:<?php echo $item['id'];?>"><?php echo $item['name'];?></a>
															<?php } else { ?>
																<b><?php echo $item['name'];?></b>
															<?php } ?>
															<br/>
															<div class="ndate"><?php echo date("j F Y", strtotime($item['creation_date']));?></div>
														</td>
												<?php }?>
											</table>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
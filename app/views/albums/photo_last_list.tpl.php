			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 2 )</script>
				<div class="tab-page">
					<h2 class="tab">Топ фотографий</h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- левый блок -->
								<?php if (is_array($this -> userData['album_list'])) {?>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div class="block_title"><h2>Фотоальбомы</h2></div>
										<?php foreach ($this -> userData['album_list'] as $item) {?>
											<p><a href="<?php echo $this->router->createUrl('Photo', 'Album', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>folder.png" id="ico2" height="12" width="15"><?php echo $item['name'];?></a>&nbsp;&nbsp;
											<?php if ($this->userData['album_owner']) {?>
											<a href="<?php echo $this->router->createUrl('Photo', 'Edit', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>edit.gif" alt="Редактировать альбом" class="editbtn" height="12" width="11"></a>
											<?php } ?>
											</p>
										<?php } ?>
									</div></div></div></div>
								<?php } ?>
								<?php if ($this->userData['album_owner']) {?>
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
							<table class="photo_table">
								<?php foreach($this->userData['photo_list'] as $key => $item){ ?>
									<?php if ($key%4 == 0){ ?><tr><?php } ?>
										<td>
											<div class="block_ee1" style="width: 160px;">
												<div class="block_ee2">
													<div class="block_ee3">
														<div class="block_ee4">
															<div class="block_title">
																<h2><a href="<?php echo $this->router->createUrl('Photo', 'View', array('id'=>$item['photos_id']));?>"><?php echo $item['name'];?></a></h2>
															</div>
															<div style="width: 140px; height: 112px; text-align: center;">
																<a href="<?php echo $this->router->createUrl('Photo', 'View', array('id'=>$item['photos_id']));?>"><img src="<?php echo ($item['thumbnail'] ===false)?IMG_URL.'noimage.gif' :BASE_URL.$item['thumbnail'];?>" width="140" /></a>
															</div>
															<div class="block_title2">
																<a href="<?php echo $this->router->createUrl('Album', 'View', array('id'=>$item['album_id']));?>"><?php echo $item['album_name'];?></a><br />
																<span id="micro"><?php echo date("j F Y", strtotime($item['creation_date']));?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
								<?php }?>
							</table>
							<!-- листинг -->
							<div class="listing_div_c">
								<li class="listing">
									<?php if ($this->userData['current_page_number'] > 0) { ?>
										<a href="<?php echo  $this->router->createUrl('Album', 'User', array('pn'=>($this->userData['current_page_number']-1), 'id'=>$this->userData['album_owner_id']));?>" title="Предыдущая страница">«</a>
									<?php } ?>
									<?php for($i = 0; $i < $this->userData['pages_number']; $i++){ ?>
										<?php if ($this->userData['current_page_number'] == $i) { ?>
											<a class="active"><?php echo ($i+1);?></a>
										<?php } else { ?>
											<a href="<?php echo  $this->router->createUrl('Album', 'User', array('pn'=>$i, 'id'=>$this->userData['album_owner_id']));?>"><?php echo ($i+1);?></a>
										<?php } ?>
									<?php } ?>
									<?php if ($this->userData['current_page_number'] < $this->userData['pages_number'] - 1) { ?>
										<a href="<?php echo  $this->router->createUrl('Album', 'User', array('pn'=>($this->userData['current_page_number']+1), 'id'=>$this->userData['album_owner_id']));?>" title="Следующая страница">»</a>
									<?php } ?>
									
								</li>

							</div>
							<!-- /листинг -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
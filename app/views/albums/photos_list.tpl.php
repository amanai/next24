			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>
				<div class="tab-page">
					<h2 class="tab">Топ фотографий</h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<?php if (is_array($this -> userData['album_list']) || $this->userData['album_owner']) {?>
							<td class="next24u_left">
								<!-- левый блок -->
									<?php if (is_array($this -> userData['album_list'])) {?>
										<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
											<div class="block_title"><h2>Фотоальбомы</h2></div>
											<?php foreach ($this -> userData['album_list'] as $item) {?>
												<p><a href="#"><img src="<?php echo IMG_URL; ?>folder.png" id="ico2" height="12" width="15"><?php echo $item['name'];?></a>&nbsp;&nbsp;
												<?php if ($this->userData['album_owner']) {?>
												<a href="<?php echo BASE_URL; ?>Album/Edit"><img src="<?php echo IMG_URL; ?>edit.gif" alt="Редактировать альбом" class="editbtn" height="12" width="11"></a>
												<?php } ?>
												</p>
											<?php } ?>
										</div></div></div></div>
									<?php } ?>
									<?php if ($this->userData['album_owner']) {?>
										<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
											<div class="block_title"><h2>Управление альбомами</h2></div>
											<p><a href="<?php echo BASE_URL; ?>Album/CreateForm">Создать альбом</a></p>
											<p><a href="<?php echo BASE_URL; ?>Photo/UploadForm">Загрузить фотографии</a></p>
											<p><a href="<?php echo BASE_URL; ?>Album/List">Список альбомов</a></p>
										</div></div></div></div>
									<?php } ?>
								<!-- /левый блок -->
							</td>
						<?php } ?>
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
																<h2><a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>"><?php echo $item['name'];?></a></h2>
															</div>
															<div style="width: 140px; height: 112px; text-align: center;">
																<a href="<?php echo BASE_URL;?>Photo/View/id:<?php echo $item['id'];?>"><img src="<?php echo ($item['thumbnail'] ===false)?IMG_URL.'noimage.gif' :BASE_URL.$item['thumbnail'];?>" width="140" /></a>
															</div>
															<div class="block_title2">
																<a href="#ССылка на profile пользователя"><?php echo $item['login'];?></a><br />
																<span id="micro"><?php echo date("j F Y", strtotime($item['creation_date']));?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
								<?php }?>
							</table>
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
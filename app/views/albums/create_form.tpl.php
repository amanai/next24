			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">Фотоальбом</h2>
					<!-- ПРОФИЛЬ -->
					<table width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- левый блок -->
								<?php if (is_array($this -> album_list)) {?>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div class="block_title"><h2>Фотоальбомы</h2></div>
										<?php foreach ($this -> album_list as $item) {?>
											<p><a href="#"><img src="<?php echo IMG_URL; ?>folder.png" id="ico2" height="12" width="15"><?php echo $item['name'];?></a>&nbsp;&nbsp;
												<a href="<?php echo $this->router->createUrl('Album', 'Edit', array('id'=>$item['id']));?>"><img src="<?php echo IMG_URL; ?>edit.gif" alt="Редактировать альбом" class="editbtn" height="12" width="11"></a>
											</p>
										<?php } ?>
									</div></div></div></div>
								<?php } ?>
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Управление альбомами</h2></div>
									<p><a href="<?php echo $this->router->createUrl('Album', 'CreateForm');?>">Создать альбом</a></p>
									<p><a href="<?php echo $this->router->createUrl('Album', 'UploadForm');?>">Загрузить фотографии</a></p>
									<p><a href="<?php echo $this->router->createUrl('Album', 'List');?>">Список альбомов</a></p>
								</div></div></div></div>
							<!-- /левый блок -->
						</td>
						<td class="next24u_right">
							<!-- Создание нового альбома -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
							<form action="<?php echo $this->router->createUrl('Album', 'Create');?>" method="post">
								<h1>Создание нового альбома</h1>
								<br />
								<table>
								<tr>
									<td width="100" valign="top">Название альбома</td>

									<td>
										<input type="text" name="album_name" style="width: 300px;"><br />
										<span id="micro2">Кто сможет смотреть и комментировать этот альбом.</span>
									</td>
								</tr>
								<tr>
									<td valign="top">Уровень доступа</td>
									<td>

										<select style="width: 300px;" name="album_access">
											<option value="1">для всех</option>
											<option value="2">только для друзей</option>
											<option value="0">только для себя</option>
										</select><br />
										<span id="micro2">В какой альбом будет загружено изображение.</span>
									</td>

								</tr>
								<tr>
									<td colspan="2" align="right"><input type="submit" value="Создать альбом" /></td>
								</tr>
								</table>
							</form>
							</div></div></div></div>
							<!-- /Создание нового альбома -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
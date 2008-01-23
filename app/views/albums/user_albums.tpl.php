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
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Фотоальбомы</h2></div>
									<?php foreach ($this -> userData['album_list'] as $item) {?>
										<a href="#"><?php echo $item['name'];?></a><br />
									<?php } ?>
								</div></div></div></div>
							
								<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
									<div class="block_title"><h2>Управление альбомами</h2></div>
									<a href="#">Создать альбом</a><br />
									<a href="#">Загрузить фотографии</a><br />
									<a href="#">Список альбомов</a>
								</div></div></div></div>
							<!-- /левый блок -->
						</td>
						<td class="next24u_right">
							<!-- Загрузка изображений -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

								<h1>Загрузка изображений</h1>
								<span id="micro2">Вы можете загружать файлы, не превышающие размером 4 мегабайта.<br />Можно загружать PNG, JPG, GIF изображения.</span>
								<br /><br />
								
								<form action="<?php echo BASE_URL;?>Album/Upload" method="post" enctype="multipart/form-data">
									<table>
										<tr>
											<td width="100">Файл</td>
											<td><input type="file" style="width: 300px;" name="picture" /><br /></td>
										</tr>
										<tr>
											<td width="100">Название</td>
											<td><input type="text" style="width: 300px;" name="pic_name" /><br /></td>
										</tr>
										<tr>
											<td width="100">В рейтинге</td>
											<td><input type="checkbox" name="rating" /><br /></td>
										</tr>
										<tr>
											<td width="100">На главной</td>
											<td><input type="checkbox" name="on_main" /><br /></td>
										</tr>
										<tr>
											<td valign="top">Уровень доступа</td>
											<td>
		
												<select style="width: 300px;" name="access">
													<option value="1">для всех</option>
													<option value="2">только для друзей</option>
													<option value="0">только для себя</option>
												</select><br />
												<span id="micro2">Кто сможет смотреть и комментировать этот альбом.</span>
											</td>
		
										</tr>
										<tr>
											<td valign="top">Альбом</td>
											<td>
												<select style="width: 300px;" name="album_id">
													<?php foreach ($this -> userData['album_list'] as $item) {?>
													<option value=<?php echo (int)$item['id'];?>><?php echo $item['name'];?></option>
													<?php } ?>
												</select><br />
												<span id="micro2">В какой альбом будет загружено изображение.</span>
		
											</td>
										</tr>
										<tr>
											<td colspan="2" align="right"><input type="submit" value="Загрузить" /></td>
										</tr>
									</table>
								</form>

							</div></div></div></div>
							<!-- /Загрузка изображений -->


							<!-- Создание нового альбома -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

								<h1>Создание нового альбома</h1>
								<br />
								<table>
								<tr>
									<td width="100" valign="top">Название альбома</td>

									<td>
										<input type="text" style="width: 300px;"><br />
										<span id="micro2">Кто сможет смотреть и комментировать этот альбом.</span>
									</td>
								</tr>
								<tr>
									<td valign="top">Уровень доступа</td>
									<td>

										<select style="width: 300px;">
											<option>для всех</option>
											<option>только для друзей</option>
											<option>только для себя</option>
										</select><br />
										<span id="micro2">В какой альбом будет загружено изображение.</span>
									</td>

								</tr>
								<tr>
									<td colspan="2" align="right"><input type="submit" value="Создать альбом" /></td>
								</tr>
								</table>

							</div></div></div></div>
							<!-- /Создание нового альбома -->


							<!-- Управление альбомами -->
							<h1>Управление альбомами</h1>
							<br />

							<table class="photo_table">
							<tr>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />
											<a href="#">Удалить</a>				
										</div>

									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">

											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />
											<a href="#">Удалить</a>				
										</div>
									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />
											<a href="#">Удалить</a>				
										</div>

									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">

											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />
											<a href="#">Удалить</a>				
										</div>
									</div></div></div></div>
								</td>
							</tr>

							<tr>

								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />

											<a href="#">Удалить</a>				
										</div>
									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>

										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />
											<a href="#">Удалить</a>				
										</div>
									</div></div></div></div>
								</td>

								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>
										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />

											<a href="#">Удалить</a>				
										</div>
									</div></div></div></div>
								</td>
								<td>
									<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
										<div align="center" class="block_title">
											<input type="text" value="Boris" style="width: 140px;" />
										</div>

										<img src="<?php echo IMG_URL?>x1.png" width="140" height="112" id="iborder" />
										<div class="block_title2">
											<span id="micro">Публиковать на главной</span> &nbsp; <input type="radio" /><br />
											<a href="#">Удалить</a>				
										</div>
									</div></div></div></div>
								</td>

							</tr>
							</table>

							<input type="submit" value="Сохранить изменения" />
							<!-- /Управление альбомами -->
						</td>
					</tr>
					</table>
					<!-- /ПРОФИЛЬ -->
				</div>

			</div>
			<!-- /Главный блок, с вкладками (Контент) -->
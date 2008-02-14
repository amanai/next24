			<!-- Главный блок, с вкладками (Контент) -->
			<div class="tab-page" id="modules-cpanel">
				<script type="text/javascript">var tabPane1 = new WebFXTabPane( document.getElementById( "modules-cpanel" ), 1 )</script>

				<div class="tab-page">
					<h2 class="tab">Блог</h2>
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
														<div class="block_title"><h2><? echo $this->blog_info['title'];  ?></h2></div>
															<?php require('blog_left_tree.tpl.php'); ?>
														</div>
													</div>
												</div>
											</div>
											<?php require('blog_control_panel.tpl.php'); ?>
				
									<!-- /левый блок -->
				
						
						</td>
						<td class="next24u_right">
							<!-- Создание нового раздела -->
							<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
								<form action="<?php echo $this->router->createUrl('Blog', 'PostSave');?>" method="post">
									<input type="hidden" name="post_id" value="<?php echo (int)$this->post_info['id']; ?>"><br />
									<h1><?php if((int)$this->post_info['id'] === 0) echo 'Новый пост'; else echo 'Редактирование поста';?></h1>
									<br />
	
									<table>
									<tr>
										<td width="100" valign="top">Название</td>
	
										<td>
											<input type="text" name="post_name" style="width: 300px;" value="<?php echo $this->post_info['title']; ?>"><br />
											<span id="micro2">Кто сможет смотреть и комментировать этот раздел.</span>
										</td>
									</tr>
									<tr>
										<td width="100" valign="top">Раздел</td>
										<td>
											<select style="width: 300px;" name="post_branch">
												<?php foreach($this->branch_list as $key => $item){ ?>
														<option <?php if($this->post_info['ub_tree_id'] == $item['id']) echo 'selected'; ?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
												<?php } ?>
												
											</select><br />
											<span id="micro2">Привязка к разделу блога.</span>
										</td>
	
									</tr>
									<tr>
										<td width="100" valign="top">Метка каталога</td>
										<td>
											???
											<span id="micro2">Привязка к разделу каталога.</span>
										</td>
	
									</tr>
									<tr>
										<td valign="top">Уровень доступа</td>
										<td>
											<select style="width: 300px;" name="post_access">
												<option value="1">для всех</option>
												<option value="2">только для друзей</option>
												<option value="0">только для себя</option>
											</select><br />
											<!--<span id="micro2">В какой альбом будет загружено изображение.</span>-->
										</td>
									</tr>
									<tr>
										<td valign="top">Короткий текст</td>
										<td>
											<textarea name="small_text"  style="width:300px;height:100px;"><?php echo $this->post_info['small_text']; ?></textarea><br />
											<span id="micro2">Small text</span>
										</td>
									</tr>
									<tr>
										<td valign="top">Полный текст</td>
										<td>
											<textarea name="full_text" style="width:300px;height:200px;"><?php echo $this->post_info['full_text']; ?></textarea><br />
											<span id="micro2">Full text</span>
										</td>
									</tr>
									<tr>
										<td valign="top">Разрешить комментировать</td>
										<td>
											<input type="checkbox" name="allowcomments" <?php if((int)$this->post_info['allowcomments'] > 0) echo 'checked'; ?> />
											<span id="micro2">Пользователи могут комментировать пост</span>
										</td>
									</tr>
									<tr>
										<td valign="top">Настроение автора</td>
										<td>
											<select style="width: 300px;" name="post_mood">
												<option value="0">----</option>
												<?php foreach($this->mood_list as $key => $item){ ?>
														<option <?php if($this->post_info['mood'] == $item['id']) echo 'selected'; ?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
												<?php } ?>
											</select><br />
											<span id="micro2">Фразы настроения</span>
										</td>
									</tr>
									<tr>
										<td valign="top">Статус в "лучших за день"</td>
										<td>
											<select style="width: 300px;" name="post_best_status">
												<option value="0">не учавствует</option>
												<option value="1">отправлен на модерацию</option>
												<option value="2">одобрен модератором</option>
												<option value="3">отклонен модератором</option>
											</select><br />
											<span id="micro2">как быть с этим?????????????????????</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="Сохранить" /></td>
	
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
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
								<form action="<?php echo $this->router->createUrl('Blog', 'SaveBranch');?>" method="post">
									<input type="hidden" name="branch_id" value="<?php echo (int)$this->branch_info['id']; ?>"><br />
									<h1><?php if($this->new_branch == true) echo 'Создание нового раздела'; else echo 'Редактирование раздела';?></h1>
									<br />
	
									<table>
									<tr>
										<td width="100" valign="top">Название раздела</td>
	
										<td>
											<input type="text" name="branch_name" style="width: 300px;" value="<?php echo $this->branch_info['name']; ?>"><br />
											<span id="micro2">Кто сможет смотреть и комментировать этот раздел.</span>
										</td>
									</tr>
									<tr>
										<td width="100" valign="top">Родительский раздел</td>
										<td>
											<select style="width: 300px;" name="branch_parent">
												<option value="0"><? echo $this->blog_info['title'];  ?></option>
												<?php foreach($this->branch_list as $key => $item){ ?>
													<?php if (((int)$item['level'] == 1) && ($this->branch_info['id'] != $item['id']) ) { ?>
														<option value="<?php echo $item['key'];?>"><?php echo $item['name'];?></option>
												<?php }
													} ?>
												
											</select><br />
											<span id="micro2">Привязка к разделу каталога.</span>
										</td>
	
									</tr>
									<tr>
										<td width="100" valign="top">Раздел каталога</td>
										<td>
											<select style="width: 300px;" name="branch_catalog">
												<?php foreach($this->catalog_list as $key => $item){ ?>
													<option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
												<?php } ?>
												
											</select><br />
											<span id="micro2">Привязка к разделу каталога.</span>
										</td>
	
									</tr>
									<tr>
										<td valign="top">Уровень доступа</td>
										<td>
											<select style="width: 300px;" name="branch_access">
												<option value="1">для всех</option>
												<option value="2">только для друзей</option>
	
												<option value="0">только для себя</option>
											</select><br />
											<!--<span id="micro2">В какой альбом будет загружено изображение.</span>-->
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
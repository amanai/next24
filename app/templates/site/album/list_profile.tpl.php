<?php include($this -> _include('../header.tpl.php')); ?>
			<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?php if ($this -> can_edit) { ?>
						<h2 class="page-ttl"><a href="<?php echo $this->createUrl('Album', 'List');?>">Мои фотоальбомы</a> 
						<!--  
						<span class="spr">»</span> Альбом 1
						-->
						</h2>
					<? } ?>	
						<?php if ($this -> can_edit) { ?>
							<form class="main-form" action="<?php echo $this -> createUrl('Album', 'ListSave'); ?>" method="post">
						<?php } ?>						
							<fieldset>
								<div class="item-edit-list">
									<ul class="clearfix">
									<?php foreach($this->album_list as $key => $item){ ?>
										<li class="it">
											<div class="nm">
											<?php if ($this -> can_edit) { ?>
												<input type="hidden" name="album_id[<?php echo $item['id'];?>]" value="<?php echo $item['id'];?>" />
												<input type="text" name="album_name[<?php echo $item['id'];?>]" value="<?php echo $item['name'];?>" />
											<?php } else { ?>
												<a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a>
											<?php } ?>												
											</div>
											<div class="av album">
												<a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>">
													<img class="avatar" src="<?php echo ($item['thumbnail'] ===false)?$this -> image_url.'noimage.gif' :$item['thumbnail'];?>" alt="<?php echo $item['name'];?>" />
												</a>												
											</div>
											<div class="meta">
												<div class="auth">
													<a href="<?php echo  UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a><i class="arrow-icon bid-arrow-icon"></i>
												</div>
												<div class="date"><?php echo date("j F Y", strtotime($item['creation_date']));?></div>
											</div>
											<?php if ($this -> can_edit) { ?>
												<ul class="actions">
													<li>
														<select name="album_access[<?php echo $item['id'];?>]">
														<?php foreach ($this -> access_list as $key=>$value){?>
															<option value="<?php echo $key;?>" <?php if ((int)$key === (int)$item['access']) {echo 'selected';} ?>><?php echo $value;?></option>
														<?php } ?>
														</select>
													</li>
													<li><input id="main-1" type="checkbox" name="is_onmain[<?php echo $item['id'];?>]" <?php if (1 === (int)$item['is_onmain']) {echo 'checked';} ?> /><label for="main-1">Показывать на главной</label></li>
													<li><input id="del-1" type="checkbox" name="delete[<?php echo $item['id'];?>]" /><label for="del-1" class="delete-link">Удалить</label></li>
												</ul>											
											<?php } ?>												
										</li>
									<? } ?>	
									</ul>
								</div>
								<div class="button">
								<?php if ($this -> can_edit && count($this->album_list)) { ?>
									<input type="submit" value="Сохранить" />
								<?php } ?>										
								</div>
							</fieldset>
					<?php if ($this -> can_edit && count($this->album_list)) { ?>
						</form>
					<?php } ?>	
					<!-- /photo-album-list -->
			 		<ul class="pages-list clearfix">
						<?php echo $this -> album_list_pager; ?>
					</ul>						
					</div></div>
					<!-- /main -->				
					<div class="sidebar">
						<?php echo $this -> control_panel;?>
						<div class="navigation">
							<div class="title">
								<h2>Фотоальбомы</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<ul class="nav-list">
								<?php echo $this -> album_menu;?>							
							</ul>					
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
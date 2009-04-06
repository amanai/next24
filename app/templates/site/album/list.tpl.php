<?php include($this -> _include('../header.tpl.php')); ?>
<?php if ($this -> left_panel === true) { ?>
	<?php include($this -> _include('../profile_line.tpl.php')); ?>	
<? } ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">					
						<ul class="view-filter clearfix">
						<?php if ($this -> left_panel !== true) { ?>
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						<? } ?>	
						</ul>
						<!-- /view-filter -->
						<div class="photo-album-list">
						<?php if ($this -> can_edit) { ?>
							<form action="<?php echo $this -> createUrl('Album', 'ListSave'); ?>" method="post">
						<?php } ?>
						<ul class="in clearfix">
						<?php foreach($this->album_list as $key => $item){ ?>
							<li class="it">
								<dl>
									<dt>
										<?php if ($this -> can_edit) { ?>
											<input type="hidden" name="album_id[<?php echo $item['id'];?>]" value="<?php echo $item['id'];?>" />
											<input type="text" name="album_name[<?php echo $item['id'];?>]" value="<?php echo $item['name'];?>" />
										<?php } else { ?>
											<a href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a>
										<?php } ?>									
									</dt>
									<dd class="av">
										<a class="album" href="<?php echo PhotoController::getAlbumUrl($item['id'], $item['login']);?>"><img src="<?php echo ($item['thumbnail'] ===false)?$this -> image_url.'noimage.gif' :$item['thumbnail'];?>" alt="<?php echo $item['name'];?>" /></a>			
									</dd>
									<dd class="auth">
										<a href="<?php echo  UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a><i class="arrow-icon bid-arrow-icon"></i>
									</dd>
									<dd class="date"><?php echo date("j F Y", strtotime($item['creation_date']));?></dd>
									<?php if ($this -> can_edit) { ?>
										<dd>
											<div>
												<select name="album_access[<?php echo $item['id'];?>]">
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
										</dd>
									<?php } ?>									
								</dl>
							</li>
						<?php }?>
					</ul>
					<?php if ($this -> can_edit && count($this->album_list)) { ?>
						<input type="submit" value="Сохранить" />
						</form>
					<?php } ?>						
					</div>
						<!-- /photo-album-list -->
			 			<ul class="pages-list clearfix">
							<?php echo $this -> album_list_pager; ?>
						</ul>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Фотоальбомы</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>				
							<?php if ($this -> left_panel === true) { ?>					
								<ul class="nav-list">
									<?php echo $this -> album_menu;?>
								</ul>
								<?php echo $this -> control_panel;?>
							<?php } ?>								
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
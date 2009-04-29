<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->showed_user_profile['id']); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<h2 class="page-ttl"><a href="#">Фотоальбомы <?$name_usr = implode(' ',array($user['first_name'],$user['middle_name']));
					if(!trim($name_usr)) echo 'Нет имени';
					else echo $name_usr;?></a> <span class="spr">»</span> <?=$this->current_album_name;?></h2>
						<?php if ($this -> can_edit) { ?>
							<form class="main-form" action="<?php echo $this -> createUrl('Photo', 'Save'); ?>" method="post">
						<?php } ?>						
							<fieldset>
								<div class="item-edit-list">
								<?php if(count($this->photo_list)) { ?>
									<ul class="clearfix">
									<?php foreach($this->photo_list as $key => $item){ ?>
										<li class="it">
											<div class="nm">
												<?php if ($this -> can_edit) { ?>
													<input type="hidden" name="photo_id[<?php echo $item['id'];?>]" value="<?php echo $item['id'];?>" />
													<input type="text" name="photo_name[<?php echo $item['id'];?>]" value="<?php echo $item['name'];?>" />
												<?php } else { ?>
													<a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a>
												<?php } ?>											
											</div>
											<div class="av">
												<a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>">
													<img class="avatar" src="<?php echo ($item['thumbnail'] ===false)?$this -> image_url.'noimage.gif' :$item['thumbnail'];?>" />
												</a>											
											</div>
											<div class="meta">
												<div class="auth">
													<a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a>
													<i class="arrow-icon bid-arrow-icon"></i>
												</div>
												<div class="date"><?php echo date("j F Y", strtotime($item['creation_date']));?></div>
											</div>
											<?php  if ($this -> can_edit) { ?>
											<ul class="actions">
												<li>
													<select style="" name="photo_access[<?php echo $item['id'];?>]">
													<?php foreach ($this -> access_list as $key=>$value){?>
														<option value="<?php echo $key;?>" <?php if ((int)$key === (int)$item['access']) {echo 'selected';} ?>><?php echo $value;?></option>
													<?php } ?>
													</select>
												</li>
												<li>
													<input id="cover-1" type="radio" value="<?php echo $item['id'];?>" name="thumb_photo" <?php if ((int)$item['id'] === (int)$this -> thumbnail_id) {echo 'checked="checked"';} ?> /><label for="cover-1">Обложка</label>
												</li>
												<li>
													<input id="main-1" type="checkbox" name="is_onmain[<?php echo $item['id'];?>]" <?php if (1 === (int)$item['is_onmain']) {echo 'checked="checked"';} ?> /><label for="main-1">Показывать на главной</label>
												</li>
												<li>
													<input id="rate-1" type="checkbox" name="is_rating[<?php echo $item['id'];?>]" <?php if (1 === (int)$item['is_rating']) {echo 'checked="checked"';} ?> /><label for="rate-1">В рейтинге</label>
												</li>
												<li>
													<input id="del-1" type="checkbox" name="photo_del[<?php echo $item['id'];?>]" /><label for="del-1" class="delete-link">Удалить</label>
												</li>
											</ul>											
											<?php } elseif ($this -> user_id) { ?>
												<a href="javascript: void(0);" onclick="ShowHideComplaint('complaintArbitration<?php echo $item['id'];?>');">пожаловаться</a>
												<div id="complaintArbitration<?php echo $item['id'];?>" style="display: none;">
                									<label><input type="radio" name="complaint<?php echo $item['id'];?>" id="complaint<?php echo $item['id'];?>" value="На фото никого не видно. " /><font  class="complaintText">На фото никого не видно</font></label><br/>
                									<label><input type="radio" name="complaint<?php echo $item['id'];?>" id="complaint<?php echo $item['id'];?>" value="Чужое фото. " /><font  class="complaintText">Чужое фото</font></label><br/>
                									<label><input type="radio" name="complaint<?php echo $item['id'];?>" id="complaint<?php echo $item['id'];?>" value="Фото из другой тематики. " /><font  class="complaintText">Фото из другой тематики</font></label><br/>
                									<input type="text" name="complaint_text<?php echo $item['id'];?>" id="complaint_text<?php echo $item['id'];?>" value="" /><br/>
                									<input type="button" onclick="sendArbitration(<?php echo $item['id'];?>, '<?php echo $item['login'];?>');" value="Отправить жалобу" />
                								</div>
                							<?php } ?>
										</li>
									<? } ?>	
									</ul>
									<? } else { ?>
										&nbsp;
									<? } ?>
								</div>
								<?php if ($this -> can_edit && count($this->photo_list)) { ?>
										<div class="button"><input type="submit" value="Сохранить" /></div>
								<?php } ?>
							</fieldset>
							<?php if ($this -> can_edit) { ?>
									</form>
							<?php } ?>							
						</form>
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
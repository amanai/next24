<?php include($this -> _include('../header.tpl.php')); ?>
	<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<h2 class="page-ttl">
						<a href="#">Мои фотоальбомы</a> <span class="spr">&raquo;</span>
						<a href="<?php echo PhotoController::getAlbumUrl($this->album_id, $this->photo_owner_login);?>"><?php echo $this->album_name;?></a> 
							<span class="spr">&raquo;</span> <?php echo $this->photo_name;?>				
						 </h2>
						<div class="photo-post">
							<div class="image center-image">
							<?php if ($this->photo_info['path'] !== false) { ?>
								<img src="<?php echo $this->photo_file; ?>" id="iborder"/>
							<?php } else { ?>
								<img src="<?php echo $this -> image_url; ?>noimage.gif" id="iborder"/>
							<?php } ?>							
							</div>
							<ul class="photo-meta clearfix">
							<?php if ($this -> have_rating === true) {?>
								<li class="rate">Рейтинг фото: <strong><span><?php echo round($this->photo_rating, 2); ?></span></strong> , оценили <em><?php echo $this->photo_voices; ?> человек</em></li>
							<?php } ?>
								<li class="date"><?php echo date("j F Y", strtotime($this->photo_creation_date));?></li>
								<li class="views">Смотрели всего <em>287</em> раз</li>
							</ul>
							<!-- /photo-meta -->
							<?php if ($this -> have_rating === true) { ?>
								<?php if ($this -> can_vote === true){ ?>
							<form class="evaluate" action="<?php echo $this -> rate_url;?>" method="post">
								<input type="hidden" name="id" value="<?php echo $this->element_id;?>" />
								<table>
									<tr>
										<th><input type="submit" value="Оценить фото" /></th>
										<td>
											<label for="e-1">1</label>
											<input type="radio" name="rate_value" id="e-1" />
										</td>
										<td>
											<label for="e-2">2</label>
											<input type="radio" name="rate_value" id="e-2" />
										</td>
										<td>
											<label for="e-3">3</label>
											<input type="radio" name="rate_value" id="e-3" />
										</td>
										<td>
											<label for="e-4">4</label>
											<input type="radio" name="rate_value" id="e-4" />
										</td>
										<td>
											<label for="e-5">5</label>
											<input type="radio" name="rate_value" id="e-5" checked="checked" />
										</td>
										<td>
											<label for="e-6">6</label>
											<input type="radio" name="rate_value" id="e-6" />
										</td>
										<td>
											<label for="e-7">7</label>
											<input type="radio" name="rate_value" id="e-7" />
										</td>
										<td>
											<label for="e-8">8</label>
											<input type="radio" name="rate_value" id="e-8" />
										</td>
										<td>
											<label for="e-9">9</label>
											<input type="radio" name="rate_value" id="e-9" />
										</td>
										<td>
											<label for="e-10">10</label>
											<input type="radio" name="rate_value" id="e-10" />
										</td>
									</tr>
								</table>
								<div class="bg"><img src="/app/images/backgrounds/evaluate.png" alt="" /></div>
							</form>
									<?php } else { ?>
										Ваш голос принят
								<?php } ?>
							<?php } ?>						
						</div>
						<!-- /photo-post -->
						<?php if ($this -> user_id) { ?>
							<p>
								<a class="spam-link" href="javascript: void(0);" onclick="ShowHideComplaint('complaintArbitration1');">Пожаловаться на фото администратору</a>
								<div class="complaintArbitration" id="complaintArbitration1">
        							<label><input type="radio" name="complaint1" id="complaint1" value="На фото никого не видно. " /><font  class="complaintText">На фото никого не видно</font></label><br/>
        							<label><input type="radio" name="complaint1" id="complaint1" value="Чужое фото. " /><font  class="complaintText">Чужое фото</font></label><br/>
        							<label><input type="radio" name="complaint1" id="complaint1" value="Фото из другой тематики. " /><font  class="complaintText">Фото из другой тематики</font></label><br/>
        							<input type="text" name="complaint_text1" id="complaint_text1" value="" /><br/>
        							<input type="button" onclick="sendArbitration(1, '<?php echo $this->photo_owner_login;?>');" value="Отправить жалобу" />
        						</div>
        					</p>						
        				<?php } ?>							
						<div class="photo-gallery"><div class="bg">
							<h2>25 фото в альбоме</h2>
							<div class="gallery-wrap">
								<ul class="clearfix">
									<?php echo $this -> bottom_list;?>
								</ul>
							</div>
						</div></div>
						<!-- /photo-gallery -->
						<?php echo $this -> comment_list;?>
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
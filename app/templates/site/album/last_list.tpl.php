<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">					
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<!-- /view-filter -->
						<div class="photo-album-list">
						<ul class="in clearfix">
						<?php foreach($this->photo_list as $key => $item){ ?>
							<li class="it">
								<dl>
									<dt>
										<a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a>									
									</dt>
									<dd class="av">
										<a class="avatar" href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>"><img src="<?php echo ($item['thumbnail'] ===false)?$this -> image_url.'noimage.gif' :$item['thumbnail'];?>" alt="<?php echo $item['name'];?>" /></a>			
									</dd>
									<dd class="auth">
										<a href="<?php echo PhotoController::getAlbumUrl($item['album_id'], $item['login']);?>"><?php echo $item['album_name'];?></a><i class="arrow-icon bid-arrow-icon"></i>
									</dd>
									<dd class="date"><?php echo date("j F Y", strtotime($item['creation_date']));?></dd>								
								</dl>
							</li>
						<?php }?>
					</ul>					
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
							<!-- левый блок -->
								<?php echo $this -> album_menu;?>
								<?php echo $this -> control_panel;?>
							<!-- /левый блок -->
						<?php } ?>						
							<ul class="nav-list">
							<?php foreach($this->photo_list as $key => $item){ ?>
								<li><i class="arrow-icon"></i><a href="<?php echo PhotoController::getPhotoUrl($item['id'], $item['login']);?>"><?php echo $item['name'];?></a></li>
							<? } ?>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
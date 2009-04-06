<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>	
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<li><a href="#">Мои Rss-ленты</a></li>
							<li><a href="#">Настройка Rss-лент</a></li>
							<li><strong>Настройка каталога<span></span></strong></li>
						</ul>
						<!-- /view-filter -->
						<?=$this -> flash_messages; ?>
						<form name="frmFeeds" action="" method="POST" >
							<input type="hidden" name="frmAction" value="<?php echo $this -> frmAction; ?>">						
							<ul class="rss-catalog-list">
                			<?php 
                				$aLeafs = $this->getAllLeafs($this->news_list);
                				$this->BuildTree_moderate($aLeafs, $this->news_list, 0); echo $this->_htmlTree; 
                			?>						
							</ul>
						</form>	
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="user-action">
						<?php if ($this->user_id){ ?>
							<ul>
								<li><a href="<?=$this->createUrl('News', 'MyFeeds', null, false)?>"><i class="icon rss-icon"></i>Мои RSS-ленты</a></li>
								<li><a href="<?=$this->createUrl('News', 'AddFeed', null, false)?>"><i class="icon rss-add-icon"></i>Добавить RSS-ленту</a></li>
								<li><a href="<?=$this->createUrl('News', 'AddNewsTree', null, false)?>"><i class="icon cat-add-icon"></i>Добавить Каталог</a></li>
								<li><a href="<?=$this->createUrl('News', 'ModerateFeeds', null, false)?>"><i class="icon rss-set-icon"></i>Настройка RSS-лент</a></li>
								<li><a href="<?=$this->createUrl('News', 'ModerateNewsTree', null, false)?>"><i class="icon cat-set-icon"></i>Настройка Каталога</a></li>								
							</ul>
						<?php } ?>	
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
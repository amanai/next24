<?php include($this -> _include('../header.tpl.php')); ?>
				<ul class="view-filter clearfix">
					<li><strong>Шпаков Виктор<span></span></strong></li>
					<li><a href="#">Настройки профиля</a></li>
				</ul>
				<!-- /view-filter -->

				<div class="user-profile">
					<div class="clearfix">
						<dl class="main-info">
							<dt><span class="user-status"><span class="online">online</span></span> <strong>Викторчик</strong>  / <span class="nick">madvic</span> /</dt>
							<dd class="av"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></dd>
							<dd>Украина, Киев</dd>
							<dd>На сайте: <span class="date">12 дней</span></dd>
							<dd>Настроение: <em>супер!</em> <a href="#" class="script-link"><span class="t">изменить</span></a></dd>
							<dd>Статус: <em>хочу есть и пить</em> <a href="#" class="script-link"><span class="t">изменить</span></a></dd>
						</dl>
						<div class="about-info">
							<div class="ttl"><strong>О себе</strong> <a href="#" class="script-link"><span class="t">изменить</span></a></div>
							<div class="cnt">Художественное опосредование, как бы это ни казалось парадоксальным, трансформирует реконструктивный подход, подобный исследовательский подход к проблемам художественной типологии можно обнаружить у К.Фосслера.</div>
						</div>
						<div class="rating-info">
							<div class="ttl"><strong>Рейтинг: <span class="nr">420 NR</span></strong></div>
							<div class="cnt">
								Профиль заполнен на:
								<div class="rating-view">
									<strong>48%</strong>
									<div style="width:48%;"></div>
								</div>
								<a href="#" class="script-link"><span class="t">подробнее о рейтинге</span></a>
							</div>
						</div>
					</div>
					<ul class="user-tabs clearfix">
						<?php include($this -> _include('../tab_panel_profile.tpl.php')); ?>
					</ul>
					<!-- /user-tabs -->
				</div>
				<!-- /user-profile -->
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
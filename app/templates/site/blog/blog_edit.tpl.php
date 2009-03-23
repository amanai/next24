<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
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
					<?php echo $this -> flash_messages; ?>
					<?php  if ($this->request_user_id == $this->user_id){ 
					    require('form_blog.tpl.php');
					} ?>					
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php echo $this -> control_panel; ?>
						<div class="navigation">
							<div class="title">
								<h2>Блоги <? echo $this->blog_info['title'];  ?></h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<ul class="nav-list">
								<li><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Авио</a></li>
								<li class="active"><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Internet</a>
									<ul>
										<?php require('blog_left_tree.tpl.php'); ?>
										<li><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Citroen</a> (28)</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
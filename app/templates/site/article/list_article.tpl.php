<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<!-- /view-filter -->
						<!-- /breadcrumbs -->
						<?foreach ($this->article_list as $key => $item):?>
						<div class="blog-post">
							<h2><a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>" rel="bookmark"><?=$item['title']?></a></h2>
							<div class="breadcrumbs">
								<?=$item['full_path']?>
								▪ <a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » С рождеством!
							</div>
							<div class="post-content">
								<p>Каждый из нас выбрал по одной из своих самых потенциальных идей стартапов, подготовили простенькие презентации по брифу 
(идея, бизнес-модель, рынок, конкуренты, инвестиции), который мы используем на СтартапПоинте и рассказали о своей идее в 
формате elevator pitch. После обсуждениея каждой идеи определились на одной. Идея нам понравилась и продолжили ...</p>
								<div class="more"><a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>">читать дальше</a> &rarr;</div>
							</div>
							<!-- /post-content -->
							<div class="tag-list">
								<i class="icon tags-list-icon"></i>
								<ul>
									<li><a href="#" rel="tag">apple</a>,</li>
									<li><a href="#" rel="tag">mac</a>,</li>
									<li><a href="#" rel="tag">pc</a></li>
								</ul>
							</div>
							<!-- /tag-list -->
							<div class="post-meta"><div class="bg"><div class="bg">
								<div class="voting vote-positive">
									<?=number_format($item['vote_result'], 2)?>
									<a href="#" class="vote_plus" title="нравится">+<span></span></a>
									<a href="#" class="vote_minus" title="не нравится">-<span></span></a>
								</div>
								<ul>
									<li class="it ath">
										<div class="dropdown dropdown-active">
											<div class="d-head">
												<a href="#" class="with-icon-s"><i class="icon-s wuser-icon"></i><?=$item['login']?></a><i class="arrow-icon bid-arrow-icon"></i>
											</div>
											<div class="d-body">
												<ul>
													<li><a href="#">Профиль пользователя</a></li>
													<li><a href="#">Добавить в друзья</a></li>
													<li><a href="#">Написать сообщение</a></li>
													<li><a href="#">Послать подарок</a></li>
												</ul>
											</div>
										</div>
										<span class="user-status"><span class="online">online</span><span class="nr">245 nr</span></span>
									</li>
									<li class="it date"><?=$item['creation_date']?></li>
									<li class="it com">
										<a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>" class="with-icon-s"><i class="icon-s commets-icon"></i><?=$item['comments']?> ответов</a>
									</li>
									<li class="it number-views"><span class="with-icon"><i class="icon views-icon"></i><?=$item['views']?></span></li>
									<li class="it number-votes">Голосов за тему: <strong><?=$item['votes']?></strong></li>
								</ul>
							</div></div></div>
							<!-- /post-meta -->
						</div>
						<!-- /blog-post -->						
						<?endforeach;?>						
						<ul class="pages-list clearfix">
							<li class="control"><span>« Назад</span> <a href="#">Вперед »</a></li>
							<li><strong>1</strong></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li>...</li>
							<li><a href="#">34</a></li>
						</ul>
						<!-- /pages-list -->
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Блоги</h2>
								<i title="Показать фильтр" class="filter-link icon hide-filter-icon"></i>
							</div>
							<form class="filter" action="#" method="get">
								<ul>
									<li><select><option>Авто</option></select></li>
									<li><select><option>AUDI</option></select></li>
									<li><select><option>Выберете раздел</option></select></li>
									<li><select disabled="disabled"><option>Выберете раздел выше</option></select></li>
								</ul>
							</form>
							<?php include($this -> _include('catalog.tpl.php')); ?>	
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->				
<?php include($this -> _include('../footer.tpl.php')); ?>

<?php include($this -> _include('../header.tpl.php')); ?>	
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<ul class="view-filter clearfix"> 
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul> 
						<!-- /view-filter --> 
						<div class="display-filter clearfix"> 
							<div class="number-filter"> 
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> ответов
							</div> 
							<div class="type-filter"> 
								отображать: <a href="#">списком</a> | <strong>сводкой</strong> 
							</div> 
						</div> 
						<!-- /display-filter --> 
						<div class="breadcrumbs main-breadcrumbs"> 
							<a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » <strong>С рождеством!</strong> 
						</div> 
						<!-- /breadcrumbs --> 
						<?php foreach ($this->posts as $value) { ?>
						<?php $user = Project::getUser()->getDbUser()->getUserById($value['user_id']); ?>
						<?php 
						if($user['gender']) {
							$class = 'user-icon';	
						}
						else {
							$class = 'wuser-icon';
						} 											
						?>
						<?php $online = Project::getUser()->getDbUser()->isUserOnline($value['user_id']); ?>
						<div class="blog-post"> 
							<h2><a href="#" rel="bookmark"><?=$value['post_title'];?></a></h2> 
							<div class="breadcrumbs"> 
								▪ <a href="#"><?=$value['blog_name'];?></a> » <a href="#"><?=$value['catalog_name'];?></a> » <?=$value['post_title'];?>
							</div> 
							<div class="post-content"> 
								<?=$value['full_text']; ?>
								<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
							</div> 
							<!-- /post-content --> 
							<div class="tag-list"> 
								<i class="icon tags-list-icon"></i> 
								<ul> 
									<li><a href="#" rel="tag"><?=$value['tag_name']; ?></a>,</li> 
								</ul> 
							</div> 
							<!-- /tag-list --> 
							<div class="post-meta"><div class="bg"><div class="bg"> 
								<div class="voting vote-positive"> 
									99
									<a href="#" class="vote_plus" title="нравится">+<span></span></a> 
									<a href="#" class="vote_minus" title="не нравится">-<span></span></a> 
								</div> 
								<ul> 
									<li class="it ath"> 
										<div class="dropdown"> 
											<div class="d-head"> 
												<a href="#" class="with-icon-s"><i class="icon-s <?=$class;?>"></i><?=$user['login'];?></a><i class="arrow-icon bid-arrow-icon"></i> 
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
										<span class="user-status"><span class="online"><?=$online?'online':'offline';?></span><span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($value['user_id']); echo $nr['rate']; ?> nr</span></span> 
									</li> 
									<li class="it date"><?=$value['creation_date'];?></li> 
									<li class="it com"> 
										<a href="#" class="with-icon-s"><i class="icon-s commets-icon"></i><?=$value['comments'];?> ответов</a> 
									</li> 
								</ul> 
							</div></div></div> 
							<!-- /post-meta --> 
						</div> 
						<!-- /blog-post --> 						
						<? } ?>
						<ul class="pages-list clearfix"> 
							<?php echo $this -> post_list_pager;?>
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
							<ul class="nav-list"> 
								<li><i class="arrow-icon"></i><a href="#">Авио</a></li> 
								<li class="active"><i class="arrow-icon"></i><a href="#">Internet</a> 
									<ul> 
										<li class="active"><span>AUDI</span> (8)</li> 
										<li><a href="#">Acura</a> (3)</li> 
										<li><a href="#">BMW</a> (25)</li> 
										<li><a href="#">Chrysler</a> (14)</li> 
										<li><a href="#">Citroen</a> (28)</li> 
										<li><a href="#">Acura</a> (3)</li> 
										<li><a href="#">BMW</a> (25)</li> 
										<li><a href="#">Chrysler</a> (14)</li> 
										<li><a href="#">Citroen</a> (28)</li> 
										<li><a href="#">Acura</a> (3)</li> 
										<li><a href="#">BMW</a> (25)</li> 
										<li><a href="#">Chrysler</a> (14)</li> 
										<li><a href="#">Citroen</a> (28)</li> 
										<li><a href="#" class="all-sections script-link"><span class="t">Все разделы</span></a> (57)</li> 
									</ul> 
								</li> 
								<li><i class="arrow-icon"></i><a href="#">Linux для всех</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Стартапы</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Юмор</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Internet</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Linux для всех</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Стартапы</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Типографика</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Apple</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Дизайн</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Программирование</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Linux для всех</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Стартапы</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Юмор</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Internet</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Linux для всех</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Стартапы</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Типографика</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Apple</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Дизайн</a></li> 
								<li><i class="arrow-icon"></i><a href="#">Программирование</a></li> 
							</ul> 
						</div> 
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<?php include($this -> _include('../footer.tpl.php')); ?>				
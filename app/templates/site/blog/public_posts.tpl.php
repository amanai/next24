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
						<div class="blog-post"> 
							<h2><a href="#" rel="bookmark"><?=$value['title'];?></a></h2> 
							<div class="breadcrumbs"> 
								▪ <a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » С рождеством!
							</div> 
							<div class="post-content"> 
								<?=$this->unhtmlentities($value['full_text']); ?>
								<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
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
									99
									<a href="#" class="vote_plus" title="нравится">+<span></span></a> 
									<a href="#" class="vote_minus" title="не нравится">-<span></span></a> 
								</div> 
								<ul> 
									<li class="it ath"> 
										<div class="dropdown dropdown-active"> 
											<div class="d-head"> 
												<a href="#" class="with-icon-s"><i class="icon-s wuser-icon"></i>mixalich</a><i class="arrow-icon bid-arrow-icon"></i> 
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
									<li class="it date">16 декабря 2008, 21:09</li> 
									<li class="it com"> 
										<a href="#" class="with-icon-s"><i class="icon-s commets-icon"></i>8 ответов</a> 
									</li> 
								</ul> 
							</div></div></div> 
							<!-- /post-meta --> 
						</div> 
						<!-- /blog-post --> 						
						<? } ?>
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
						<div class="blog-table"> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Если вы уверены, что сможете учавствовать в дебатах, то не стоит отправлять тему на конкурс.</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
							<div class="section"> 
								<div class="title clearfix"> 
									<h2><a href="#">Авто</a></h2> 
									<p><a href="#">157 категорий</a> <span class="spr">|</span> <a href="#">2567 новостей</a> в этом разделе</p> 
								</div> 
								<div class="holder clearfix"> 
									<ul class="short-view"> 
										<li><a href="#"><i class="icon this-icon"></i>Противники повышения пошлин на иномарки устроили акции в Москве ...</a><i class="star-icon full-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Поставщик двигателей для GP2 Series оказался на грани банкротства</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Организаторы опубликовали календари чемпионатов FIA GT и FIA GT3</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Компания Mercedes-Benz отметила выпуск 1,5-миллионного E-Class</a><i class="star-icon empty-star"></i></li> 
										<li><a href="#"><i class="icon this-icon"></i>Супер AUDI 6.0 D Q7</a></li> 
									</ul> 
									<div class="full-view"> 
										<h3><a href="#">Что же в имени твоем! 3.0D</a><i class="star-icon empty-star"></i></h3> 
										<div class="breadcrumbs"> 
											▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
										</div> 
										<a href="#"><img src="assets/i/temp/temp.5.jpg" alt="Что же в имени твоем! 3.0D" /></a> 
										<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на ... </p> 
										<div class="more"><a href="#">читать дальше</a> &rarr;</div> 
									</div> 
								</div> 
							</div> 
							<!-- /section --> 
						</div> 
						<!-- /display-table --> 
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
<?php include($this -> _include('header.tpl.php')); ?>
				<div class="widget-page clearfix">
					<div class="widgets-tabs">
						<ul class="tabs clearfix">
							<li class="active"><span class="with-drop"><a href="#">моя вкладка</a></span><i class="arrow-icon up-arrow"></i></li>
							<li><a href="#">бугага</a></li>
							<li><a href="#">Apple</a></li>
							<li class="add"><a href="#" title="Добавить"><i class="icon add-tab-icon"></i>+</a></li>
						</ul>
						<ul class="sub-tabs clearfix">
							<li><a href="#"><i class="icon add-widget-icon"></i>Добавить виджет</a></li>
							<li><a href="#"><i class="icon update-icon"></i>обновить все виджеты</a></li>
							<li><a href="#"><i class="icon settings-icon"></i>настройка вкладки</a></li>
						</ul>
					</div>	
					<!-- /widgets-tabs -->
					<div class="widget-columns clearfix">
						<div class="column">
							<div class="widget">
								<div class="widget-header clearfix">
									<h2><a href="<?php echo $this->createUrl('News', 'News', null, false); ?>"><i class="icon news-icon"></i>Новости</a> <em>(645)</em></h2>
									<ul class="controll">
										<li><a href="#" title="Свернуть"><i class="icon widget-сollapse-icon"></i></a></li>
										<li><a href="#" title="Обновить"><i class="icon widget-refresh-icon"></i></a></li>
										<li><a href="#" title="Добавить"><i class="icon widget-add-icon"></i></a></li>
										<li><a href="#" title="Настройки"><i class="icon widget-settings-icon"></i></a></li>
										<li class="alt"><a href="#" title="Удалить"><i class="icon widget-delete-icon"></i></a></li>
									</ul>
								</div>
								<!-- /widget-header -->
								<div class="widget-tabs">
									<ul class="clearfix">
										<li class="active"><strong>Все новости<i class="arrow-icon"></i></strong></li>
										<li><a href="#">Спорт</a></li>
										<li><a href="#">Бизнес</a></li>
										<li><a href="#">Недвижимость</a></li>
									</ul>
									<div class="controll"><span></span></div>
								</div>
								<!-- /widget-tabs -->
								<div class="widget-content">
									<?=$this->viewNewsPage(Project::getUser()->getDbUser());?>
									<div class="pages">
										<span class="prev" title="Назад"></span>
										<a class="next" href="#" title="Вперед"></a>
									</div>
								</div>
								<!-- /widget-content -->
							</div>
							<!-- /widget -->
						</div>
						<!-- /column -->
						<div class="column">
							<div class="widget">
								<div class="widget-header clearfix">
									<h2><a href="<?php echo $this->createUrl('Album', 'LastList', null, false); ?>"><span class="icon foto-icon"></span>Фото</a></h2>
									<ul class="controll">
										<li><a href="#" title="Свернуть"><i class="icon widget-сollapse-icon"></i></a></li>
										<li><a href="#" title="Обновить"><i class="icon widget-refresh-icon"></i></a></li>
										<li><a href="#" title="Добавить"><i class="icon widget-add-icon"></i></a></li>
										<li><a href="#" title="Настройки"><i class="icon widget-settings-icon"></i></a></li>
										<li class="alt"><a href="#" title="Удалить"><i class="icon widget-delete-icon"></i></a></li>
									</ul>
								</div>
								<!-- /widget-header -->
								<div class="widget-content">
									<?=$this->viewAlbumPage(Project::getUser()->getDbUser());?>
									<div class="main-action clearfix"><div class="centered"><div class="in"><a href="<?=$this->createUrl('Album', 'CreateForm');?>"><i class="icon add-foto-icon"></i>Добавить свои фото</a></div></div></div>
									<div class="pages">
										<span class="prev" title="Назад"></span>
										<a class="next" href="#" title="Вперед"></a>
									</div>
								</div>
								<!-- /widget-content -->
							</div>
							<!-- /widget -->
							<div class="widget">
								<div class="widget-header clearfix">
									<h2><a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>"><i class="icon answers-icon"></i>Вопрос-ответ</a></h2>
									<ul class="controll">
										<li><a href="#" title="Свернуть"><i class="icon widget-сollapse-icon"></i></a></li>
										<li><a href="#" title="Обновить"><i class="icon widget-refresh-icon"></i></a></li>
										<li><a href="#" title="Добавить"><i class="icon widget-add-icon"></i></a></li>
										<li><a href="#" title="Настройки"><i class="icon widget-settings-icon"></i></a></li>
										<li class="alt"><a href="#" title="Удалить"><i class="icon widget-delete-icon"></i></a></li>
									</ul>
								</div>
								<!-- /widget-header -->
								<div class="widget-content">
									<?=$this->viewQuestionPage(Project::getUser()->getDbUser());?>
									<div class="main-action clearfix"><div class="centered"><div class="in"><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion')?>"><i class="icon add-foto-icon"></i>Задать вопрос</a></div></div></div>
									<div class="pages">
										<span class="prev" title="Назад"></span>
										<a class="next" href="#" title="Вперед"></a>
									</div>
								</div>
								<!-- /widget-content -->
							</div>
							<!-- /widget -->
						</div>
						<!-- /column -->
						<div class="column alt-column">
							<div class="widget">
								<div class="widget-header clearfix">
									<h2><a href="<?php echo $this->createUrl('Article', 'List', null, false); ?>"><i class="icon articles-icon"></i>Статьи</a> <em>(124)</em></h2>
									<ul class="controll">
										<li><a href="#" title="Свернуть"><i class="icon widget-сollapse-icon"></i></a></li>
										<li><a href="#" title="Обновить"><i class="icon widget-refresh-icon"></i></a></li>
										<li><a href="#" title="Добавить"><i class="icon widget-add-icon"></i></a></li>
										<li><a href="#" title="Настройки"><i class="icon widget-settings-icon"></i></a></li>
										<li class="alt"><a href="#" title="Удалить"><i class="icon widget-delete-icon"></i></a></li>
									</ul>
								</div>
								<!-- /widget-header -->
								<div class="widget-tabs">
									<ul class="clearfix">
										<li class="active"><strong>Все новости<i class="arrow-icon"></i></strong></li>
										<li><a href="#">Спорт</a></li>
										<li><a href="#">Бизнес</a></li>
										<li><a href="#">Недвижимость</a></li>
									</ul>
									<div class="controll"><span></span></div>
								</div>
								<!-- /widget-tabs -->
								<div class="widget-content">
									<?=$this->viewArticlePage(Project::getUser()->getDbUser());?>
									<div class="pages">
										<span class="prev" title="Назад"></span>
										<a class="next" href="#" title="Вперед"></a>
									</div>
								</div>
								<!-- /widget-content -->
							</div>
							<!-- /widget -->
						</div>
						<!-- /column -->
					</div>
					<!-- /widget-columns -->
				</div>
				<!-- /widget-page -->

<?php include($this -> _include('footer.tpl.php')); ?>
<?php include($this -> _include('header.tpl.php')); ?>
				<div class="widget-page clearfix"> 
					<div class="widgets-tabs"> 
						<ul class="tabs clearfix"> 
						<?php 
							$v_request = Project::getRequest();
    						$v_session = Project::getSession();
    						$request_keys = $v_request->getKeys();	
    						if(isset($request_keys['d'])) $d = $request_keys['d'];				
						?>
							<li <?if(!isset($d)) echo 'class="active"';?>> 							
									<!--  <div class="dropdown dropdown-noactive"> 
											<div class="d-head"> 
												<span class="with-drop"><a href="<?php echo $this->createUrl('Index', 'Index', null, false); ?>">моя вкладка</a></span><i class="arrow-icon down-arrow"></i> 
											</div> 
											<div class="d-body"> 
												<ul> 
													<li><a href="#">Переименовать</a></li> 
													<li><a href="#">Удалить</a></li> 
												</ul> 
											</div> 
										</div>  -->
										<a href="<?php echo $this->createUrl('Index', 'Index', null, false); ?>">моя вкладка</a>
							</li> 
							<?php if($this->desktops) { ?>
							<?php foreach ($this->desktops as $key => $value) {?>
							<li <?if(isset($d) && ($key==$d)) echo 'class="active"';?>>
								<div class="dropdown dropdown-noactive"> 
									<div class="d-head"> 
										<span class="with-drop"><a href="<?php echo $this->createUrl('Index', 'Index', array('d' => $key), false); ?>"><?=$value;?></a></span><i class="arrow-icon down-arrow"></i> 
									</div> 
									<div class="d-body"> 
										<ul> 
											<li><a href="#">Переименовать</a></li> 
											<li><a href="#">Удалить</a></li> 
										</ul> 
									</div> 
								</div> 							
							</li>
							<? } ?>
							<? } ?>
							<li class="add"><a href="<?php echo $this->createUrl('Index', 'addDesktop', null, false); ?>" title="Добавить"><i class="icon add-tab-icon"></i>+</a></li> 
						</ul> 
						<ul class="sub-tabs clearfix"> 
							<li><a href="#"><i class="icon add-widget-icon"></i>Добавить виджет</a></li> 
							 
							<li> 
										<div class="dropdown dropdown-noactive"> 
											<div class="d-head"> 
												<a href="#"><i class="icon settings-icon"></i>настройка вкладки</a> 
											</div> 
											<div class="d-body"> 
												<ul> 
													<li><a href="#">Вернуть размеры виджетов по умолчанию</a></li> 
												</ul> 
											</div> 
										</div> 
							</li> 
						</ul> 
					</div>	
					<!-- /widgets-tabs --> 
					<div class="widget-columns clearfix"> 
						<div class="column widget-place"> 
							<div class="widget movable" id="news"> 
								<div class="widget-header clearfix" style="cursor:move;"> 
									<h2><a href="<?php echo $this->createUrl('News', 'News', null, false); ?>"><i class="icon news-icon"></i>Новости</a> <em>(645)</em></h2> 
									<ul class="controll"> 
										<li><span title="Свернуть"><i class="icon widget-сollapse-icon"></i></span></li> 
										<li><span title="Добавить"><i class="icon widget-add-icon"></i></span></li> 
										<li> 
											
											<div class="dropdown"> 
												<div class="d-head"> 
													<span title="Настройки"><i class="icon widget-settings-icon"></i></span> 
												</div> 
												<div class="d-body"> 
													<ul> 
														<li><a href="#">Показывать по 10</a></li> 
														<li><a href="#">Показывать по 20</a></li> 
														<li><a href="#">Показывать по 30</a></li> 
														<li><a href="#">Вид отображениея: Анонс</a></li> 
														<li><a href="#">Вид отображениея: Только заголовки</a></li>
													</ul> 
												</div> 
											</div> 
										
										</li> 
										<li class="alt"><span title="Удалить"><i class="icon widget-delete-icon"></i></span></li> 
									</ul> 
								</div> 
								<!-- /widget-header --> 
								<div class="widget-tabs"> 
									<ul class="clearfix"> 
										<li class="active"> 
											<div class="dropdown"> 
												<div class="d-head"> 
													<strong>Все новости<i class="arrow-icon"></i></strong> 
												</div> 
												<div class="d-body"> 
													<ul> 
														<li><a href="#">Спорт</a></li> 
														<li><a href="#">Бизнес</a></li> 
														<li><a href="#">Недвижимость</a></li> 
													</ul> 
												</div> 
											</div> 
										</li> 
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
						<div class="column widget-place"> 
							<div class="widget movable" id="photo"> 
								<div class="widget-header clearfix" style="cursor:move;"> 
									<h2><a href="<?php echo $this->createUrl('Album', 'LastList', null, false); ?>"><span class="icon foto-icon"></span>Фото</a></h2> 
									<ul class="controll"> 
 
										<li><span title="Свернуть"><i class="icon widget-сollapse-icon"></i></span></li> 
										<li><span title="Добавить"><i class="icon widget-add-icon"></i></span></li> 
										<li> 
											<div class="dropdown"> 
												<div class="d-head"> 
													<span title="Настройки"><i class="icon widget-settings-icon"></i></span> 
												</div> 
												<div class="d-body"> 
													<ul> 
														<li><a href="#">Показывать по 10</a></li> 
														<li><a href="#">Показывать по 20</a></li> 
														<li><a href="#">Показывать по 30</a></li> 
														<li><a href="#">Вид отображениея: Анонс</a></li> 
														<li><a href="#">Вид отображениея: Только заголовки</a></li>
													</ul> 
												</div> 
											</div> 
										</li> 
										<li class="alt"><span title="Удалить"><i class="icon widget-delete-icon"></i></span></li> 
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
							<div class="widget movable" id="question"> 
								<div class="widget-header clearfix" style="cursor:move;"> 
									<h2><a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>"><i class="icon answers-icon"></i>Вопрос-ответ</a></h2> 
 
									<ul class="controll"> 
										<li><span title="Свернуть"><i class="icon widget-сollapse-icon"></i></span></li> 
										<li><span title="Добавить"><i class="icon widget-add-icon"></i></span></li> 
										<li> 
											
											<div class="dropdown"> 
												<div class="d-head"> 
													<span title="Настройки"><i class="icon widget-settings-icon"></i></span> 
												</div> 
												<div class="d-body"> 
													<ul> 
														<li><a href="#">Показывать по 10</a></li> 
														<li><a href="#">Показывать по 20</a></li> 
														<li><a href="#">Показывать по 30</a></li> 
														<li><a href="#">Вид отображениея: Анонс</a></li> 
														<li><a href="#">Вид отображениея: Только заголовки</a></li>
													</ul> 
												</div> 
											</div> 
										
										</li> 
										<li class="alt"><span title="Удалить"><i class="icon widget-delete-icon"></i></span></li> 
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
						<div class="column alt-column widget-place"> 
							<div class="widget movable" id="articles"> 
								<div class="widget-header clearfix" style="cursor:move;"> 
									<h2><a href="<?php echo $this->createUrl('Article', 'List', null, false); ?>"><i class="icon articles-icon"></i>Статьи</a> <em>(124)</em></h2> 
 
									<ul class="controll"> 
										<li><span title="Свернуть"><i class="icon widget-сollapse-icon"></i></span></li> 
										<li><span title="Добавить"><i class="icon widget-add-icon"></i></span></li> 
										<li> 
											
											<div class="dropdown"> 
												<div class="d-head"> 
													<span title="Настройки"><i class="icon widget-settings-icon"></i></span> 
												</div> 
												<div class="d-body"> 
													<ul> 
														<li><a href="#">Показывать по 10</a></li> 
														<li><a href="#">Показывать по 20</a></li> 
														<li><a href="#">Показывать по 30</a></li> 
														<li><a href="#">Вид отображениея: Анонс</a></li> 
														<li><a href="#">Вид отображениея: Только заголовки</a></li>
													</ul> 
												</div> 
											</div> 
										
										</li> 
										<li class="alt"><span title="Удалить"><i class="icon widget-delete-icon"></i></span></li> 
									</ul> 
								</div> 
								<!-- /widget-header --> 
 
								<div class="widget-tabs"> 
									<ul class="clearfix"> 
										<li class="active"> 
											<div class="dropdown"> 
												<div class="d-head"> 
													<strong>Все новости<i class="arrow-icon"></i></strong> 
												</div> 
												<div class="d-body"> 
													<ul> 
														<li><a href="#">Спорт</a></li> 
														<li><a href="#">Бизнес</a></li> 
														<li><a href="#">Недвижимость</a></li> 
													</ul> 
												</div> 
											</div> 
										</li> 
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
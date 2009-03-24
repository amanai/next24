<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
												<table class="questions" width="100%">
													<tr>
														<td style="text-align: center;"><b>Дата публикации</b></td>
														<td style="text-align: center;"><b>Заголовок</b></td>
														<td style="text-align: center;"><b>Категория</b></td>
														<td style="text-align: center;"><b>Комментариев</b></td>
														<td style="text-align: center;"><b>Просмотров</b></td>
														<td style="text-align: center;"><b>Голосов за тему</b></td>
														<td style="text-align: center;"><b>Автор темы</b></td>
														<td style="text-align: center;"><b>Рейтинг</b></td>
														<td style="text-align: center;"><b>Статус</b></td>
													</tr>
													<?foreach ($this->article_list as $key => $item):?>
														<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
															<td style="text-align: center; white-space: normal;"><?=$item['creation_date']?></td>
															<td style="text-align: center;"><a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a></td>
															<td style="text-align: center;"><?=$item['full_path']?></td>
															<td style="text-align: center;"><?=$item['comments']?></td>
															<td style="text-align: center;"><?=$item['views']?></td>
															<td style="text-align: center;"><?=$item['votes']?></td>
															<td style="text-align: center;"><?=$item['login']?></td>
															<td style="text-align: center;"><?=$item['rate']?></td>
															<td style="text-align: center;">
																<? 	if($item['rate_status'] == ARTICLE_COMPETITION_STATUS::EDITED) echo "В редакции";
																	if($item['rate_status'] == ARTICLE_COMPETITION_STATUS::COMPLETE) echo "Готова";
																?>
															</td>
													<?endforeach;?>
												</table>		
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

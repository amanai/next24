<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<table class="stat-table"> 
							<thead> 
								<tr> 
									<th>Дата публикации</th> 
									<th>Заголовок</th> 
									<th>Категория</th> 
									<th>Комментариев</th> 
									<th>Просмотров</th>
									<th>Голосов за тему</th>
									<th>Автор темы</th>
									<th>Рейтинг</th>
									<th>Статус</th>
								</tr> 
							</thead> 
							<tbody>
							<?foreach ($this->article_list as $key => $item):?>
								<tr>
									<td class="date"><?=$item['creation_date']?></td>
									<td class="date"><a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a></td>
									<td class="date"><?=$item['full_path']?></td>
									<td class="date"><?=$item['comments']?></td>
									<td class="date"><?=$item['views']?></td>
									<td class="date"><?=$item['votes']?></td>
									<td class="date"><?=$item['login']?></td>
									<td class="date"><?=$item['rate']?></td>
									<td class="date">
										<? 	if($item['rate_status'] == ARTICLE_COMPETITION_STATUS::EDITED) echo "В редакции";
											if($item['rate_status'] == ARTICLE_COMPETITION_STATUS::COMPLETE) echo "Готова";
										?>
									</td>
								</tr>	
							<?endforeach;?>
							</tbody> 
						</table> 							
			<!-- 		<ul class="pages-list clearfix">
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
						</ul>	-->
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

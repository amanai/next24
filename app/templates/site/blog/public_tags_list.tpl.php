<?php include($this -> _include('../header.tpl.php')); ?>					
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<ul class="view-filter clearfix"> 
							<?php include($this -> _include('../tab_panel.tpl.php')); ?> 
						</ul> 
						<!-- /view-filter --> 
						<ul class="tag-cloud">
							<?php foreach ($this->tags as $value) { ?>
								<li><a href="<?=$this->createUrl('Blog', 'PublicList', array('tag_id' => $value['id']))?>" rel="tag" class="w<?=rand(1,5);?>"><?=$value['name'];?></a></li> 
							<? } ?> 
						</ul> 
						<!-- /tag-cloud --> 
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
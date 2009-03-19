<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<!-- Форма просмотра закладки BookmarksViewAction -->
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="breadcrumbs">
								<? if (count($this->bookmark_row > 0)) { ?>
									<?=$this->bookmark_row['bookmark_category']; ?>
								<? } ?>	
								▪ <a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » С рождеством!
							</div>
						</div>
						<!-- /display-filter -->
						<? if (count($this->bookmark_row > 0)) { ?>
						<div class="blog-post main-blog-post clearfix">
							<h2><?=$this->bookmark_row['title'];?></h2>
							<div class="number-of"><div>просмотры:  <strong><?=number_format($this->bookmark_row['views'], 0, '',' '); ?></strong></div></div>
							<p class="bookmark-meta">добавил: <a href="<?=$request->createUrl('Index','Index', null, $this->bookmark_row['login']);?>"><?=$this->bookmark_row['login']; ?></a>, <span class="date"><?=date_format(new DateTime($this->bookmark_row['creation_date']),'d.m.y H:i'); ?></span></p>
							<div class="bookmark-info">
								<div class="bookmark-screen"><img src="assets/i/temp/mail.jpg" alt="" /></div>
								<a href="<?=$this->bookmark_row['url'];?>" title="<?=$this->bookmark_row['url'];?>" target="_blank"><?=$this->bookmark_row['url_cut'];?></a>
							</div>
							<?=$this->bookmark_row['description'];?>
						</div>
						<!-- /blog-post -->
						<? } ?>
						<?=$this->comment_list?>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Категории</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<ul class="nav-list">
							<? if (count($this->bookmarks_category_list) > 0) { $v_count = 0; ?>
								<? foreach($this->bookmarks_category_list as $key => $item){ ?>
									<? if ($item['level_item']==0) { ?>
										<?=$item['name']?>
									<? } else { ?>
										<li><a href="<?=$this->createUrl('Bookmarks', $this->action, array($item['id']))?>"><?=$item['name']?></a></li>
									<? } ?>	
								<? } ?>
							<? } ?>		
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->	
<?php include($this -> _include('../footer.tpl.php')); ?>
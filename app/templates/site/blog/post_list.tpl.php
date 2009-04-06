<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?php echo $this -> flash_messages; ?>
						<div class="title-with-arrow clearfix"><h2><? echo $this->blog_info['title'];  ?><span></span></h2></div>
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> ответов
							</div>
							<div class="type-filter">
								отображать: <a href="#">списком</a> | <strong>сводкой</strong>
							</div>
						</div>
						<!-- /display-filter -->
						<?php if (is_array($this->post_list) && count($this->post_list)){?>
							<?php foreach ($this->post_list as $key=>$item){?>
							<div class="blog-post">
								<h2>
									<?php if ($item['owner'] === true) { ?>
										<a href="<?php echo $this->createUrl('Blog', 'PostEdit', array($item['id']));?>" title="Редактировать" class="func"><i class="icon edit-icon"></i></a>
										<a href="<?php echo $this->createUrl('Blog', 'PostDelete', array($item['id']));?>" title="Удалить" class="func"><i class="icon delete-icon"></i></a>
									<? } else { ?>									
										<?php if ($item['edit_link']) {echo '<a href="'.$item['edit_link'] . '" title="Редактировать" class="func"><i class="icon edit-icon"></i></a>';}?>
										<?php if ($item['del_link']) {echo '<a href="'.$item['del_link'] . '" title="Удалить" class="func"><i class="icon delete-icon"></i></a>';}?>	
									<? } ?>																
									<a href="<?php echo $item['comment_link'];?>" rel="bookmark"><?php echo $item['title']; ?></a>
								</h2>
								<div class="breadcrumbs">
									▪ <a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » С рождеством!
								</div>
								<div class="post-content">
									<?php echo $item['small_text']; ?>
								</div>
								<!-- /post-content -->
								<div class="tag-list">
									<?php echo $item['tag_name']; ?>
									<i class="icon tags-list-icon"></i>
									<ul>
										<li><a href="#" rel="tag">apple</a>,</li>
										<li><a href="#" rel="tag">mac</a>,</li>
										<li><a href="#" rel="tag">pc</a></li>
									</ul>
								</div>
								<!-- /tag-list -->
								<div class="post-meta"><div class="bg"><div class="bg clearfix">
									<div class="rate">
										<span>рейтинг: <strong>4</strong></span>
										голоса: <strong class="positive"><i class="icon positive-icon"></i>20</strong> <strong class="negative"><i class="icon negative-icon"></i>7</strong>
									</div>
									<ul>
										<li class="it date"><?php echo date("j F Y", strtotime($item['creation_date']));?></li>
										<li class="it com">
											<a href="<?php echo $item['comment_link'];?>#comments" class="with-icon-s"><i class="icon-s commets-icon"></i><?php echo $item['comments_count'];?> ответов</a>
										</li>
									</ul>
								</div></div></div>
								<!-- /post-meta -->							
							</div>
							<!-- /blog-post -->							
							<?php }?>
						<?php } else{ ?>
							<div style="text-align: center;width: 100%;">В данном разделе нет записей</div>
						<?php } ?>
						<ul class="pages-list clearfix">
							<?php echo $this -> post_list_pager;?>
						</ul>
						<!-- /pages-list -->
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php echo $this -> control_panel; ?>
						<div class="navigation">
							<div class="title">
								<h2>Блоги</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<ul class="nav-list">
								<li><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Авио</a></li>
								<li class="active"><i class="arrow-icon"></i><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>Internet</a>
									<ul>
										<?php require('blog_left_tree.tpl.php'); ?>
										<li><a href="#" class="with-icon-s"><i class="icon-s write-s-icon"></i>AUDI</a> (8)</li>
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
<!-- TEMPLATE: "Мои закладки" - закладки пользователя -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>			
			<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> ответов
							</div>
						</div>
						<!-- /display-filter -->
						<ul class="question-preview-list question-abridged-preview-view bookmarks-preview-list">
						<?$i=0; foreach($this->bookmarks_list as $key => $item) { ?>
							<li class="clearfix">
								<dl>
									<dt><a href="<?=$this->createUrl('Bookmarks', 'BookmarksView', array($item['id']))?>" title="<?=$item['title'].' ('.$item['url'].')';?>"><?=$item['title_cut'];?></a></dt>
									<dd class="breadcrumbs">
										<?php echo $this->category_row[0]['name']; $i++;?>
									</dd>
									<dd class="auth">добавил: <img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s wuser-icon"></i><?=$item['login']; ?></a></dd>
									<dd class="date"><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></dd>
									<dd class="number-of">
										<div>просмотры:  <strong><?=number_format($item['views'], 0, '',' '); ?></strong>
								<!-- 	 <br />комментарии: <strong><?=$item['count_comments']; ?></strong></div>  -->
									</dd>
									<dd class="number-of">
            						<?php if($item['user_id'] == Project::getUser()->getDbUser()->id) { ?>
              							<a href=<?=$this->createUrl('Bookmarks','BookmarksDelete',array($item['id']))?>>[Удалить]</a> 
              							<a href="<?=$this->createUrl('Bookmarks','BookmarksManage',array($item['id']))?>">[Редактировать]</a>
            						<?php } ?>										
									</dd>
								</dl>
							</li>
						<? } ?>	
						</ul>
  						<!-- панель-строка открытой категории -->
  					  	<?php if ((count($this->category_row) > 0) or ($this->show_imported_bookmarks == true)) { ?>
          		<!--		<b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>  -->
          				<?php if ($this->tag_name_selected !== null) { ?>
          					&nbsp;<b>(Тег:</b> <?=$this->tag_name_selected;?><b>)</b>
          				<? } ?>
  					<?php } ?>
  					<!-- /панель-строка открытой категории -->
  					<!-- строка тегов -->
						<?php include($this -> _include('list_tags.tpl.php')); ?>
  					<!-- /строка тегов -->					
						<ul class="pages-list clearfix">
							<?=$this->bookmarks_list_pager; ?>
						</ul>   
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('panel_control.tpl.php')); ?>								
						<div class="navigation">
							<div class="title">
								<h2>Категории</h2>
								<i title="Показать фильтр" class="filter-link icon show-filter-icon"></i>
							</div>
							<?php include($this -> _include('panel_category.tpl.php')); ?>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
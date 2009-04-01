<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest();
$v_categoryID = $request->getKeyByNumber(0);
if($v_categoryID) {
	$add = '/'.$v_categoryID.'';
}
else {
	$add = '';
}
$v_session = Project::getSession(); 
$bpp = $v_session->getKey('bpp'); ?>
<!-- TEMPLATE: "Каталог закладок" - основная вкладка раздела закладки -->
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
						</ul>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: 
							<?php if(!$bpp || $bpp == 10){ ?>
									<strong>10</strong> | <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false).$add; ?>/bpp:20">20</a> | <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false).$add; ?>/bpp:30">30</a> закладок
							<?php }elseif($bpp == 20) { ?>
									<a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false).$add; ?>/bpp:10">10</a> | <strong>20</strong> | <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false).$add; ?>/bpp:30">30</a> закладок
							<?php } elseif($bpp == 30) { ?>	
									<a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false).$add; ?>/bpp:10">10</a> | <a href="<?php echo $this->createUrl('Bookmarks', 'BookmarksList', null, false).$add; ?>/bpp:20">20</a> | <strong>30</strong> закладок
							<? } ?>
							</div>
						</div>
						<!-- /display-filter -->
						<ul class="question-preview-list question-abridged-preview-view bookmarks-preview-list">
						<?$i=0; foreach($this->bookmarks_list as $key => $item) { ?>
						<?php 
						$user = Project::getUser()->getDbUser()->getUserByLogin($item['login']);
						$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
						$avPath = $avatar['path'];
						if(!$avPath || $avPath == 'no.png') $avPath = 'no50.jpg';
						if($user['gender']) {
							$class = 'user-icon';	
						}
						else {
							$class = 'wuser-icon';
						} 
						?>						
							<li class="clearfix">
								<dl>
									<dt><a href="<?=$this->createUrl('Bookmarks', 'BookmarksView', array($item['id']))?>" title="<?=$item['title'].' ('.$item['url'].')';?>"><?=$item['title_cut'];?></a></dt>
									<dd class="breadcrumbs">
										<?php echo $item['bookmark_category']; $i++;?>
									</dd>
									<dd class="auth">добавил: <a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>"><img class="avatar" src="<?=$this->image_url.'avatar/'.$avPath;?>" style="width: 50px; height: 50px;" alt="" /></a><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s <?=$class; ?>"></i><?=$item['login']; ?></a></dd>
									<dd class="date"><?=date_format(new DateTime($item['creation_date']),'j M Y, H:i'); ?></dd>
									<dd class="number-of">
										<div>просмотры:  <strong><?=number_format($item['views'], 0, '',' '); ?></strong>
										<!--  комментарии: <strong><?=$item['count_comments']; ?></strong>	-->
										</div>
									</dd>
								</dl>
							</li>
						<? } ?>	
						</ul>
  						<!-- панель-строка открытой категории -->
  						<?php if (count($this->category_row) > 0) { ?>
         			<!--  	<b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>	-->
          					<?php if ($this->tag_name_selected !== null) { ?>
          						&nbsp;<b>(Тег:</b> <?=$this->tag_name_selected;?><b>)</b>
          					<? } ?>
						<?php } ?>
						<!-- строка тегов -->
						<?php include($this -> _include('list_tags.tpl.php')); ?>
						<!-- /строка тегов -->
  						<!-- /панель-строка открытой категории -->						
				 		<ul class="pages-list clearfix">
							<?=$this->bookmarks_list_pager; ?>
						</ul>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
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
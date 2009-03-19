<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<!-- TEMPLATE: "Каталог закладок" - основная вкладка раздела закладки -->
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<li><strong>Каталог закладок<span></span></strong></li>
							<li><a href="#">Популярные закладки</a></li>
						</ul>
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
										<?php echo $this->category_row[$i]['name']; $i++;?>
										▪ <a href="#">Последние посты</a> » <a href="#">РождествоM</a> » С рождеством!
									</dd>
									<dd class="auth">добавил: <img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s wuser-icon"></i><?=$item['login']; ?></a></dd>
									<dd class="date"><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></dd>
									<dd class="number-of">
										<div>просмотры:  <strong><?=number_format($item['views'], 0, '',' '); ?></strong><br />
											 комментарии: <strong><?=$item['count_comments']; ?></strong></div>
									</dd>
								</dl>
							</li>
						<? } ?>	
						</ul>
						<?=$this->bookmarks_list_pager; ?>
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
						</ul>   -->
  <!-- строка тегов -->
<?php include($this -> _include('list_tags.tpl.php')); ?>
  <!-- /строка тегов -->
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
				
				
				
				
				
				
				

<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>tab.js"></script>
<script language="JavaScript" type="text/javascript" src="<?=$this -> js_url; ?>category_panel.js"></script>

<div id="tabs">
<?php include($this -> _include('../tab_panel.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
  
<div class="tab-page tab-page-selected">
<!-- Вопросы пользователей -->

<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_left">
   <!-- панель слева -->
   <?php include($this -> _include('panel_category.tpl.php')); ?>
   <!-- /панель слева -->
  </td>
  <td class="next24u_right">
  <!-- панель-строка открытой категории -->
  <?php if (count($this->category_row) > 0) { ?>
  <div class="block_ee1">
    <div class="block_ee2">
      <div class="block_ee3">
        <div class="block_ee4">
          <div style="margin: 0px 10px;">
          <b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>
          <?php if ($this->tag_name_selected !== null) { ?>
          &nbsp;<b>(Тег:</b> <?=$this->tag_name_selected;?><b>)</b>
          <? } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <!-- /панель-строка открытой категории -->

<?php include($this -> _include('../footer.tpl.php')); ?>
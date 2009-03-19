<!-- TEMPLATE: "Мои закладки" - закладки пользователя -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
			<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
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
  						<?php if (count($this->category_row) > 0) { ?>
         					<b>Закладки категории:</b> &nbsp;<?=$this->category_row[0]['name']; ?>
          					<?php if ($this->tag_name_selected !== null) { ?>
          						&nbsp;<b>(Тег:</b> <?=$this->tag_name_selected;?><b>)</b>
          					<? } ?>
						<?php } ?>
						<!-- строка тегов -->
						<?php include($this -> _include('list_tags.tpl.php')); ?>
						<!-- /строка тегов -->
  						<!-- /панель-строка открытой категории -->						
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
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../tab_panel.tpl.php')); ?>
  
<div class="tab-page tab-page-selected">
<!-- Вопросы пользователей -->

<table  width="100%" height="100%" cellpadding="0">
 <tr>
  <td class="next24u_left">
   <!-- панель слева -->
   <?php include($this -> _include('panel_category.tpl.php')); ?>
   <?php include($this -> _include('panel_control.tpl.php')); ?>
   <!-- /панель слева -->
  </td>
  <td class="next24u_right">
  <!-- панель-строка открытой категории -->
  <?php if ((count($this->category_row) > 0) or ($this->show_imported_bookmarks == true)) { ?>
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
  <!-- строка тегов -->
<?php include($this -> _include('list_tags.tpl.php')); ?>
  <!-- /строка тегов -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">
       <div style="margin: 0px -10px;">
        <table class="questions">
         <tr>
          <td style="width: 100%; text-align: left;"><b>Закладка</b></td>
          <td><b>Автор</b></td>
          <!--<td><b>Категория</b></td>-->
          <td><b>Комментариев</b></td>
          <td><b>Просмотров</b></td>
          <td><b>Дата создания</b></td>
          <td><b>Действие</b></td>
         </tr>
         <? foreach($this->bookmarks_list as $key => $item) { ?>
         <?   ($key%2==0) ? $v_id = "cmod_tab2" : $v_id = "cmod_tab1"; ?>
         <tr id="<?=$v_id; ?>">
          <td style="text-align: left; white-space: normal;">
           <img src="<?=$this->image_url; ?>d_ld_ico2.png" id="ico2" />
             <a href="<?=$this->createUrl('Bookmarks', 'BookmarksView', array($item['id']))?>" title="<?=$item['title'].' ('.$item['url'].')';?>"><?=$item['title_cut'];?></a>
               <!-- $this- >createUrl('Bookmarks', 'BookmarksView', array($item['id'])) -->
               <!-- $item['description'] -->
          </td>
          <td style="text-align: center;"><a href="<?=$request->createUrl('Index','Index', null, $item['login']); ;?>"><?=$item['login']; ?></a></td><!-- TODO: User profile -->
          <!--<td style="text-align: center" width="70"><?=$item['bookmark_category']; ?></td>-->
          <td style="text-align: center;"><?=$item['count_comments']; ?></td>
          <td style="text-align: center;"><?=number_format($item['views'], 0, '',' '); ?></td>
          <td><?=date_format(new DateTime($item['creation_date']),'d.m.y H:i'); ?></td>
          <td>
            <?php if($item['user_id'] == Project::getUser()->getDbUser()->id) { ?>
              <a href=<?=$this->createUrl('Bookmarks','BookmarksDelete',array($item['id']))?>>[Удалить]</a> 
              <a href="<?=$this->createUrl('Bookmarks','BookmarksManage',array($item['id']))?>">[Редактировать]</a>
            <?php } ?>
          </td>
         </tr>
         <? } ?>
        </table>
       </div>
   <!-- листинг -->

    <?=$this->bookmarks_list_pager; ?>
   <!-- /листинг -->
      </div>
     </div>
    </div>
   </div>
  </td>
 </tr>
</table>
  <!-- /Вопросы пользователей -->
</div>
</div>

<?php include($this -> _include('../footer.tpl.php')); ?>
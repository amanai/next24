<!-- TEMPLATE: менеджер закладки "Редактировать закладку" -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
			<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?=$this -> flash_messages; ?>
				<?php if($this->current_user && $this->current_user->id > 0) { ?>
          <?php $v_form_action = $this->createUrl('Bookmarks', 'BookmarksManage', array($this->bookmark_row['id'])); ?>
					<form action="<?=$v_form_action;?>" method="post">
						<table width="100%" cellpadding="2">
              <tr>
                <td width="120">Заголовок закладки * </td>
                <td><input type="text" name="inp_bookmark_title" value="<?=$this->bookmark_row['title']; ?>" style="width: 100%;"></td>
              </tr>
              <tr>
                <td width="120">URL закладки * </td>
                <td><input type="text" name="inp_bookmark_url" value="<?=$this->bookmark_row['url']; ?>" style="width: 100%;"></td>
              </tr>
							<tr>
								<td width="100">Описание закладки * </td>
								<td><textarea name="inp_bookmark_description" style="width: 100%; height: 100px;"><?=$this->bookmark_row['description']?></textarea></a></td>
							</tr>
							<tr>
								<td>Категория</td>
								<td>
									<select name="select_cat_id">
								        	<? foreach ($this->bookmarks_category_list as $cat) {?>
                            <? if ($cat['level_item'] == 0) { ?>
                              <optgroup label="<?=$cat['name'];?>">
                            <? } else { ?>
  								        		<option value="<?=$cat['id']?>" <?if($cat['id']==$this->bookmark_row['bookmarks_tree_id']) { ?> selected <? } ?>><?=$cat['name']?></option>
                            <? } ?>
								        	<? } ?>
							        </select>
                      <input type="checkbox" name="inp_check_public" style="vertical-align: top;  margin-left: 20px; border: 0;" <? if ($this->bookmark_row['is_public']==1) print 'checked="checked"'; ?> ><span style="vertical-align: 20%; margin-left: 2px;">Публичная</span>
								</td>
							</tr>
							<tr>
								<td>Теги закладки</td>
								<td><input type="text"  value="<?=$this->bookmarks_tag_list?>" name="inp_tags" style="width: 100%;"></td> <!--TODO: load tags-->
							</tr>
							<tr>
                <td>&nbsp;</td>
								<td style="padding-right: 2px;">
                  <p style="text-align: left; color: gray; font-size: 10px; padding-left: 0.5em;">Максимальное число тегов - 10 шт. Теги перечисляются через запятую. Максимальная длина тега - 30 символов.</p>
                  <p style="text-align: right;"><input type="submit" name="submit" value="Отправить"></p>
                </td>
							</tr>
						</table>
					</form>
					<?php } else { ?>
						Создавать закладки могут только зарегестрированные пользователи
					<?php } ?>
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
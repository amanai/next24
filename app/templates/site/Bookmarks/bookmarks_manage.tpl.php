<!-- TEMPLATE: менеджер закладки "Редактировать закладку" -->
<?php include($this -> _include('../header.tpl.php')); ?>

<div id="tabs">
<?php $request = Project::getRequest(); ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksList'); ?>"><?=$this->tab_list_name; ?></a>
  </div>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksMostVisit'); ?>" title="<?=$this->tab_most_visit; ?>"><?=$this->tab_most_visit; ?></a>
  </div>
<? if($this->current_user && $this->current_user->id > 0) { ?>
  <div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="<?=$request->createUrl('Bookmarks','BookmarksUser'); ?>" title="<?=$this->tab_my_list_name; ?>"><?=$this->tab_my_list_name; ?></a>
  </div>
<? } ?>
  <div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);">
    <a href="#"><?=$this->tab_manage_bookmark_name?></a>
  </div>

<!-- тело страницы PageTab -->     
<div class="tab-page tab-page-selected">
<!-- отображение ошибки -->
<div><?foreach ($this->error as $error) { ?>
<span style="color: red;"><?=$error?></span><br />
<? } ?>
</div>
<!-- /отображение ошибки -->

	<div class="block_ee1">
		<div class="block_ee2">
			<div class="block_ee3">
				<div class="block_ee4">
					<div class="block_title"><h2><?=$this->tab_manage_bookmark_name?></h2></div>
					
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
								<td colspan="2" align="right" style="padding-right: 2px;"><input type="submit" name="submit" value="Отправить"></td>
							</tr>
						</table>
					</form>
					<?php } else { ?>
						Создавать закладки могут только зарегестрированные пользователи
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>
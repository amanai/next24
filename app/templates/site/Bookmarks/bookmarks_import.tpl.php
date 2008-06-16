<!-- TEMPLATE: Форма "Импортирование закладок" -->
<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

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
      <?=$this->tab_bookmarks_import?>
  </div>
<!-- вывод контента в самой странице (TabPage) - содержимого -->
<div class="tab-page tab-page-selected">
  
<!-- Вывод строки закладки -->
   <div class="block_ee1">
    <div class="block_ee2">
     <div class="block_ee3">
      <div class="block_ee4">      
       <div style="margin: 0px 10px;">
       <?=$this -> flash_messages; ?>
       <? if ($this->is_show_message == false) {?>
         Комментарии к импорту. Текст будет введен позже после согласования.
       <? } else { ?>
         Импорт закладок успешен.
       <? } ?>
       </div>     
      </div>
     </div>
    </div>
   </div>
<!-- /Вывод строки закладки -->
			
<!-- Форма ввода файла -->
<? if ($this->is_show_message == false) {?>
<form enctype="multipart/form-data" method="post" action="<?=$this->import_make_url;?>">
<input type="hidden" name="MAX_FILE_SIZE" value="<?=$this->max_file_upload_size;?>" />
    <div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
      <p>Выбрать файл закладок</p>
      <input type="file" name="inp_file" size="100"/>
      <input type="submit" name="Submit" value="Импортировать">
    </div></div></div></div>
</form>
<? } ?>
<!-- /Форма ввода файла -->
			</div>
		</div>
		
<?php include($this -> _include('../footer.tpl.php')); ?>
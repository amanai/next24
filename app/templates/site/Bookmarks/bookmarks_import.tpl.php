<!-- TEMPLATE: Форма "Импортирование закладок" -->
<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../tab_panel.tpl.php')); ?>

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
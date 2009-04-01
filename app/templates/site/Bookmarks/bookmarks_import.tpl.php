<!-- TEMPLATE: Форма "Импортирование закладок" -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
			<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
       				<?=$this -> flash_messages; ?>
       				<? if ($this->is_show_message == false) {?>
         				Комментарии к импорту. Текст будет введен позже после согласования.
       				<? } else { ?>
         				Импорт закладок успешен.
       				<? } ?>	
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
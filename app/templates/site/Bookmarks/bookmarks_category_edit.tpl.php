<!-- TEMPLATE: Страница редактирования категории закладки -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
			<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
					<?php echo $this -> flash_messages; ?>
    				<?php if ($this->action != 'BookmarksCategorySaveMessage') {
            			require('form_categoty_edit.tpl.php'); 
          			} else { ?>
       					<p>Добавление категории закладок прошло успешно.</p><br />
       					<p>Спасибо за то, что Вы предложили свою категорию. Она находится на проверке у модератора.</p>   
      					<p>Мы известим Вас о нашем решении добавить/не добавлять категорию в общее дерево категорий.</p>
       					<input type="hidden" name="inp_show_message_saved" value="1">
      				<? } ?>					
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
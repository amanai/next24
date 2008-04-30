<?php include($this -> _include('../header.tpl.php')); ?>

<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">

<form action="<?=$this->createUrl('Article', 'AddArticle')?>" method="POST">
<input type="hidden" value="" name="category" id="category">
	<table width="100%" cellpadding="2">
		<tr>
			<td colspan="2"><?=$this->message?></td>
		</tr>
		<tr>
			<td>Заголовок статьи</td>
			<td><input type="text" name="title" id="title"></td>
		</tr>
		<tr>
			<td width="15%">Раздел</td>
			<td width="85%">
				<?
					if($this->action == "AddArticle") {
						include($this -> _include('add_section.tpl.php'));
					} else {
						include($this -> _include('edit_section.tpl.php'));
					}
				?>
				<div id="add_cat"><a href="#" onclick='getElementById("new_cat_block").style.visibility = "visible";'>Добавить категорию</a></div>
			</td>
		</tr>
		<tr style="visibility: hidden" id="new_cat_block">
			<td>Новая категория</td>
			<td><input type="text" name="cat_title" id="cat_title"></td>
		</tr>
		<tr>
			<td>Разрешить комментарии</td>
			<td><input type="checkbox" name="allow_comment" id="allow_comment"></td>
		</tr>
		<tr>
			<td>Принимать участие в голосовании</td>
			<td><input type="checkbox" name="allow_rate" id="allow_rate"></td>
		</tr>
		<tr>
			<td colspan="2"><center>Страницы</center></td>
		</tr>
		<tr>
			<td colspan="2"><div id="pages">
				<?php if(count($this->pages > 0)) {?>
				<?foreach ($this->pages as $page): ?>
					<?php include($this -> _include('page_article.tpl.php')); ?>
				<?endforeach;?>
				<?php } ?>
			</div></td>
		</tr>
		<tr>
			<td colspan="2"><input type="button" value="Добавить страницу" onclick='ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxAddPage')?>);'></td>
		</tr>
		<tr>
			<td colspan="2" align="right" style="padding-right: 6px;"><input type="submit" name="submit" id="submit" value="Отправить"></td>
		</tr>
	</table>
</form>
				</div>

			</div>

<?php include($this -> _include('../footer.tpl.php')); ?>


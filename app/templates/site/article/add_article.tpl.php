<?php include($this -> _include('../header.tpl.php')); ?>

<form action="<?=$this->createUrl('Article', 'AddArticle')?>" method="POST">
<input type="hidden" value="" name="category">
	<table width="100%" cellpadding="2">
		<tr>
			<td>Заголовок статьи</td>
			<td><input type="text" name="title"></td>
		</tr>
		<tr>
			<td width="15%">Раздел</td>
			<td width="85%">
				<div id="level1" style="padding-top:5px">
					<select style="width:115px">
						<option value=""> -- Select -- </option>
						<?foreach ($this->cat_list as $cat):?>
							<option onclick='getElementById("category").value="<?=$cat['id']?>";ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxChangeCat', array($cat['id']))?>);' value="<?=$cat['id']?>"><?=$cat['name']?></option>
						<?endforeach;?>
					</select>
				</div>
				<div id="level2" style="padding-top:5px"></div>
				<div id="level3" style="padding-top:5px"></div>
				<div id="level4" style="padding-top:5px"></div>
				<div id="level5" style="padding-top:5px"></div>
			</td>
		</tr>
		<tr>
			<td>Разрешить комментарии</td>
			<td><input type="checkbox" name="allow_comment"></td>
		</tr>
		<tr>
			<td>Принимать участие в голосовании</td>
			<td><input type="checkbox" name="allow_rate"></td>
		</tr>
		<tr>
			<td colspan="2"><center>Страницы</center></td>
		</tr>
		<tr>
			<td colspan="2"><div id="pages"></div></td>
		</tr>
		<tr>
			<td colspan="2"><input type="button" value="Добавить страницу" onclick='ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxAddPage')?>);'></td>
		</tr>
		<tr>
			<td colspan="2" align="right" style="padding-right: 6px;"><input type="submit" name="submit" value="Отправить"></td>
		</tr>
	</table>
</form>

<?php include($this -> _include('../footer.tpl.php')); ?>


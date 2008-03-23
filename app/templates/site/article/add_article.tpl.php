<?php include($this -> _include('../header.tpl.php')); ?>

<form action="<?=$this->createUrl('Article', 'AddArticle')?>" method="POST">
<input type="hidden" value="" name="category">
	<table width="100%" cellpadding="2">
		<tr>
			<td width="100">Заголовок статьи</td>
			<td><input type="text" ></td>
		</tr>
		<tr>
			<td>Раздел</td>
			<td>
				<div id="level1">
					<select>
						<option value=""> -- Select -- </option>
						<?foreach ($this->cat_list as $cat):?>
							<option onclick='getElementById("category").value="<?=$cat['id']?>";ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxChangeCat', array($cat['id']))?>);' value="<?=$cat['id']?>"><?=$cat['name']?></option>
						<?endforeach;?>
					</select>
				</div>
				<div id="level2"></div>
				<div id="level3"></div>
				<div id="level4"></div>
				<div id="level5"></div>
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="button" onclick=""></td>
		</tr>
		<tr>
			<td colspan="2" align="right" style="padding-right: 6px;"><input type="submit" name="submit" value="Отправить"></td>
		</tr>
	</table>
</form>

<?php include($this -> _include('../footer.tpl.php')); ?>


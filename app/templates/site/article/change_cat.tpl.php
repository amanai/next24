<select>
	<option value=""> -- Select --</option>
	<?foreach ($this->cat_list as $cat):?>
		<option onclick='getElementById("category").value="<?=$cat['id']?>";ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxChangeCat', array($cat['id']))?>);' value="<?=$cat['id']?>"><?=$cat['name']?></option>
	<?endforeach;?>
</select>



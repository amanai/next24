<div id="level1" style="padding-top:5px">
	<select style="width:115px">
		<option value=""> -- Select -- </option>
		<?foreach ($this->cat_list as $cat):?>
			<option onclick='<?if($cat['level'] < 5) {?>getElementById("add_cat").style.visibility = "visible";<?} else {?>getElementById("add_cat").style.visibility = "hidden";<? } ?> getElementById("category").value="<?=$cat['id']?>";ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxChangeCat', array($cat['id']))?>);' value="<?=$cat['id']?>"><?=$cat['name']?></option>
		<?endforeach;?>
	</select>
</div>
<?for($i=0;$i<4;$i++):?>
	<div id="level<?=$i?>" style="padding-top:5px"></div>
<?endfor;?>
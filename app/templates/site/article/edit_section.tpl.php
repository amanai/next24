<?$i = 1;?>
<?foreach ($this->sect as $sect):?>
	<div id="level<?=$i?>" style="padding-top:5px">
		<select>
			<?foreach ($this->fill_sections[$i] as $section):?>
				<option onclick='<?if($cat['level'] < 5) {?>getElementById("add_cat").style.visibility = "visible";<?} else {?>getElementById("add_cat").style.visibility = "hidden";<? } ?> getElementById("category").value="<?=$cat['id']?>";ajax(<?=AjaxRequest::getJsonParam('Article', 'AjaxChangeCat', array($cat['id']))?>);' value="<?=$cat['id']?>" <?if($section['key'] == $sect) echo "selected "?>><?=$section['name']?></option>
			<?endforeach;?>
			<?$i++;?>
		</select>
	</div>
<?endforeach;?>
<?for(;$i<=5;$i++):?>
	<div id="level<?=$i?>" style="padding-top:5px"></div>
<?endfor;?>

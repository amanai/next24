<table class="dialog">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Редактирование категории
							</td>
							<td>
								<div class="button bclose"><a href="#">X</a></div>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="h_right"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
		</tr>
		<tr>
			<td class="c_left">&nbsp;</td>
			<td class="c_cen">
				<!-- САМ ДИАЛОГ -->
				<form id="edit_form">
				<table border="0" cellpadding="0" cellspacing="4">
					<tbody><tr>
						<td class="left_col">
						Название*:
						</td>
						<td class="right_col" style="width: 100%;">
						<input class="field" name="section_name" value="" type="text">
						</td>
					</tr>
					<tbody><tr>
						<td class="left_col">
						Родительская категория:
						</td>
						<td class="right_col" style="width: 100%;">
							<div id="level1" style="padding-top:5px">
							<select style="width:115px">
								<option value=""> -- Select -- </option>
								<?foreach ($this->cat_list as $cat):?>
									<option onclick='getElementById("category").value="<?=$cat['id']?>";ajax(<?=AjaxRequest::getJsonParam('AdminArticle', 'AjaxChangeCat', array($cat['id']))?>);' value="<?=$cat['id']?>"><?=$cat['name']?></option>
								<?endforeach;?>
							</select>
							</div>
							<div id="level2" style="padding-top:5px"></div>
							<div id="level3" style="padding-top:5px"></div>
							<div id="level4" style="padding-top:5px"></div>
							<div id="level5" style="padding-top:5px"></div>
  						</td>
					</tr>
				</tbody></table>
				</form>
				<!-- -->

			</td>
			<td class="c_right">&nbsp;</td>
		</tr>
		<tr>
			<td class="b_left">&nbsp;</td>
			<td class="b_cen"><div class="b_delim">
				<div class="button bbig" style="float: right;"><a href="#" >Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" >Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>
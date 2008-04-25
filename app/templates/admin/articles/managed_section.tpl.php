<?php 
	$k = new Key($this->cat['key']);
	$par = $k->getParent();
?>


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
				<form action="<?=Project::getRequest()->createUrl('AdminArticle', 'ManagedSection', array($this->cat['id']))?>" method="POST" id="edit_form">
				<input type="hidden" value="<?=$par?>" name="parent_id">
				<input type="hidden" name="sub" value="0" id="sub">
				<table border="0" cellpadding="0" cellspacing="4">
					<tbody><tr>
						<td class="left_col">
						Название*:
						</td>
						<td class="right_col" style="width: 100%;">
						<input class="field" name="section_name" value="<?=$this->cat['name']?>" type="text">
						</td>
					</tr>
					<tbody><tr>
						<td class="left_col">
						Родительская категория:
						</td>
						<td class="right_col" style="width: 100%;">
							<div id="level1" style="padding-top:5px">
							<select style="width:115px">
								<option value="" > -- Select -- </option>
								<?foreach ($this->tree as $n):?>
									<option onclick='getElementById("parent_id").value="<?=$n['key']?>";' value="<?=$n['key']?>" 
									<? if($par == $n['key']) echo selected;?>><?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?><?=$n['name']?></option>
								<?endforeach;?>
							</select>
							
							</div>
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
				<div class="button bbig" style="float: right;"><a href="#" onclick="getElementById('sub').value=1;getElementById('edit_form').submit()">Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>

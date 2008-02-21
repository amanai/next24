<table class="dialog">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Редактирование группы пользователей
							</td>
							<td>
								<div class="button bclose"><a href="#" onClick='cancel(<?php echo $this -> cancel_param;?>);'>X</a></div>
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
				<input name="id" value="<?php echo isset($this -> edit_data['id'])?$this -> edit_data['id']:null; ?>" type="hidden" />
				<table border="0" cellpadding="0" cellspacing="4">
					<tbody><tr>
						<td class="left_col">
						Название*:
						</td>
						<td class="right_col" style="width: 100%;">
						<input class="field" name="type_name" value="<?php echo isset($this -> edit_data['name'])?$this -> edit_data['name']:null; ?>" type="text">
						</td>
					</tr>
					<tbody><tr>
						<td class="left_col">
						Описание*:
						</td>
						<td class="right_col" style="width: 100%;">
							<textarea name="description" rows="10" cols="30"><?php echo isset($this -> edit_data['description'])?$this -> edit_data['description']:null; ?></textarea>
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
				<div class="button bbig" style="float: right;"><a href="#" onClick='cancel(<?php echo $this -> cancel_param;?>);'>Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" onClick='save(<?php echo $this -> save_param;?>);'>Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>
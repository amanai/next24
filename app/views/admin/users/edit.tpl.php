<table class="dialog">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo IMG_URL?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Добавление пользователя системы
							</td>
							<td>
								<div class="button bclose"><a href="#" onClick='cancel(<?php echo $this -> cancel_param;?>);'>X</a></div>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="h_right"><img src="<?php echo IMG_URL?>1x1.gif" alt=""></td>
		</tr>
		<tr>
			<td class="c_left">&nbsp;</td>
			<td class="c_cen">
				<!-- САМ ДИАЛОГ -->
				<form id="edit_user_form">
				<input name="id" value="<?php echo isset($this -> edit_data['id'])?$this -> edit_data['id']:null; ?>" type="hidden" />
				<table border="0" cellpadding="0" cellspacing="0">
					<tbody><tr>
						<td class="left_col">
						Логин:
						</td>
						<td class="right_col" style="width: 100%;">
						<input class="field" name="login" value="<?php echo isset($this -> edit_data['login'])?$this -> edit_data['login']:null; ?>" type="text">
						</td>
					</tr>
					<tr>
						<td class="left_col">
						Пароль:					</td>
						<td class="right_col">
						<input class="field" name="pass" value="" type="password">
						</td>
	
					</tr>
					<tr>
						<td class="left_col">
						Подтверждени:					</td>
						<td class="right_col">
						<input class="field" name="pass_confirm" value="" type="password">
						</td>
	
					</tr>
					<tr>
						<td class="left_col">
						Группа:
						</td>
						<td class="right_col">
							<select name="user_group">
								<?php foreach($this -> user_group_list as $item) { ?>
									<option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
	
					<tr>
						<td class="left_col">
						Забанен до:
						</td>
						<td class="right_col">
							<input class="hasDatepicker" size="30" value="дата" id="defaultFocus" type="text">
							<script>$('#defaultFocus').attachDatepicker();</script>
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
				<div class="button bbig" style="float: right;"><a href="#" onClick='save(<?php echo $this -> save_param;?>);'>Добавить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>

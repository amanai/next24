<table class="dialog">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo IMG_URL?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Редактирование пользователя системы
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
				<form id="edit_form">
				<input name="id" value="<?php echo isset($this -> edit_data['id'])?$this -> edit_data['id']:null; ?>" type="hidden" />
				<table border="0" cellpadding="0" cellspacing="4">
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
						Подтверждение:					</td>
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
									<option value="<?php echo $item['id'];?>" <?php if((int)$item['id'] === (int)$this -> edit_data['user_type_id']) echo 'selected';?>><?php echo $item['name'];?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<td class="left_col" valign="top">
						<?php if ($this -> banned) { ?>
							Разбанить:
						<?php } else { ?>
							Забанить:
						<?php } ?>
						</td>
						<td class="right_col">
							<?php if ($this -> banned) { ?>
								<input type="checkbox" name="unbann" /><span style="font-size:11px">(забанен до <b><?php echo $this -> banned_date; ?></b>)</span>
							<?php } else { ?>
								<input type="checkbox" name="bann" onClick='if (this.checked) $("div#ban_block").show(); else $("div#ban_block").hide();' />
								<div id="ban_block" style="display:none;">
									<table cellpadding="0" cellspacing="0">
										<tr>
											<td>
												Дата:
											</td>
											<td>
												<input readonly type="text" style="width:200px;" name="ban_date" id="ban_date" value="<?php echo $date; ?>">
	            								<script>$("#ban_date").date_input();</script>
											</td>
										</tr>
										<tr>
											<td>
												Предупреждение:
											</td>
											<td>
											  <textarea name="warning" style="width:200px;height:150px;"></textarea>
											</td>
										</tr>
									</table>
	            				</div>
							<?php } ?>
							<div><a id="sticky" title="история банов" href="<?php echo $this -> history_link; ?>" rel="<?php echo $this -> history_link; ?>">история банов</a></div>
							<script>$('#sticky').cluetip({activation: 'click', width: 650});</script>
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

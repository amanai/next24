<table class="dialog">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Добавление конкурса
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
				<form id="edit_form" action="<?=Project::getRequest()->createUrl('AdminArticle', 'SetCompetition', array($this->cat['id']))?>" method="POST">
				<input type="hidden" name="sub" value="0">
				<input type="hidden" id="id" name="id" value="<?=$this->node['id']?>">
				<?=var_dump($this->node);?>
				<table border="0" cellpadding="0" cellspacing="4">
					<tbody><tr>
						<td class="left_col">
						Дата начала: 
						</td>
						<td>
						<input readonly type="text" id="data_begin" name="data_begin">
						<script>$("#data_begin").date_input();</script>
						</td>
					</tr>
					<tbody><tr>
						<td class="left_col">
						Дата окончания:
						</td>
						<td class="right_col" style="width: 100%;">
							<input readonly type="text" id="data_end" name="data_end">
						<script>$("#data_end").date_input();</script>
  						</td>
					</tr>
				</tbody>
				<tbody><tr>
						<td class="left_col">
						Вознаграждение:
						</td>
						<td class="right_col" style="width: 100%;">
							<input type="text" id="reward" name="reward">
  						</td>
					</tr>
				</tbody>
				</table>
				</form>
				<!-- -->

			</td>
			<td class="c_right">&nbsp;</td>
		</tr>
		<tr>
			<td class="b_left">&nbsp;</td>
			<td class="b_cen"><div class="b_delim">
				<div class="button bbig" style="float: right;"><a href="#" onClick='cancel(<?php echo $this -> cancel_param;?>);'>Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" onclick="getElementById('sub').value=1;getElementById('edit_form').submit()">Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>
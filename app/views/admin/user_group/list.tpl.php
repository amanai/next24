		<div style="float: left;"><h3>Группы (типы) пользователей (UserType)</h3></div>
		<table class="list_table">
			<tr class="head">
				<td class="first" rowspan="100">&nbsp;</td>
				<td>
					N
				</td>
				<td>
					Название
				</td>
				<td>
					Описание
				</td>
				<td>
					Действия
				</td>
				<td class="last" rowspan="100">&nbsp;</td>
			</tr>
			<?php foreach($this -> group_list as $item) { ?>
			<tr>
				<td>
					<?php echo $item['number']; ?>
				</td>
				<td>
					<?php echo $item['name']; ?>
				</td>
				<td>
					<?php echo $item['description']; ?>
				</td>
				<td>
					<div class="button bsmall" style="float: left;">
						<a href="#" onClick='ajax(<?php echo $item['edit_link'];?>);'><img src="<?php echo $this -> image_url;?>icons/small_edit.gif" alt="Правка"/></a>
					</div>
					<div style="float: left;">
						<a href="#" onClick='ajax(<?php echo $item['right_link'];?>);'>Права доступа</a>
					</div>
				</td>
	
			</tr>
			<?php } ?>
		</table>
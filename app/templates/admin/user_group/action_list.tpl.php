		<div style="float: left;">Список всех действий контроллера <a href="#" onClick='cancel(<?php echo $this -> cancel_param;?>);'>Close</a></div>
		<table class="dialog" style="border:1px solid #000000;">
			<tr class="head">
				<td class="first" rowspan="100">&nbsp;</td>
				<td>
					N
				</td>
				<td>
					Действие
				</td>
				<td>
					По умолчанию
				</td>
				<td>&nbsp;</td>
			</tr>
			<?php foreach($this -> actions_list as $item) { ?>
			<tr>
				<td>
					<?php echo $item['number']; ?>
				</td>
				<td>
					<?php echo $item['name']; ?>
				</td>
				<td align="center">
					<?php if((int)$item['default'] == 1) echo '+'; else echo '-'; ?>
				</td>
				<td>
					<input onChange='ajax(<?php echo $item['change_access_link'];?>);' type="checkbox" <?php if((int)$item['access'] > 0) echo 'checked'; ?>  />
				</td>
			</tr>
			<?php } ?>
		</table>
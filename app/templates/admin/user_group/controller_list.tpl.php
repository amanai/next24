		<div style="float: left;"><h3>Список всех контроллеров (Controllers) <a href="#" onClick='cancel(<?php echo $this -> cancel_param;?>);'>Close</a></h3></div>
		<table class="dialog" style="border:1px solid #000000;">
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
					Ключ запроса
				</td>
				<td>
					Административный
				</td>
				<td>
					По умолчанию
				</td>
			</tr>
			<?php foreach($this -> controllers_list as $item) { ?>
			<tr>
				<td>
					<?php echo $item['number']; ?>
				</td>
				<td>
					<a href="#" onClick='ajax(<?php echo $item['action_list_link'];?>);'><?php echo $item['name']; ?></a>
					<div id="action_list_<?php echo $item['id']; ?>"></div>
				</td>
				<td>
					<?php echo $item['description']; ?>
				</td>
				<td>
					<?php echo $item['request_key']; ?>
				</td>
				<td align="center">
					<?php if((int)$item['admin'] == 1) echo '+'; else echo '-'; ?>
				</td>
				<td align="center">
					<?php if((int)$item['default'] == 1) echo '+'; else echo '-'; ?>
				</td>
			</tr>
			<?php } ?>
		</table>
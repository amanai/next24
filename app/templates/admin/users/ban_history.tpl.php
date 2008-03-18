<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<th>Когда</th>
		<th>До</th>
		<th>Тип</th>
		<th>Кем</th>
		<th>Причина</th>
	</tr>
	<?php foreach($this -> ban_list as $item ) { ?>
		<tr>
			<td><?php echo $item['action_date']; ?></td>
			<td><?php echo $item['banned_till']; ?></td>
			<td><?php if ($item['type'] == 1) echo 'забанен'; else echo 'разбанен'; ?></td>
			<td><?php echo $item['baned_by_login']; ?></td>
			<td><?php echo $item['cause']; ?></td>
		</tr>
	<?php } ?>
</table>
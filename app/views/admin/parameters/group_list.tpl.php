<div class="list">
	<div style="float: left;"><h3>Группы параметров (Controllers)</h3></div>

	<table class="list_table">
		<tr class="head">
			<td class="first" rowspan="100">&nbsp;</td>
			<td>
				N
			</td>
			<td>
				Описание
			</td>
			<td>
				Группа (controller)
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
				<?php echo $item['description']; ?>
			</td>
			<td>
				<?php echo $item['name']; ?>
			</td>
			<td>
				<div class="button bsmall" style="float: left;"><a href="<?php echo $this->router->createUrl('AdminParameter', 'EditGroup', array('id' => $item['id']));?>"><img src="<?php echo IMG_URL;?>icons/small_edit.gif" alt="Правка"/></a></div>
			</td>

		</tr>
		<?php } ?>
	</table>

</div>
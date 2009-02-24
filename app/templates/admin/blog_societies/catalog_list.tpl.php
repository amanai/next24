<?php include($this -> _include('../header.tpl.php')); ?>
<div class="list" id="list_block">
	<div style="float: left;"><h3>Глобальный каталог</h3></div>
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
				Действия
			</td>
			
			
			<td class="last" rowspan="100">&nbsp;</td>
		</tr>
		<?php foreach($this -> catalog_list as $item) { ?>
		<tr>
			<td>
				<?php echo $item['number']; ?>
			</td>
			<td>
				<?php echo $item['name']; ?> 
			</td>
			<td>
				<div class="button bsmall" style="float: left;"><a href="<?php echo $item['edit_link'];?>"><img src="<?php echo $this -> image_url;?>icons/small_edit.gif" alt="Правка"/></a></div>
				<div class="button bsmall" style="float: left;"><a href="#" onclick='if (confirm("Удалить пользователя <?php echo $item['first_name'] . " " . $item['last_name']; ?>?")){document.location="<?php echo $item['delete_link'];?>"}'><img src="<?php echo $this -> image_url;?>icons/small_del.gif" alt="Удаление"/></a></div>
			</td>

		</tr>
		<?php } ?>
	</table>
	<?php echo $this -> list_pager_html; ?>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>
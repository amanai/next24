<div class="list" id="users_list">
	<div style="float: left;"><h3>������������</h3></div>

	<table class="list_table">
		<tr class="head">
			<td class="first" rowspan="100">&nbsp;</td>
			<td>
				N
			</td>
			<td>
				���/�������
			</td>
			<td>
				�����
			</td>
			<td>
				������
			</td>
			<td>
				���� �����������
			</td>
			<td>
				�������
			</td>
			<td>
				��������
			</td>
			
			
			<td class="last" rowspan="100">&nbsp;</td>
		</tr>
		<?php foreach($this -> user_list as $item) { ?>
		<tr>
			<td>
				<?php echo $item['number']; ?>
			</td>
			<td>
				<?php echo $item['first_name']; ?> <?php echo $item['last_name']; ?> 
			</td>
			<td>
				<?php echo $item['login']; ?>
			</td>
			<td>
				<?php echo $item['group_name']; ?>
			</td>
			<td>
				<?php echo date("Y-m-d", strtotime($item['registration_date'])); ?>
			</td>
			<td>
				<?php if ((int)$item['banned'] == 0){ echo '���'; } else { echo '�� !!����!!'; } ?>
			</td>
			<td>
				<div class="button bsmall" style="float: left;"><a href="#" onClick='ajax(<?php echo $item['edit_link'];?>);'><img src="<?php echo IMG_URL;?>icons/small_edit.gif" alt="������"/></a></div>
				<div class="button bsmall" style="float: left;"><a href="#" onclick='if (confirm("������� ������������ <?php echo $item['first_name'] . " " . $item['last_name']; ?>?")){document.location="<?php echo $item['delete_link'];?>"}'><img src="<?php echo IMG_URL;?>icons/small_del.gif" alt="��������"/></a></div>
			</td>

		</tr>
		<?php } ?>
	</table>
</div>
<?php include(VIEWS_PATH.'pager.tpl.php'); ?>
<div id="edit_user"></div>
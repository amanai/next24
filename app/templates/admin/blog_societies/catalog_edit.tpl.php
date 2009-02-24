<?php include($this -> _include('../header.tpl.php')); ?>
<table class="dialog">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Редактирование раздела каталога
							</td>
							<td>
								<div class="button bclose"><a href="<?php echo $this -> cancel_param;?>">X</a></div>
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
				<form id="edit_form" method="post" action="<?php echo $this -> save_param;?>">
				<input name="id" value="<?php echo isset($this -> edit_data['id'])?$this -> edit_data['id']:null; ?>" type="hidden" />
				<table border="0" cellpadding="0" cellspacing="4">
					<tbody><tr>
						<td class="left_col">
						Название:
						</td>
						<td class="right_col" style="width: 100%;">
						<input class="field" name="name" value="<?php echo isset($this -> edit_data['name'])?$this -> edit_data['name']:null; ?>" type="text">
						</td>
					</tr>
				</tbody></table>
				</form>
				</td>
			<td class="c_right">&nbsp;</td>
		</tr>
		<tr>
			<td class="b_left">&nbsp;</td>
			<td class="b_cen"><div class="b_delim">
				<div class="button bbig" style="float: right;"><a href="<?php echo $this -> cancel_param;?>">Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" onClick='document.getElementById("edit_form").submit();'>Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>
<div class="list" id="list_block">
	<div style="float: left;"><h3>Метки каталога</h3></div>
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
				Постов
			</td>
			<td>
				Модерация
			</td>
			<td>
				Действия
			</td>
			
			
			<td class="last" rowspan="100">&nbsp;</td>
		</tr>
		<form action="<?php echo $this -> save_tag_action;?>" method="post">
			<?php foreach($this -> tag_list as $item) { ?>
				<input type="hidden" name="ids[<?php echo $item['id'];?>]" value="<?php echo $item['id']; ?>"/>
				<tr>
					<td>
						<?php echo $item['number']; ?>
					</td>
					<td>
						<input type="text" name="tag_name[<?php echo $item['id'];?>]" value="<?php echo $item['name']; ?>"/>
					</td>
					<td>
						<?php echo $item['posts_num']; ?> 
					</td>
					<td>
						<?php if((int)$item['active'] === 1){ echo 'ок'; } else{ ?> 
								<input type="radio" name="active[<?php echo $item['id'];?>]" value="0" /> отклонить (будет удален)<br/>
								<input type="radio" name="active[<?php echo $item['id'];?>]" value="1" checked /> принять
						<?php }?> 
					</td>
					<td>
						<div class="button bsmall" style="float: left;"><a href="#" onclick='if (confirm("Удалить метку <?php echo $item['name']; ?>?")){document.location="<?php echo $item['delete_link'];?>"}'><img src="<?php echo $this -> image_url;?>icons/small_del.gif" alt="Удаление"/></a></div>
					</td>
		
				</tr>
			<?php } ?>
				<input type="hidden" name="ids[0]" value="0"/>
				<tr>
					<td>
						
					</td>
					<td>
						<input type="text" name="tag_name[0]" value=""/>
					</td>
					<td>
						
					</td>
					<td>
						
					</td>
					<td>
						
					</td>
		
				</tr>
				<tr>
 	                <td colspan="4" align="center"><input type="submit" value="Обновить метки" /></td>
 	            </tr>
		</form>
	</table>
	<?php echo $this -> tag_pager_html; ?>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>
<form action="<?php echo $this->createUrl('Album', 'Create');?>" method="post">
	<input type="hidden" name="id" value="<?php echo $this -> album_id;?>"><br />
	<h1>Создание нового альбома</h1>
	<br />
	<table>
	<tr>
		<td width="100" valign="top">Название альбома</td>

		<td>
			<input type="text" name="album_name" style="width: 300px;" value="<?php echo $this -> album_name;?>"><br />
			<span id="micro2">Название, отображаемое при просмотре списка альбомов.</span>
		</td>
	</tr>
	<tr>
		<td valign="top">Уровень доступа</td>
		<td>

			<select style="width: 300px;" name="album_access">
				<?php foreach ($this -> access_list as $key=>$value){?>
					<option value="<?php echo $key;?>" <?php if ((int)$key === (int)$this -> album_access) {echo 'selected';} ?>><?php echo $value;?></option>
				<?php } ?>
			</select><br />
			<span id="micro2">Кто сможет смотреть и комментировать этот альбом.</span>
		</td>

	</tr>
	<tr>
		<td valign="top">Публикация на главной</td>
		<td>
			<input type="checkbox" name="is_onmain" <?php if (1 === (int)$this -> album_is_onmain) {echo 'checked';} ?> />
			<span id="micro2">Будет ли альбом публиковаться в списке фотоальбомов пользователей.</span>
		</td>

	</tr>
	<tr>
		<td colspan="2" align="right"><input type="submit" value="Создать альбом" /></td>
	</tr>
	</table>
</form>

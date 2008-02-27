<form action="<?php echo $this->createUrl('Album', 'Upload');?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td width="100">Файл</td>
			<td><input type="file" style="width: 300px;" name="picture" /><br /></td>
		</tr>
		<tr>
			<td width="100">Название</td>
			<td><input type="text" style="width: 300px;" name="pic_name" value="<?php echo $this -> pic_name;?>" /><br /></td>
		</tr>
		<tr>
			<td width="100">В рейтинге</td>
			<td><input type="checkbox" name="rating" <?php if ($this -> rating) echo 'checked';?>  /><br /></td>
		</tr>
		<tr>
			<td width="100">На главной</td>
			<td><input type="checkbox" name="on_main" <?php if ($this -> on_main) echo 'checked';?> /><br /></td>
		</tr>
		<tr>
			<td valign="top">Уровень доступа</td>
			<td>
				<select style="width: 300px;" name="pic_access">
					<?php foreach ($this -> access_list as $key=>$value){?>
						<option value="<?php echo $key;?>" <?php if ((int)$this -> pic_access === $key) echo 'selected'; ?>><?php echo $value;?></option>
					<?php } ?>
				</select><br />
				<span id="micro2">Кто сможет смотреть и комментировать эту фотографию.</span>
			</td>

		</tr>
		<tr>
			<td valign="top">Альбом</td>
			<td>
				<select style="width: 300px;" name="album_id">
					<?php foreach ($this -> album_list as $item) {?>
						<option value=<?php echo (int)$item['id'];?>  <?php if ((int)$this -> album_id === (int)$item['id']) echo 'selected'; ?> ><?php echo $item['name'];?></option>
					<?php } ?>
				</select><br />
				<span id="micro2">В какой альбом будет загружено изображение.</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="Загрузить" /></td>
		</tr>
	</table>
</form>
<form action="<?php echo $this->createUrl('Blog', 'Save');?>" method="post">
	<h1>Редактирование блога</h1>
	<br />
	<table>
	<tr>
		<td width="100" valign="top">Название</td>

		<td>
			<input type="text" name="blog_title" style="width: 300px;" value="<?php echo $this -> blog_title;?>"><br />
			<span id="micro2">Название блога.</span>
		</td>
	</tr>
	<tr>
		<td valign="top">Уровень доступа</td>
		<td>

			<select style="width: 300px;" name="blog_access">
				<?php foreach ($this -> access_list as $key=>$value){?>
					<option value="<?php echo $key;?>" <?php if ((!$this -> blog_title&&$key==2)||((int)$key === (int)$this -> blog_access)) {echo 'selected';} ?>><?php echo $value;?></option>
				<?php } ?>
			</select><br />
			<span id="micro2">Кто сможет смотреть и комментировать в этом блоге.</span>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="submit" value="Сохранить" /></td>
	</tr>
	</table>
</form>

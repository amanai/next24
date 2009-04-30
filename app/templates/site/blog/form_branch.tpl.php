<form action="<?php echo $this->createUrl('Blog', 'SaveBranch');?>" method="post">
	<input type="hidden" name="branch_id" value="<?php echo $this -> branch_id;?>"><br />

	<h1>Создание/редактирование раздела</h1>
	<br />
	<table>
	<tr>
		<td width="100" valign="top">Название</td>

		<td>
			<input type="text" name="branch_name" style="width: 300px;" value="<?php echo $this -> branch_name;?>"><br />
			<span id="micro2">Название раздела.</span>
		</td>
	</tr>
	<tr>
		<td valign="top">Раздел каталога</td>
		<td>
		<input type="hidden" name="blog_catalog" value="1" />
<!-- 
			<select style="width: 300px;" name="blog_catalog">
				<?php foreach ($this -> catalog_list as $key=>$value){?>
					<option value="<?php echo $value['id'];?>" <?php if ((int)$value['id'] === (int)$this -> blog_catalog_id) {echo 'selected';} ?>><?php echo $value['name'];?></option>
				<?php } ?>
			</select><br />	
			<span id="micro2">К какому разделу глобального каталога принадлежит.</span>	 -->
		</td>
	</tr>
	<tr>
		<td valign="top">Родительский раздел</td>
		<td>
			<? if (!is_array($this -> parent_list)) {
					if ($this -> parent_list == 1){
						echo 'Невозможно изменить родительский раздел, у данного есть зависимые разделы';
					} else {
						echo 'Невозможно изменить родительский раздел';
					}
				} else {
			?>
			<select style="width: 300px;" name="parent_branch">
				<option value="0">---</option>
				<?php foreach ($this -> parent_list as $key=>$value){?>
					<option value="<?php echo $value['id'];?>" <?php if ((int)$value['id'] === (int)$this -> parent_key) {echo 'selected';} ?>><?php echo $value['name'];?></option>
				<?php } ?>
			</select><br />
			<? } ?>
		</td>
	</tr>
	
	<tr>
		<td valign="top">Уровень доступа</td>
		<td>

			<select style="width: 300px;" name="branch_access">
				<?php foreach ($this -> access_list as $key=>$value){?>
					<option value="<?php echo $key;?>" <?php if ((int)$key === (int)$this -> branch_access) {echo 'selected';} ?>><?php echo $value;?></option>
				<?php } ?>
			</select><br />
			<span id="micro2">Кто сможет смотреть посты в этом разделе.</span>
		</td>
	</tr>
<!-- 	
	<tr>
		<td valign="top">Код баннера</td>
		<td>
            <textarea style="width: 300px; height:100px;" name="blog_banner_code"><?php echo $this->blog_banner_code; ?></textarea><br/>
			<span id="micro2">Вы можете добавлять свои баннеры в посты.</span>
		</td>
	</tr>	 -->
	<tr>
		<td colspan="2" align="right"><input type="submit" name="save" value="Сохранить" />&nbsp;&nbsp;&nbsp;<input type="submit" name="delete" value="Удалить" onclick="return confirm('Автоматически удалятся все записи раздела. Уверены?');" /></td>
	</tr>
	</table>
</form>

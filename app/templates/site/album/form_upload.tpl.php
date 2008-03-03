<script type="text/javascript">
<!--
var fc=2;
function More()
	{
	// Создание нового элемента
	var newElem = document.createElement("div");
	newElem.id="field_"+fc;
	newElem.innerHTML='<input type="file" name="photo_file_'+fc+'" style="width: 300px;" />';
	fc++;
	// Получение элемента-контейнера
	var cont = document.getElementById("f_cont");
	// Добавление контейнеру нового элемента
	cont.appendChild(newElem);
	// Ссылки
	ShowHideLinks();
	}
	
function Del()
	{
	// Получение элемента-контейнера
	if (fc>2)
		{
		var elem = document.getElementById("field_"+(fc-1));
		var cont = document.getElementById("f_cont");
		cont.removeChild(elem);
		fc--;
		}
	// Ссылки
	ShowHideLinks();
	}
	
function ShowHideLinks()
	{
	var elem = document.getElementById("del_link");
	if (fc>2)
		{
		elem.style.display='inline';
		elem.style.visibility='visible';
		}
	else
		{
		elem.style.display='none';
		elem.style.visibility='hidden';
		}
	}
-->
</script>
<form action="<?php echo $this->createUrl('Album', 'Upload');?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td width="100">Файл</td>
			<td>
				<div id="f_cont">
					<div id="field_1">
						<input type="file" name="photo_file_1" style="width: 300px;" />
					</div>
				</div>
				<div style="text-align: right;">
					<a href="#" onClick="More(); return false;" id="add_link">Добавить еще поле</a>
					<a href="#" onClick="Del(); return false;" id="del_link" style="display: none; visibility: hidden;">Убрать поле</a>
				</div>
			</td>
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
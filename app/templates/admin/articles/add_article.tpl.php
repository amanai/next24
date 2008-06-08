<script language="JavaScript">
	function addPage() {
	/*	el = document.getElementById('pages');
		el.innerHTML = el.innerHTML + '<tr><td>Загаловок страницы</td><td><input type="text" id="title_page[]" name="title_page[]" /></td></tr><tr><td>Текст страницы</td><td><?php
				$oFCKeditor = new FCKeditor('article_content[]') ;
				$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
				$oFCKeditor -> Value = $this -> full_text;
				$oFCKeditor -> Width = 700;
				$oFCKeditor -> Create() ;
			?></td></tr>';*/
		var tbody = document.getElementById('dialog').getElementsByTagName('TBODY')[0];
		var row = document.createElement("TR");
    	tbody.appendChild(row);
    	var td1 = document.createElement("TD");
    	var td2 = document.createElement("TD");
    	row.appendChild(td1);
    	row.appendChild(td2);
    	td1.innerHTML = "Загаловок страницы";
    	td2.innerHTML = '<input type="text" id="title_page[]" name="title_page[]" />';
    	var row = document.createElement("TR");
    	tbody.appendChild(row);
    	var td1 = document.createElement("TD");
    	var td2 = document.createElement("TD");
    	row.appendChild(td1);
    	row.appendChild(td2);
    	td1.innerHTML = "Текст страницы";
    	td2.innerHTML = '<?php
				$oFCKeditor = new FCKeditor('article_content[]') ;
				$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
				$oFCKeditor -> Value = $this -> full_text;
				$oFCKeditor -> Width = 700;
				$oFCKeditor -> Create() ;
			?>';
	}
</script>

<table class="dialog" width="100%">
	<tbody>
		<tr>
			<td class="h_left"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
			<td class="h_cen">
				<table>
					<tbody>
						<tr>
							<td class="text">
								Добавить статью
							</td>
							<td>
								<div class="button bclose"><a href="#">X</a></div>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="h_right"><img src="<?php echo $this -> image_url;?>1x1.gif" alt=""></td>
		</tr>
		<tr>
			<td class="c_left">&nbsp;</td>
			<td class="c_cen">
				<!-- САМ ДИАЛОГ -->
				<form action="<?=Project::getRequest()->createUrl('AdminArticle', 'AddArticle')?>" method="POST" id="edit_form">
				<input type="hidden" name="sub" value="0" id="sub">
				<table width="100%" id="dialog">
				<tbody>
					<tr>
						<td width="20%">Заголовок статьи</td>
						<td width="80%"><input type="text" id="article_title"></td>
					</tr>
					<tr>
						<td>Раздел</td>
						<td>
							<select>
								<option> -- select -- </option>
								<? foreach ($this->cat_list as $n): ?>
									<option>
										<?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?><?=$n['name']?>
									</option>
								<? endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Разрешить комментарии</td>
						<td><input type="checkbox" id="allow_comment"></td>
					</tr>
					<tr>
						<td>Принимать участие в голосовании</td>
						<td><input type="checkbox" name="allow_rate" id="allow_rate"></td>
					</tr>
					<tr>
						<td>Страницы</td>
						<td><input type="button" onclick="addPage();" value="Добавить страницу"></td>
					</tr>
					<tr>
						<td>Загаловок страницы</td>
						<td><input type="text" id="title_page[]" name="title_page[]" /></td>
					</tr>
					<tr>
						<td>Текст страницы</td>
						<td><?php
								$oFCKeditor = new FCKeditor('content_page[]') ;
								$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
								$oFCKeditor -> Value = $this -> full_text;
								$oFCKeditor -> Width = 700;
								$oFCKeditor -> Create() ;
							?>
						</td>
					</tr>
				</tbody>
				</table>
				</form>
				<!-- -->

			</td>
			<td class="c_right">&nbsp;</td>
		</tr>
		<tr>
			<td class="b_left">&nbsp;</td>
			<td class="b_cen"><div class="b_delim">
				<div class="button bbig" style="float: right;"><a href="#" onClick=''>Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" onclick="getElementById('sub').value=1;getElementById('edit_form').submit()">Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>
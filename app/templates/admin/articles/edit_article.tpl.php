

<script language="JavaScript">


	var i = 0;
	function addPage() {
		i++;
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
				$oFCKeditor = new FCKeditor("content_page[]") ;
				$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
				$oFCKeditor -> Width = 700;
				$oFCKeditor -> Create();
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
				<form id="edit_form">
				<input type="hidden" name="sub" value="0" id="sub">
				<table width="100%" id="dialog">
				<tbody>
					<tr>
						<td width="20%">Заголовок статьи</td>
						<td width="80%"><input type="text" name="article_title" id="article_title" value="<?=$this->edit_data['title']?>"></td>
					</tr>
					<tr>
						<td>Раздел</td>
						<td>
							<select name="article_cat">
								<? foreach ($this->cat_list as $n): ?>
									<option value="<?=$n['id']?>" <? if((int)$n['id'] == (int)$this->edit_data['articles_tree_id']) echo 'selected'; ?>>
										<?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?><?=$n['name']?>
									</option>
								<? endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Разрешить комментарии</td>
						<td><input type="checkbox" id="allow_comment" name="allow_comment" <?if ($this->edit_data['allowcomments'])echo "checked"?>></td>
					</tr>
					<tr>
						<td>Принимать участие в голосовании</td>
						<td><input type="checkbox" name="allow_rate" id="allow_rate" <?if ($this->edit_data['rate_status'])echo "checked"?>></td>
					</tr>
					<tr>
						<td>Страницы</td>
						<td><input type="button" onClick="addPage();" value="Добавить страницу"></td>
					</tr>
					<? if(count($this->edit_pages) <= 0) {?>
					<tr>
						<td>Загаловок страницы</td>
						<td><input type="text" id="title_page[]" name="title_page[]" /></td>
					</tr>
					<tr>
						<td>Текст страницы</td>
						<td><?php
								$oFCKeditor = new FCKeditor('content_page[]') ;
								$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
								$oFCKeditor -> Width = 700;
								$oFCKeditor -> Create() ;
							?>
						</td>
					</tr>
					<? } else { ?>
						<?foreach ($this->edit_pages as $page):?>
							<tr>
								<td>Загаловок страницы</td>
								<td><input type="text" id="title_page[]" name="title_page[]" value="<?=$page['title']?>"/></td>
							</tr>
							<tr>
								<td>Текст страницы</td>
								<td><?php
										$oFCKeditor = new FCKeditor('content_page[]') ;
										$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
										$oFCKeditor -> Value = $page['p_text'];
										$oFCKeditor -> Width = 700;
										$oFCKeditor -> Create() ;
									?>
								</td>
							</tr>
						<?endforeach;?>
					<? } ?>
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
				<div class="button bbig" style="float: right;"><a href="#" onClick='cancel(<?=$this->cancel_param;?>);'>Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" onclick='save(<?=$this->save_param;?>);'>Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>


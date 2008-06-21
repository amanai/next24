
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
						<td><div id="add_btn"><input type="button" onClick='ajax(<?=$this->add_page_link?>)' value="Добавить страницу"></div></td>
					</tr>
					<? if($this->num_page <= 0) {?>
					<tr>
						<td>Загаловок страницы11</td>
						<td><input type="text" id="title_page[]" name="title_page[]" /></td>
					</tr>
					<tr>
						<td>Текст страницы</td>
						<td><?php
								$oFCKeditor = new FCKeditor("content_page[0]") ;
								$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
								$oFCKeditor -> Width = 700;
								$oFCKeditor -> Create() ;
							?>
						</td>
					</tr>
					<? } else { ?>
						<?for($i = 0;$i < $this->num_page; $i++):?>
							<tr>
								<td>Загаловок страницы</td>
								<td>
									<input type="text" id="title_page[]" name="title_page[]" value="<?=$this->edit_pages[$i]['title']?>"/>
									<input type="hidden" id="id_page[]" name="id_page[]" value="<?=$this->edit_pages[$i]['id']?>" />
								</td>
							</tr>
							<tr>
								<td>Текст страницы</td>
								<td><?php
										$oFCKeditor[$i] = new FCKeditor("content_page[$i]") ;
										$oFCKeditor[$i] -> BasePath = $this -> js_url.'fckeditor/' ;
										$oFCKeditor[$i] -> Value = $this->edit_pages[$i]['p_text'];
										$oFCKeditor[$i] -> Width = 700;
										$oFCKeditor[$i] -> Create() ;
									?>
								</td>
							</tr>
							
						<?endfor;?>
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
				<div class="button bbig" style="float: right;" id="save_btn"><a href="#" onclick='save(<?=$this->save_param?>);'>Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>

<div id="page_div"></div>


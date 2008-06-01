<script language="JavaScript">
	function addPage() {
		el = getElementById('pages');
		el.innerHTML = el.innerHTML + '<textarea name="page_text[]"></textarea>';
	}
</script>

<table class="dialog">
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
				<table>
					<tr>
						<td>Заголовок статьи</td>
						<td><input type="text" id="article_title"></td>
					</tr>
					<tr>
						<td>Раздел</td>
						<td>----</td>
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
						<td><input type="button" onclick="javascript: addPage()"></td>
					</tr>
					<tr>
						<td colspan="2"><div id="pages"></div></td>
					</tr>
				</table>
				<!-- -->

			</td>
			<td class="c_right">&nbsp;</td>
		</tr>
		<tr>
			<td class="b_left">&nbsp;</td>
			<td class="b_cen"><div class="b_delim">
				<div class="button bbig" style="float: right;"><a href="#" onClick=''>Отмена</a></div>
				<div class="button bbig" style="float: right;"><a href="#" onclick=''>Сохранить</a></div>
			</td>
			<td class="b_right">&nbsp;</td>
		</tr>
	</tbody>
</table>
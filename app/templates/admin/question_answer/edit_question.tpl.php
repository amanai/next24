<?php include($this -> _include('../header.tpl.php')); ?>
	<div class="list">
<table class="dialog">
				<tr>
					<td class="h_left"><img src="<?=$this -> image_url?>1x1.gif" alt=""/></td>
					<td class="h_cen">
						<table>
							<tr>
								<td class="text">
									Редактирование вопроса
								</td>
								<td>
									<div class="button bclose"><a href="#">X</a></div>
								</td>
							</tr>
						</table>
					</td>
					<td class="h_right"><img src="<?=$this -> image_url?>1x1.gif" alt=""/></td>
				</tr>
					
				<tr>
					<td class="c_left">&nbsp;</td>
					<td class="c_cen" >
					
						<!-- САМ ДИАЛОГ -->
					<form id="form_edit_question" action="<?=$this->createUrl('AdminQuestionAnswer', 'EditQuestion', array(Project::getRequest()->getKeyByNumber(0), 1))?>" method="POST">
						<table cellspacing="0" cellpadding="0" border="0" >
							<tr>
								<td class="left_col">Текст  &nbsp;&nbsp;</td>
								<td class="right_col" style="width: 100%;"><textarea name="question_text" style="height: 100px;"><?=$this->question['q_text']?></textarea></td>
							</tr>
							<tr>
								<td class="left_col">Категория Вопроса &nbsp;&nbsp;</td>
								<td class="right_col">
									<select name="cat_list">
								        	<?foreach ($this->cat_list as $cat):?>
								        		<option value="<?=$cat['id']?>"><?=$cat['name']?></option>
								        	<?endforeach;?>
							        </select>
								</td>
							</tr>
							<tr>
								<td class="left_col">Теги  &nbsp;&nbsp;</td>
								<td class="right_col" ><input type="text" class="field" name="tags" value="<?=$this->tags?>"></td>
							</tr>
							<tr>
						</table>
					</form>
						
						<!-- -->

					</td>
					<td class="c_right">&nbsp;</td>
				</tr>
				<tr>
					<td class="b_left">&nbsp;</td>
					<td class="b_cen"><div class="b_delim">
						<div class="button bbig" style="float: right;"><a href="#">Отмена</a></div>
						<div class="button bbig" style="float: right;"><a href="#" name="submit" onclick='document.getElementById("form_edit_question").submit();'>Сохранить</a></div>
					</div></td>
					<td class="b_right">&nbsp;</td>
				</tr>

			</table>
	</div>
<?php include($this -> _include('../footer.tpl.php')); ?>
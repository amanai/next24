<?php include($this -> _include('../header.tpl.php')); ?>

<div style="float: left;"><h3>Вопросы</h3></div><!-- TODO: descript -->
 	   	 	<div class="list" id="list_block">
				<div class="options">
					<div>
					Категория: 
						<select name="cat_id" onchange="window.location.href='<?=$this->createUrl('AdminQuestionAnswer','QuestionList').'/'?>'+this.options[this.selectedIndex].value">
							<option value="0">-- Все --</option>
						   	<?foreach ($this->cat_list as $cat):?>
						   		<option value="<?=$cat['id']?>" <?=(Project::getRequest()->getKeyByNumber(0) == $cat['id']) ? "selected" : "" ?>><?=$cat['name']?></option>
						   	<?endforeach;?>
						</select>
					</div>
				</div>
				<table class="list_table">
					<tr class="head">
						<td class="first" rowspan="100">&nbsp;</td>
						<td>
							Вопрос
						</td>
						<td>
							Автор
						</td>
						<td>
							Ответов
						</td>
						<td>
							Дата создания
						</td>
						<td>
							Действие
						</td>
					</tr>
				<?foreach ($this->question_list as $question):?>
					<tr>
						<td><?=$question['q_text']?></td>
						<td><?=$question['login']?></td>						
						<td><?=$question['a_count']?></td>
						<td><?=$question['creation_date']?></td>
						<td><div class="button bsmall" style="float: left;"><a href="#" onclick='ajax(<?=AjaxRequest::getJsonParam('AdminQuestionAnswer', 'EditQuestion', array($question['id']));?>)'><img src="<?=$this -> image_url?>icons/small_edit.gif" alt="Правка"/></a></div> 
						<div class="button bsmall" style="float: left;"><a href="<?=$this->createUrl('AdminQuestionAnswer','DeleteQuestion',array($question['id']))?>"><img src="<?=$this -> image_url?>icons/small_del.gif" alt="Удалить"/></a></div></td>
					</tr>
				<?endforeach;?>
				</table>
			</div>

<?php include($this -> _include('../footer.tpl.php')); ?>
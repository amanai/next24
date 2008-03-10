<?php include($this -> _include('../header.tpl.php')); ?>

<div style="float: left;"><h3>Вопросы</h3></div><!-- TODO: descript -->
 	   	 	<div class="list">
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
						<td><a href="<?=$this->createUrl('AdminQuestionAnswer','EditQuestion',array($question['id']))?>">[edit]</a> <a href="<?=$this->createUrl('AdminQuestionAnswer','EditQuestion',array($question['id']))?>">[delete]</a></td>
					</tr>
				<?endforeach;?>
				</table>
			</div>

<?php include($this -> _include('../footer.tpl.php')); ?>
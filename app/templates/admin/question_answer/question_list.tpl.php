<?php include($this -> _include('../header.tpl.php')); ?>

<div style="float: left;"><h3>Категории</h3></div><!-- TODO: descript -->
 	   	 	<div class="list">
				<div class="options">
					<div class="button bnormal" style="float: left;"><a href="<?=$this->createUrl('AdminQuestionAnswer','ManagedCat')?>">Добавить</a></div>
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
						<td><a href="#">[edit]</a> <a href="#">[delete]</a></td>
					</tr>
				<?endforeach;?>
				</table>
			</div>

<?php include($this -> _include('../footer.tpl.php')); ?>
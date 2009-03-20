<?php include($this -> _include('../header.tpl.php')); ?>
<ul class="view-filter clearfix">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
</ul>
<div>
	<?foreach ($this->error as $error):?>
		<?=$error?><br />
	<?endforeach;?>
</div>
<div class="content-header">
	<h1><?=$this->tab_manage_question_name?><i class="icon ask-icon"></i></h1>					
	<?php if($this->current_user && $this->current_user->id > 0) { ?>
		<form action="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', array($this->question['id']))?>" method="post" class="ask-form">
			<table>
				<tr class="textarea-field">
					<td colspan="5"><textarea name="question_text" rows="5" cols="20"><?=$this->question['q_text']?></textarea></td>
				</tr>
				<tr>
					<td class="label-field">
						<label for="f1">Категория</label>
					</td>
					<td class="select-field">
						<select id="f1" name="cat_id">
						<?foreach ($this->question_cat as $cat):?>
							<option value="<?=$cat['id']?>" <?if($cat['id']==$this->question['questions_cat_id']) { ?> selected <? } ?>><?=$cat['name']?></option>
						<?endforeach;?>
						</select>
					</td>
					<td class="label-field">
						<label for="f2">Tэги</label>
					</td>
					<td class="input-field">
						<input id="f2" type="text" value="<?=$this->question_tag_list?>" name="tags" />
					</td>
					<td class="button-field"><input type="submit" value="Спросить" /></td>
				</tr>
			</table>
		</form>				
	<?php } else { ?>
		Задавать вопросы могут только зарегестрированные пользователи
	<?php } ?>
</div>						
<?php include($this -> _include('../footer.tpl.php')); ?>
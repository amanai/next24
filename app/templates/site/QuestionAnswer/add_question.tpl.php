<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
					<?foreach ($this->error as $error):?>
						<?=$error?><br />
					<?endforeach;?>					
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
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', null, $this->current_user->login)?>"><i class="icon macomm-icon"></i> Задать вопрос</a></li>
								<li><a href="<?php echo $this->createUrl('QuestionAnswer', 'UserQuestions', null, $this->current_user->login); ?>"><i class="icon faq-icon"></i>Мои вопросы</a></li>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestionsAnswers',null, $this->current_user->login)?>"><i class="icon mcomm-icon"></i>Мои ответы</a></li>
							</ul>
						</div>
						<?php $par['u_id']= $this->current_user->id ?>
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<?php include($this -> _include('../footer.tpl.php')); ?>
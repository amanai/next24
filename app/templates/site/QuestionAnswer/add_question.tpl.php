<?php include($this -> _include('../header.tpl.php')); ?>

<div id="tabs">
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=Project::getRequest()->createUrl('QuestionAnswer','List')?>"><?=$this->tab_list_name?></a></div>
			<?php if($this->current_user && $this->current_user->id > 0) { ?>
				<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestions')?>"><?=$this->tab_my_list_name?></a></div> 
			<?php } ?>
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->tab_manage_question_name?></a></div>
			<div class="tab-page tab-page-selected">

	<div class="block_ee1">
		<div class="block_ee2">
			<div class="block_ee3">
				<div class="block_ee4">
					<div class="block_title"><h2><?=$this->tab_manage_question_name?></h2></div>
					<?php if($this->current_user && $this->current_user->id > 0) { ?>
					<form action="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', array($this->question['id']))?>">
						<table width="100%" cellpadding="2">
							<tr>
								<td width="100">Текст вопроса</td>
								<td><textarea name="question_text" style="width: 100%; height: 100px;"><?=$this->question['q_text']?></textarea></a></td>
							</tr>
							<tr>
								<td>Категория</td>
								<td>
									<select name="cat_id">
								        	<?foreach ($this->question_cat as $cat):?>
								        		<option value="<?=$cat['id']?>"><?=$cat['name']?></option>
								        	<?endforeach;?>
							        </select>
								</td>
							</tr>
							<tr>
								<td>Теги вопроса</td>
								<td><input type="text"  value="<?=$this->question_tag_list?>" name="tags" style="width: 100%;"></td> <!--TODO: load tags-->
							</tr>
							<tr>
								<td colspan="2" align="right" style="padding-right: 6px;"><input type="submit" name="submit" value="Отправить"></td>
							</tr>
						</table>
					</form>
					<?php } else { ?>
						Задавать вопросы могут только зарегестрированные пользователи
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>
<?php $comment_num = count($this->comment_list); ?>
<?php if($comment_num > 0) { ?>
<!-- comments -->
<div class="comments">
	<h2><i class="icon-s comment-m-icon"></i>Комментарии <em>(<?=$comment_num; ?>)</em></h2>
	<ul class="comment-entry">
	<?php foreach($this->comment_list as $key => $item){ ?>
	<?php 
		  if ($this -> user_id){
			$sVars = $item['id'].'';
			if ($item['login']) $sVars .= ", '".$item['login']."'";
			else $sVars .= ", ''";
		  } 
	?>
		<li class="c-holder">
			<div class="c-meta clearfix">
			<?php if ($this -> user_id && $this->allowComment){ ?>
				<ul class="controll">
					<li><a href="#addCommentAnchor" onclick="commentQuote('<?=$sVars; ?>');">цитировать</a></li>
					<?php if ($this->isAdmin){ ?>
					<li>| <a href="javascript: void(0);" onclick="showChangeComment(<?php echo $item['id']; ?>);">редактировать</a></li>
					<?php } ?>
					<?php if ($item['del_link'] !== false && ($item['user_id'] == $this -> user_id || $this->isAdmin)){ ?>
					<li>| <a href="<?php echo $item['del_link'];?>">удалить</a></li>
					<?php }?>
				</ul>
			<? } ?>	
				<ul class="info">
					<li>
					<?php 
					if ($item['avatar_id'] && $item['base_avatar_id']){
					   $avatar_path = ($item['sys_av_id'])?$item['sys_av_path']:$item['avatar_path']; 
					?>
					<img class="avatar" style="width: 28px; height: 25px;" alt="<?php echo $item['avatar_name'];?>" src="<?php echo $this->image_url."avatar/".$avatar_path; ?>" />
					<? } ?>
					<a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a><i class="arrow-icon vcard-icon"></i></li>
					<li class="date"><?php echo date("j F Y H:i", strtotime($item['creation_date']));?></li>
				</ul>
			</div>
			<div class="c-content">
			<?php 
				if ($item['mood_text'] || ($item['mood'] && $item['mood_name'])){
				$mood_text = ($item['mood_text'])?$item['mood_text']:$item['mood_name'];
			?>	
				<blockquote>
					<div class="cite">цитата <span><?=$item['mood_name']; ?></span></div>
					<div class="quote">
						<p>
							<?php echo $mood_text; ?>
						</p>
					</div>
				</blockquote>				
			<?php } ?>	
				<p id="comment_quote<?php echo $item['id']; ?>">
					<?=$this->parseCommentText($item['text']); ?>
				</p>		
					<?php if ($item['adm_redacted']){ echo '<p class="alert">Отредактировано администратором.</p>';} ?>
					<?php if ($item['warning_id']){ echo '<p class="alert">Предупреждение: '.$item['warning_cause'].'</p>';} ?>
					<?php if ($this->isAdmin){ ?>
					<div id="div_comment_edit<?php echo $item['id']; ?>" class="hidden">
					   <form action="<?php echo $this->change_comment_url;?>" method="post">
					   <input type="hidden" name="comment_id" value="<?php echo $item['id']; ?>" />
					   <input type="hidden" name="item_name" value="<?php echo $this->item_name;?>" />
					   <input type="hidden" name="element_id" value="<?php echo $this->add_comment_element_id;?>" />
					   <textarea id="editCommentArea" name="editCommentArea" style="width: 100%; height: 100px;"><?php echo $item['text']; ?></textarea>
					   Предупреждение: <input type="text" name="warning_text" size="100" value="" /><br/>
					   <input type="submit" name="change_comment" value="Изменить" />
					   </form>
					</div>
					<?php } ?>
					<p class="signature">Моя подпись</p>								
			</div>
		</li>	
<? } ?>
</ul>
<? echo $this -> comment_list_pager;?>

<?php 
// Add Comment
if ($this -> user_id && $this->allowComment){
?>
<!-- /comment-entry -->
<div class="leave-comment">
	<h2><a name="addCommentAnchor"></a>Задать вопрос</h2>
	<div class="rules"><a href="#">правила</a></div>
	<form action="<?php echo $this->add_comment_url;?>" method="post" class="comment-form">
		<input type="hidden" name="id" value="<?php echo $this->add_comment_id;?>" />
	    <input type="hidden" name="element_id" value="<?php echo $this->add_comment_element_id;?>" />
	    <input type="hidden" name="cur_controller" value="<?php echo $this->cur_controller;?>" />
	    <input type="hidden" name="cur_action" value="<?php echo $this->cur_action;?>" />
	    <input type="hidden" name="item_name" value="<?php echo $this->item_name;?>" />								
		<table>
			<tr class="textarea-field">
				<td colspan="4"><textarea id="addCommentArea" name="comment" rows="5" cols="20"></textarea></td>
			</tr>
			<tr>
				<td class="select-field">
					<select name="avatar_id">
			    		<option value="0"> [Выберите аватар для сообщения]</option>
						<?php
							foreach ($this->user_avatars as $user_avatar){
			    				$selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected":"";
			    				echo '<option value="'.$user_avatar['id'].'" '.$selected.'>'.$user_avatar['av_name'].'</option>';
							}
						?>
					</select>
				</td>
				<td class="select-field big-select-field">
					<select id="mood_id" name="mood_id" onchange="commentMoodCheck();" >
			    		<option value="0"> [Введите текст настроения, или выберите имеющиеся] </option>
						<?php
							foreach ($this->user_moods as $mood){
			    				echo '<option value="'.$mood['id'].'">'.$mood['name'].'</option>';
							}
						?>
					</select>
				</td>
				<td class="input-field">
					<input type="text" value="Авто, Гонки, Погонять" />
				</td>
				<td class="button-field"><input name="add_comment" type="submit" value="Комментировать" /></td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: center;">
					<input type="text" id="mood_text" name="mood_text" maxlength="100" style="width: 335px;" />
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- /leave-comment -->
<? } ?>
</div>
<!-- /comments -->
<? } ?>
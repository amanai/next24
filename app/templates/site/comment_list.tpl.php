<?php 
foreach($this->comment_list as $key => $item){ 
?>
	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3">
				<div class="block_ee4" style="width: 100%;">
					<div class="block_title">
						<div class="block_title_left">
							<h2><a href="<?php echo UserController::getProfileUrl($item['login']);?>"><?php echo $item['login'];?></a></h2>
						</div>
						<div class="block_title_right">
						    <?php 
						    if ($this -> user_id){
						        $sVars = $item['id'].'';
						        if ($item['login']) $sVars .= ", '".$item['login']."'";
						        else $sVars .= ", ''";
						        echo '[<a href="#addCommentAnchor" onclick="commentQuote('.$sVars.')">Цитировать</a>]';
						    } 
						    ?>
							<?php if ($item['del_link'] !== false && ($item['user_id'] == $this -> user_id || $this->isAdmin)){ ?>
								<span class="dellink"> (<a href="<?php echo $item['del_link'];?>" >Удалить комментарий</a>)</span>
							<?php }?>
							<?php if ($this->isAdmin){ ?>
							    <span class="dellink"> (<a href="javascript: void(0);" onclick="showChangeComment(<?php echo $item['id']; ?>);" >Редактировать</a>)</span>
							<?php } ?>
							<?php echo date("j F Y H:i", strtotime($item['creation_date']));?>
						</div>
					</div>
					<div class="av_preview av_gallery right5">
					<?php 
					if ($item['avatar_id'] && $item['base_avatar_id']){
					   $avatar_path = ($item['sys_av_id'])?$item['sys_av_path']:$item['avatar_path']; 
					?>
					   <img style="margin: 5px;" alt="<?php echo $item['avatar_name'];?>" src="<?php echo $this->image_url."avatar/".$avatar_path; ?>"/>
					<?php
					}
					?>
					</div>
					<div class="comment_text">
					
					<?php if ($item['adm_redacted']){ echo '<span class="red">Отредактировано администратором.</span>';} ?>
					<?php if ($item['warning_id']){ echo '<span class="red">Предупреждение: '.$item['warning_cause'].'</span>';} ?>
					
					<div id="comment_quote<?php echo $item['id']; ?>">
					<?php 
					echo $this->parseCommentText($item['text']);
					?>
					</div>
					
					
					<?php 
					if ($item['mood_text'] || ($item['mood'] && $item['mood_name'])){
					    $mood_text = ($item['mood_text'])?$item['mood_text']:$item['mood_name'];
					?>
					<br/><hr class="hr_comment"  align="left" />
					<div class="micro3"><?php echo $mood_text; ?></div>
					<?php } ?>
					</div>
					
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
				</div>
				<div class="rmb14">
				</div>
	</div></div></div>
<?php
}
?>
<? echo $this -> comment_list_pager;?>

<?php 
// Add Comment
if ($this -> user_id){
?>
        <form action="<?php echo $this->add_comment_url;?>" method="post">
		<input type="hidden" name="id" value="<?php echo $this->add_comment_id;?>" />
	    <input type="hidden" name="element_id" value="<?php echo $this->add_comment_element_id;?>" />
	    <input type="hidden" name="cur_controller" value="<?php echo $this->cur_controller;?>" />
	    <input type="hidden" name="cur_action" value="<?php echo $this->cur_action;?>" />
	    <input type="hidden" name="item_name" value="<?php echo $this->item_name;?>" />
		<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
			<table width="100%">
			<tr>
				<td><h2><a name="addCommentAnchor"></a>Оставить комментарий</h2></td>
			</tr>
	
			<tr>
				<td><textarea id="addCommentArea" name="comment" style="width: 100%; height: 100px;"></textarea></td>
			</tr>
			<tr>
			    <td nowrap>
			    <select name="avatar_id" >
			    <option value="0" /> [Выберите аватор для сообщения]
			<?php
			foreach ($this->user_avatars as $user_avatar){
			    $selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected":"";
			    echo '<option value="'.$user_avatar['id'].'" '.$selected.' />'.$user_avatar['av_name'];
			}
			?>
			    </select>
			    &nbsp;&nbsp;&nbsp;
			    <select id="mood_id" name="mood_id" onchange="commentMoodCheck();">
			    <option value="0" /> [Введите текст настроения, или выберите имеющиеся]
			<?php
			foreach ($this->user_moods as $mood){
			    echo '<option value="'.$mood['id'].'" />'.$mood['name'];
			}
			?>
			    </select>&nbsp;
			    <input type="text" id="mood_text" name="mood_text" maxlength="100" style="width: 200px;" />

			
			   </td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 5px;"><input type="submit" name="add_comment" value="Комментировать"></td>
			</tr>
			</table>
		</div></div></div></div>
		</form>
<!--		
	</td>
</tr>
</table>
-->
<?php 
}
?>
<form action="<?php echo $this->createUrl('Blog', 'PostSave');?>" method="post">
	<input type="hidden" name="id" value="<?php echo $this -> post_id;?>"><br />
	<input type="hidden" name="page_number" value="<?php echo $this -> post_page_number;?>"><br />
	
	<h1>Создание/редактирование поста</h1>
	<br />
	<table>
	<tr>
		<td width="100" valign="top">Заголовок</td>

		<td>
			<input type="text" name="post_title" style="width: 300px;" value="<?php echo $this -> post_title;?>"><br />
			<span id="micro2">Название поста.</span>
		</td>
	</tr>
	<tr>
		<td width="100" valign="top">Анонс</td>
		<td>
			<?php
				$oFCKeditor = new FCKeditor('post_small_text') ;
				$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
				$oFCKeditor -> Value = $this -> small_text;
				$oFCKeditor -> Width = 600;
				$oFCKeditor -> Create() ;
			?>
			<span id="micro2">Текст, отображаемый при просмотре списка постов.</span>
		</td>
	</tr>
	<tr>
		<td width="100" valign="top">Текст</td>
		<td>
			<?php
				$oFCKeditor = new FCKeditor('post_full_text') ;
				$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
				$oFCKeditor -> Value = $this -> full_text;
				$oFCKeditor -> Width = 600;
				$oFCKeditor -> Create() ;
			?>
			<script language="JavaScript">
				var smallTextSet=false;
			
				function Test() {
					alert(FCKeditorAPI.GetInstance('post_small_text').GetHTML());
					// FCKeditorAPI.GetInstance('post_small_text').GetHTML() - получаем код
					// FCKeditorAPI.GetInstance('post_small_text').SetHTML() - устанавливаем код
					// OnFocus() - ставим обработчик 
				}
				
				function setSmallText() {
					if (!smallTextSet) {
						small=FCKeditorAPI.GetInstance('post_small_text').GetHTML();
						full=FCKeditorAPI.GetInstance('post_full_text').GetHTML();
						FCKeditorAPI.GetInstance('post_full_text').SetHTML(small+full);
						smallTextSet=true;
					}
				}
				
				function FCKeditor_OnComplete( editorInstance )	{
					if (editorInstance.Name=='post_full_text') {
    					editorInstance.Events.AttachEvent( 'OnFocus', setSmallText ) ;
					}
				}
				//alert(FCKeditorAPI.GetInstance('post_small_text'));
			</script>
			<span id="micro2">Полный текст сообщения.</span>
		</td>
	</tr>
	<tr>
		<td valign="top">Раздел</td>
		<td>
			<select style="width: 300px;" name="post_branch" >
				<option value="0">---</option>
				<?php foreach ($this -> branch_list as $item){?>
					<option onClick='ajax(<?php echo $item['change_branch_param']; ?>);' value="<?php echo $item['id'];?>" <?php if ((int)$item['id'] === (int)$this -> post_tree_id) {echo 'selected';} ?> style="padding-left:<?php echo $item['level']*20; ?>px"><?php echo $item['name'];?></option>
				<?php } ?>
			</select><br />
			<span id="micro2">Раздел, в котором находится блог.</span>
		</td>
	</tr>
	<tr>
		<td valign="top">Метка поста</td>
		<td>
			<div id="tag_list"><?php include($this -> _include('post_tag.tpl.php')); ?></div>
			<span id="micro2">Кто сможет смотреть и комментировать этот пост.</span>
		</td>
	</tr>
	<!--
	<tr>
		<td valign="top">Отправить на модерацию в Лучшие за день</td>
		<td>
			<?php if ($this -> best_post == BEST_POST_STATUS::NO) { ?>
				<input type="checkbox" name="best_post" />
			<?php } elseif($this -> best_post == BEST_POST_STATUS::MODERATION) {?>
				Отправлен на модерацию
			<?php } elseif($this -> best_post == BEST_POST_STATUS::APPROVED) {?>
				Одобрен модератором
			<?php } else { ?>
				Отклонен модератором
			<?php } ?>
		</td>

	</tr>
	-->
	<tr>
		<td valign="top">Разрешать комментировать</td>
		<td>
			<input type="checkbox" name="allow_comments" <?php if (1 === (int)$this -> post_allow_comments) {echo 'checked';} ?> />
			<span id="micro2">Смогут ли пользователи комментировать пост</span>
		</td>
	</tr>
<? if (!$this->post_id) { ?>
	<tr>
		<td valign="top">В "Лучшие за день"</td>
		<td>
			<input type="checkbox" name="best_post"/>
			<span id="micro2">Пост будет добавлен на модерацию в "Лучшие за день"</span>
		</td>
	</tr>
<? } ?>
	<tr>
		<td valign="top">Уровень доступа</td>
		<td>

			<select style="width: 300px;" name="post_access">
				<?php foreach ($this -> access_list as $key=>$value){?>
					<option value="<?php echo $key;?>" <?php if ((int)$key === (int)$this -> post_access) {echo 'selected';} ?>><?php echo $value;?></option>
				<?php } ?>
			</select><br />
			<span id="micro2">Кто сможет смотреть и комментировать этот пост.</span>
		</td>
	</tr>
	<tr>
		<td valign="top">Настроение</td>
		<td>
			<select style="width: 300px;" name="post_mood">
				<option value="0">[Введите текст настроения, или выберите имеющиеся]</option>
				<? $flag=false; ?>
				<?php foreach ($this -> mood_list as $key=>$value){?>
					<option value="<?php echo $value['name'];?>" <?php if ($value['name'] == $this -> post_mood) {$flag=true; echo 'selected';} ?>><?php echo $value['name'];?></option>
				<?php } ?>
			</select><br />
			<input type="text" id="mood_text" name="mood_text" value="<?=!$flag?$this -> post_mood:'';?>" maxlength="100" style="width: 200px;" /><br />
			<span id="micro2">Настроение автора во время написания поста.</span>
		</td>

	</tr>
	<tr>
		<td valign="top">Аватар</td>
		<td>

			<select style="width: 300px;" name="post_avatar">
				<option value="0">---</option>
				<?php 
    			foreach ($this -> user_avatars as $user_avatar){
    				$selected = ($user_avatar['id']==$this->avatar_id)?"selected":"";
    			    echo '<option value="'.$user_avatar['id'].'" '.$selected.' />'.$user_avatar['av_name'];        
				} 
				?>
			</select><br />
			<span id="micro2">Настроение автора во время написания поста.</span>
		</td>

	</tr>
	<tr>
		<td colspan="2" align="right"><input type="submit" value="Сохранить" /></td>
	</tr>
	</table>
</form>

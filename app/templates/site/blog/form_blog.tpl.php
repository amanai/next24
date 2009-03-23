<h2 class="page-ttl">Настройки блога</h2>
<form class="main-form" action="<?php echo $this->createUrl('Blog', 'Save');?>" method="post">
	<fieldset>
		<ul>
			<li class="field-it">
				<div class="label"><label for="f1">Название блога</label></div>
				<div class="field f-small">
					<input name="blog_title" type="text" id="f1" value="<?php echo $this -> blog_title;?>" />
					<span class="field-help">Как будет называться ваш блог</span>
				</div>
			</li>
			<li class="field-it">
				<div class="label"><label for="f2">Уровень доступа</label></div>
				<div class="field f-small">
					<select name="blog_access" id="f2">
					<?php foreach ($this -> access_list as $key=>$value){?>
						<option value="<?php echo $key;?>" <?php if ((!$this -> blog_title&&$key==2)||($this -> blog_title&&(int)$key === (int)$this -> blog_access)) {echo 'selected';} ?>><?php echo $value;?></option>
					<?php } ?>
					</select>
					<span class="field-help">Кто сможет смотреть и комментировать в этом блоге.</span>
				</div>
			</li>
			<li class="button"><input type="submit" value="Сохранить" /></li>
		</ul>
	</fieldset>
</form>

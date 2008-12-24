	<h2 class="tmarg">Создание нового типа объектов</h2><br>

	<?=$this -> flash_messages?$this -> flash_messages.'<br/>':''; ?>
	
	<input type="hidden" name="add_type" value="1" />
	<p>Название типа мест:&nbsp;&nbsp;<input type="text" name="type_name" class="field" maxlength="50" /></p>
	<span id="micro2">Название пишите полностью, без сокращений.<br>Например: <em>Техникум</em>.</span><br><br>
	<p><input type="submit" value="Создать" class="button" name="create_type" style="padding:0px" /></p>

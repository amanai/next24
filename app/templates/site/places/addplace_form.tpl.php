				<h2 class="tmarg">Создание нового места <?=$this->geo_type_name;?> (<?=$this->country_name;?>/<?=$this->city_name;?>)</h2><br>

				<?=$this -> flash_messages?$this -> flash_messages.'<br/>':''; ?>
				
				<input type="hidden" name="add_place" value="1" />
				<p>Название:&nbsp;&nbsp;<input type="text" name="place_name" class="field" maxlength="50" /></p>
				<span id="micro2">Название пишите полностью, без сокращений.<br>Например: <em>Средняя школа №33</em> или <em>Петрозаводский Государственный Университет</em>.</span><br><br>
				<p><input type="submit" value="Сохранить" class="button" name="create_place" style="padding:0px" /></p>


<span class="field">
	<label for="f5" class="label">Город</label>
	<select id="f5" name="select_search_city">
		<option value="0">не важно</option>
		<?php foreach($this -> city_list as $item) { ?>
			<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
		<?php } ?>
	</select>
</span>

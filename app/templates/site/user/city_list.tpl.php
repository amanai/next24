<select name="city">
	<option value="0">---</option>
	<?php foreach($this -> city_list as $item) { ?>
		<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected';}?>><?php echo $item['title'];?></option>
	<?php } ?>
</select>

<select name="state">
	<option value="0" onclick='ajax(<?php echo $item['change_empty_state_param'];?>);'>---</option>
	<?php foreach($this -> state_list as $item) { ?>
		<option onclick='ajax(<?php echo $item['change_state_param'];?>);' value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected';}?>><?php echo $item['title'];?></option>
	<?php } ?>
</select>

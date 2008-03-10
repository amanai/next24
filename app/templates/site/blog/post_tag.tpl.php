<select style="width: 300px;" name="post_tag" >
	<option value="0">---</option>
	<?php foreach ($this -> tag_list as $item){?>
		<option value="<?php echo $item['id'];?>" <?php if ((int)$item['id'] === (int)$this -> post_tag_id) {echo 'selected';} ?>><?php echo $item['name'];?></option>
	<?php } ?>
</select>
<select name="state" class="field" onChange='changeList(<?=$this->change_state_param;?>, this);'>
	<option value="0">---</option>
	<?php foreach($this -> state_list as $item) { ?>
		<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected';}?>><?php echo $item['name'];?></option>
	<?php } ?>
</select>

<span class="field">
	<label for="f5st" class="label">Область/Штат</label>
	<select id="f5st" name="select_social_state" onchange='changeList(<?=$this->change_state_param;?>, this);'>
		<option value="0">не важно</option>
		<?php foreach($this -> state_list as $item) { ?>
			<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
		<?php } ?>
	</select>
</span>
<?
$name=$this->_nested_params['drop_down_name'];
$name_id=$this->_nested_params['drop_down_name'].'_id';
$message1=$this->_nested_params['message1'];
$message2=$this->_nested_params['message2'];
$entities=$this->_nested_params['entities'];
?>			
			<span id="<?=$name;?>_block">
				<select id="<?=$name;?>" style="width: 250px;" onChange="reload_dropdowns('<?=$name;?>');" name="<?=$name_id;?>"<?=$this->isClosed($name)?' disabled="disabled"':''?>>
					<? if ($this->isClosed($name)) { ?><option value="0" selected="selected"><?=$message1;?></option>
					<? } elseif (!$this->session->$name_id) { ?><option value="0" selected="selected"><?=$message2;?></option><? } ?>
					<? foreach ($entities as $item) { ?>
						<option value="<?=$item['id'];?>"<?=($item['id']==$this->session->$name_id?' selected="selected"':'');?>><?=$item['name'];?></option>
					<? } ?>
				</select>
			</span>
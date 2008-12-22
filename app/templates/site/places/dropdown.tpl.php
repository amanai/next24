<?
$name=$this->_drop_down_name;
$name_id=$this->_drop_down_name.'_id';
$message1=$this->_message1;
$message2=$this->_message2;
?>			
			<select id="<?=$name;?>" style="width: 150px;" name="<?=$name_id;?>"<?=$this->isClosed($name)?' disabled="disabled"':''?>>
				<? if ($this->isClosed($name)) { ?><option value="0" selected="selected"><?=$message1;?></option>
				<? } elseif (!$this->session->$name_id) { ?><option value="0" selected="selected"><?=$message2;?></option><? } ?>
				<? foreach ($this->countries as $item) { ?>
					<option value="<?=$item['id'];?>"<?=($item['id']==$this->session->country_id?' selected="selected"':'');?>><?=$item['name'];?></option>
				<? } ?>
			</select>
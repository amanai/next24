<?php foreach($this -> blog_catalog as $item) {?>
	<div style="padding-left:<?php echo  $this -> level*20;?>px;clear:both;padding-top:3px;">
		<?php if ($item['need_subscribe'] === true){ ?>
			<div style="float:left;"><input onChange='ajax(<?php echo $item['subscribe_param'];?>);' type="checkbox"  value="<?php echo $item['id'];?>" <?php if ($item['subscribed']) echo 'checked'; ?>/></div>
		<?php } ?>
		<?php if ($item['count_subitems']) { ?>
			<div style="float:left;padding-leftt:5px;padding-top:3px;" id="bti_<?php echo $item['id'].'_'.$this -> level;?>"><a href="#" onClick='ajax(<?php echo $item['ajax_param'];?>);'><img src="<?php echo $this -> image_url;?>icons/plus.gif" /></a></div>
		<?php } ?>
		<div style="float:left;padding-left:5px;padding-top:3px;"><?php echo $item['name']; ?></div>
		<div style="" id="btl_<?php echo $item['id'].'_'.$this -> level;?>"></div>
	</div>
<?php } ?>
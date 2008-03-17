<?php foreach($this -> blog_catalog as $item) {?>
	<div style="padding-left:<?php echo  $this -> level*20;?>px;">
		<?php if ($item['need_subscribe'] === true){ ?>
			<input onChange='ajax(<?php echo $item['subscribe_param'];?>);' type="checkbox"  value="<?php echo $item['id'];?>" <?php if ($item['subscribed']) echo 'checked'; ?>/>
		<?php } ?>
		<?php if ($item['count_subitems']) { ?>
		<a href="#" onClick='ajax(<?php echo $item['ajax_param'];?>);'><?php echo $item['name'];?></a>
		<?php } else { echo $item['name']; } ?>
		<div id="btl_<?php echo $item['id'].'_'.$this -> level;?>"></div>
	</div>
<?php } ?>
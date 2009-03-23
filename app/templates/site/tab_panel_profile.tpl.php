<?php 
if (count($this -> tab_list)) { ?>
	<?php foreach ($this -> tab_list as $item) { ?>
			<?php if ($item['selected'] === true) { ?>
				<li class="active"><a href="<?php echo $item['url'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['name'] ?></a></li>
			<? } else {?>	
				<li><a href="<?php echo $item['url'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['name'] ?></a></li>
			<? } ?>		
	<?php } ?>
<?php } ?>
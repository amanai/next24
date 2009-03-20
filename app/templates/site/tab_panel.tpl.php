<?php 
if (count($this -> tab_list)) { ?>
	<?php foreach ($this -> tab_list as $item) { ?>
		<li>
			<?php if ($item['selected'] === true) { ?>
				<strong><?php echo $item['name'] ?><span></span></strong>
			<? } else {?>	
				<a href="<?php echo $item['url'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['name'] ?></a>
			<? } ?>	
		</li>		
	<?php } ?>
<?php } ?>
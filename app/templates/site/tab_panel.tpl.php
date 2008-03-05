<?php if (count($this -> tab_list)) { ?>
	<div id="tabs">
	<?php foreach ($this -> tab_list as $item) { ?>
		<div class="tab<?php if ($item['selected'] === true) { echo " tab-selected";} ?>" onmouseover="TabOver(this);" onmouseout="TabOut(this);"><a href="<?php echo $item['url'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['name'] ?></a></div>
	<?php } ?>
<?php } ?>
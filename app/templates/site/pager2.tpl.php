<!-- Листинг -->
<?php if ($this->pages_number > 1) { ?>
<ul class="pages-list user-blog-view-pages clearfix">
	<li class="control">
		<?php if ($this->current_page_number > 0) { ?>
			<a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($this->current_page_number-1)):array($this->current_page_number-1)));?>" title="Предыдущая страница">« Назад</a>
		<? } else { ?>
			<span>« Назад</span> 
		<? } ?>
		<?php if ($this->current_page_number < $this->pages_number - 1) { ?>
			<a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($this->current_page_number+1)):array($this->current_page_number+1)));?>" title="Следующая страница">Вперед »</a>
		<? } else { ?>
			<span>Вперед »</span>
		<? } ?>	
	</li>
	<?php 
	$pager_begin = 7*intval(($this->current_page_number + 1)/7);	
	$pager_end = $pager_begin + 7;
	if($pager_begin) {
		$pager_begin--;	
		$pager_end++;
	}	
	if($pager_end > $this->pages_number) {
		$pager_end = $this->pages_number;
		$flag = 1;
	}	
	?>
	<?php for($i = $pager_begin ; $i < $pager_end; $i++){ ?>
		<?php if ($this->current_page_number == $i) { ?>
			<li><strong><?php echo ($i+1);?></strong></li>
		<?php } else { ?>
			<li><a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($i)):array($i)));?>"><?php echo ($i+1);?></a></li>
		<?php } ?>
	<?php } ?>	
	<?php if(!isset($flag)) { ?>
	<li>...</li>
	<?php if ($this->current_page_number == $this->pages_number) { ?>
		<li><strong><?=($this->pages_number);?></strong></li>
	<?php } else { ?>
		<li><a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($this->pages_number-1)):array($this->pages_number-1)));?>"><?php echo ($this->pages_number);?></a></li>
	<?php } ?>	
	<? } ?>
</ul>  
<? } ?>
<!--  
	<div class="listing_div_c">
		<div class="listing">
			<?php if ($this->pages_number > 1) { ?>
			<?php if ($this->current_page_number > 0) { ?>
										<a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($this->current_page_number-1)):array($this->current_page_number-1)));?>" title="Предыдущая страница">«</a>
									<?php } ?>
									<?php for($i = 0; $i < $this->pages_number; $i++){ ?>
										<?php if ($this->current_page_number == $i) { ?>
											<a class="active"><?php echo ($i+1);?></a>
										<?php } else { ?>
											<a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($i)):array($i)));?>"><?php echo ($i+1);?></a>
										<?php } ?>
									<?php } ?>
									<?php if ($this->current_page_number < $this->pages_number - 1) { ?>
										<a href="<?php echo $this->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array($this->current_page_number+1)):array($this->current_page_number+1)));?>" title="Следующая страница">»</a>
									<?php } ?>
			<?php } ?>
			</div>
		</div>	-->
<!-- /Листинг -->
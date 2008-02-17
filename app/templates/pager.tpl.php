<!-- Листинг -->
	<div class="listing_div_c">
		<div class="listing">
			<?php if ($this->pages_number > 1) { ?>
			<?php if ($this->current_page_number > 0) { ?>
										<a href="<?php echo $this->router->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge(array('pn'=>$i), $this->pager_params):array('pn'=>$this->current_page_number-1)));?>" title="Предыдущая страница">«</a>
									<?php } ?>
									<?php for($i = 0; $i < $this->pages_number; $i++){ ?>
										<?php if ($this->current_page_number == $i) { ?>
											<a class="active"><?php echo ($i+1);?></a>
										<?php } else { ?>
											<a href="<?php echo $this->router->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge(array('pn'=>$i), $this->pager_params):array('pn'=>$i)));?>"><?php echo ($i+1);?></a>
										<?php } ?>
									<?php } ?>
									<?php if ($this->current_page_number < $this->pages_number - 1) { ?>
										<a href="<?php echo $this->router->createUrl($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge(array('pn'=>$this->current_page_number+1), $this->pager_params):array('pn'=>$this->current_page_number+1)));?>" title="Следующая страница">»</a>
									<?php } ?>
			<?php } ?>
			</div>
		</div>
<!-- /Листинг -->
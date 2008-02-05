<!-- Листинг -->
	<div class="listing_div_c">
		<li class="listing">
			<?php if ($this->userData['pages_number'] > 1) { ?>
			<?php if ($this->userData['current_page_number'] > 0) { ?>
										<a href="<?php echo $this->router->createUrl($this->userData['current_controller'], $this->userData['current_action'], (is_array($this->userData['pager_params'])?array_merge(array('pn'=>$i), $this->userData['pager_params']):array('pn'=>$this->userData['current_page_number']-1)));?>" title="Предыдущая страница">«</a>
									<?php } ?>
									<?php for($i = 0; $i < $this->userData['pages_number']; $i++){ ?>
										<?php if ($this->userData['current_page_number'] == $i) { ?>
											<a class="active"><?php echo ($i+1);?></a>
										<?php } else { ?>
											<a href="<?php echo $this->router->createUrl($this->userData['current_controller'], $this->userData['current_action'], (is_array($this->userData['pager_params'])?array_merge(array('pn'=>$i), $this->userData['pager_params']):array('pn'=>$i)));?>"><?php echo ($i+1);?></a>
										<?php } ?>
									<?php } ?>
									<?php if ($this->userData['current_page_number'] < $this->userData['pages_number'] - 1) { ?>
										<a href="<?php echo $this->router->createUrl($this->userData['current_controller'], $this->userData['current_action'], (is_array($this->userData['pager_params'])?array_merge(array('pn'=>$this->userData['current_page_number']+1), $this->userData['pager_params']):array('pn'=>$i)));?>" title="Следующая страница">»</a>
									<?php } ?>
			<?php } ?>
			</li>
		</div>
<!-- /Листинг -->
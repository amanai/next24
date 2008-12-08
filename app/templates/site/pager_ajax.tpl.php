<!-- Листинг -->

	<div class="listing_div_c">
		<div class="listing">
			<?php if ($this->pages_number > 1) { ?>
			<?php if ($this->current_page_number > 0) { ?>
<?php
echo '
<a href="javascript: void(0);" 
onclick=\'ajax('.AjaxRequest::getJsonParam($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array("current_page"=>$this->current_page_number-1)):array("current_page"=>$this->current_page_number-1)), "POST").', true);\'  title="Предыдущая страница" >
«</a>';
?>
									<?php } ?>
									<?php for($i = 0; $i < $this->pages_number; $i++){ ?>
										<?php if ($this->current_page_number == $i) { ?>
											<a class="active"><?php echo ($i+1);?></a>
										<?php } else { ?>
<?php
echo '
<a href="javascript: void(0);" 
onclick=\'ajax('.AjaxRequest::getJsonParam($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array("current_page"=>$i)):array("current_page"=>$i)), "POST").', true);\' >
'.($i+1).'</a>';
?>
										<?php } ?>
									<?php } ?>
									<?php if ($this->current_page_number < $this->pages_number - 1) { ?>
<?php
echo '
<a href="javascript: void(0);" 
onclick=\'ajax('.AjaxRequest::getJsonParam($this->current_controller, $this->current_action, (is_array($this->pager_params)?array_merge($this->pager_params, array("current_page"=>$this->current_page_number+1)):array("current_page"=>$this->current_page_number+1)), "POST").', true);\'  title="Следующая страница" >
»</a>';
?>
									<?php } ?>
			<?php } ?>
			</div>
		</div>
<!-- /Листинг -->


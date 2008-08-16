<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">
			
			
			<table  width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- панель слева -->
							<?php include($this -> _include('catalog.tpl.php')); ?>
							<? if($this->competition_action == 0) include($this -> _include('control_panel.tpl.php')); ?>
							<!-- /панель слева -->
						</td>
						<td class="next24u_right">
						<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div style="margin: 0px -10px;">
												<? 
													if($this->competition_action == 0) {
														include($this -> _include('list_start_competition.tpl.php'));
													} else {
														include($this -> _include('list_rate_competition.tpl.php'));	
													}?>
}
}
											</div>
							<!-- листинг -->	
												
							<!-- /листинг -->
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			
			
			
		</div>
	</div>


<?php include($this -> _include('../footer.tpl.php')); ?>

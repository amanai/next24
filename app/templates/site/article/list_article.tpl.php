<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
		<?php $request = Project::getRequest(); ?>
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->tab_article_list?></a></div>
			<?php if($this->current_user && $this->current_user->id > 0) { ?>
				<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->tab_my_articles?></a></div> 
			<?php } ?>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->tab_last_list?></a></div>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#"><?=$this->tab_top_list?></a></div>
			
			<div class="tab-page tab-page-selected">
			
			
			<table  width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- панель слева -->
							<?php include($this -> _include('catalog.tpl.php')); ?>					
							<!-- /панель слева -->
						</td>
						<td class="next24u_right">
						<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div style="margin: 0px -10px;">
											
												<table class="questions" width="100%">
													<tr>
														<td><b>Название</b></td>
														<td><b>Кол-во коментариев</b></td>
														<td><b>Кол-во просмотров</b></td>
														<td><b>Победитель конкурса</b></td>
													</tr>
													<?foreach ($this->article_list as $key => $item):?>
														<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
															<td style="text-align: left; white-space: normal;">
																<?=$item['title']?>
															</td>
															<td><?=$item['comments']?></td>
															<td><?=$item['views']?></td>
															<td>&nbsp;</td>
													<?endforeach;?>
												</table>
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

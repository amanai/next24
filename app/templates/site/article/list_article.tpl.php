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
														<td><b>Кол-во<br /> коментариев</b></td>
														<td><b>Кол-во<br /> просмотров</b></td>
														<td><b>Статус</b></td>
														<?php if($this->admin_access) { ?><td><b>Действие</b></td><?php } ?>
													</tr>
													<?foreach ($this->article_list as $key => $item):?>
														<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
															<td style="text-align: left; white-space: normal;">
																<a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a>
															</td>
															<td><?=$item['comments']?></td>
															<td><?=$item['views']?></td>
															<td><?=$item['rate_status'] == ARTICLE_RATE_STATUS::WINNER ? "Winner" : ""?></td>
															<?php if($this->admin_access) { ?>
																<td>
																	<a href="<?=$this->createUrl('AdminArticle', 'DeleteArticle', array($item['id']))?>">[Удалить] </a>
																	<a href="#">[Редактировать] </a>
																	<a href="<?=$this->createUrl('AdminArticle', 'ResetRate', array($item['id']))?>">[Сброс рейтинга]</a>
																</td>
																
															<?php } ?>
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

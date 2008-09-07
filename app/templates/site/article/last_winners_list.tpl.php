<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">
			
			
			<table  width="100%" height="100%" cellpadding="0">
					<tr>
						<td>
						<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div style="margin: 0px -10px;">
											
												<table class="questions" width="100%">
													<tr>
														<td style="text-align: center;"><b>Дата публикации</b></td>
														<td style="text-align: center;"><b>Заголовок</b></td>
														<td style="text-align: center;"><b>Категория</b></td>
														<td style="text-align: center;"><b>Комментариев</b></td>
														<td style="text-align: center;"><b>Просмотров</b></td>
														<td style="text-align: center;"><b>Голосов за тему</b></td>
														<td style="text-align: center;"><b>Автор темы</b></td>
														<td style="text-align: center;"><b>Рейтинг</b></td>
														<td style="text-align: center;"><b>Статус</b></td>
													</tr>
													<?foreach ($this->article_list as $key => $item):?>
														<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
															<td style="text-align: center; white-space: normal;"><?=$item['creation_date']?></td>
															<td style="text-align: center;"><a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a></td>
															<td style="text-align: center;"><?=$item['full_path']?></td>
															<td style="text-align: center;"><?=$item['comments']?></td>
															<td style="text-align: center;"><?=$item['views']?></td>
															<td style="text-align: center;"><?=$item['votes']?></td>
															<td style="text-align: center;"><?=$item['login']?></td>
															<td style="text-align: center;"><?=$item['rate']?></td>
															<td style="text-align: center;">
																<? 	if($item['rate_status'] == ARTICLE_COMPETITION_STATUS::EDITED) echo "В редакции";
																	if($item['rate_status'] == ARTICLE_COMPETITION_STATUS::COMPLETE) echo "Готова";
																?>
															</td>
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

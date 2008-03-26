<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">
			
			
			<table  width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_right">
						<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div style="margin: 0px -10px;">
											
												<table class="questions" width="100%">
													<tr>
														<td><b>Название</b></td>
														<td><b>Категория</b></td>
														<td><b>Кол-во<br /> коментариев</b></td>
														<td><b>Кол-во<br /> просмотров</b></td>
														<td><b>Статус</b></td>
														<td><b>Действие</b></td>
													</tr>
													<?foreach ($this->article_list as $key => $item):?>
														<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
															<td style="text-align: left; white-space: normal;">
																<a href="<?=$this->createUrl('Article', 'ArticleView', array($item['id']))?>"><?=$item['title']?></a>
															</td>
															<td><a href="<?=$this->createUrl('Article', 'List', array($item['articles_tree_id']))?>"><?=$item['name']?></a></td>
															<td><?=$item['comments']?></td>
															<td><?=$item['views']?></td>
															<td><?=$item['status']?></td>
															<td><a href="<?=$this->createUrl('Article', 'EditArticle', array($item['id']))?>">[Редактировать]</a>&nbsp;<a href="#">[Удалить]</a></td>
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

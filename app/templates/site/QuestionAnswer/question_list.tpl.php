<?php include($this -> _include('../header.tpl.php')); ?>

<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#">Последние вопросы</a></div>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="#" title="Задать вопрос">Задать вопрос</a></div>
			<div class="tab-page tab-page-selected">
				<!-- Вопросы пользователей -->
				<table  width="100%" height="100%" cellpadding="0">
					<tr>
						<td class="next24u_left">
							<!-- панель слева -->
							<?php include($this -> _include('left_panel.tpl.php')); ?>					
							<!-- /панель слева -->
						</td>
						<td class="next24u_right">
							<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div style="margin: 0px -10px;">
												<table class="questions">
													<tr>
														<td style="width: 100%; text-align: left;"><img src="img/open.png" width="21" height="24" align="absmiddle" /> <a href="#"><b>Вопросы пользователей</b></a><b></td>
														<td><img src="img/open.png" width="21" height="24" align="absmiddle" /> <a href="#"><b>Автор</b></a></td>
														<td><img src="img/open.png" width="21" height="24" align="absmiddle" /> <a href="#"><b>Ответов</b></a></td>
														<td><img src="img/open.png" width="21" height="24" align="absmiddle" /> <a href="#"><b>Дата создания</b></a></td>
													</tr>
													<?php foreach($this->question_list as $key => $item) { ?>
													<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
														<td style="text-align: left; white-space: normal;">
															<img src="img/faq.png" width="14" height="14" id="ico2" />
															<a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array(id=>$item['id']))?>"><?=$item['q_text']?></a>
														</td>
														<td><a href="#"><?=$item['login']?></a></td><!-- TODO: User profile -->
														<td><?=$item['a_count']?></td>
														<td><?=date_format(new DateTime($item['creation_date']),'Y.m.d H:i:s')?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
							<!-- листинг -->						
								<?=$this->question_list_pager?>
							<!-- /листинг -->
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
						<!-- /Вопросы пользователей -->
			</div>
		</div>
		
<?php include($this -> _include('../footer.tpl.php')); ?>
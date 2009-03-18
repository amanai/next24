<?php include($this -> _include('../header.tpl.php')); ?>

				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="content-header">
							<h1>Задать вопрос<i class="icon ask-icon"></i></h1>
							<form action="#" method="post" class="ask-form">
								<table>
									<tr class="textarea-field">
										<td colspan="5"><textarea rows="5" cols="20">Введите тут свой вопрос</textarea></td>
									</tr>
									<tr>
										<td class="label-field">
											<label for="f1">Категория</label>
										</td>
										<td class="select-field">
											<select id="f1">
												<option>Авто</option>
												<option>2</option>
												<option>3</option>
											</select>
										</td>
										<td class="label-field">
											<label for="f2">Tэги</label>
										</td>
										<td class="input-field">
											<input id="f2" type="text" value="Авто, Гонки, Погонять" />
										</td>
										<td class="button-field"><input type="submit" value="Спросить" /></td>
									</tr>
								</table>
							</form>
						</div>
						<!-- /content-header -->
						<ul class="view-filter clearfix">
							<li><a href="#">Вопросы</a></li>
							<li><a href="#">Популярные вопросы</a></li>
							<li><strong>Подробная статистика<span></span></strong></li>
						</ul>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="number-filter">
								показывать по: <strong>10</strong> | <a href="#">20</a> | <a href="#">30</a> ответов
							</div>
						</div>
						<!-- /display-filter -->
						<table class="stat-table">
							<thead>
								<tr>
									<th class="main-row">Вопросы</th>
									<th><a class="script-link" href="#"><span class="t">Кто спрашивает</span></a></th>
									<th><span class="sort-by-this"><a class="script-link" href="#"><span class="t">Ответы</span><i class="arrow-icon"></i></a></span></th>
									<th><a class="script-link" href="#"><span class="t">Дата создания</span></a></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($this->question_list as $key => $item) { ?>
								<tr>
									<td class="qv">
										<a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>"><?=$item['q_text']?></a>
									</td>
									<td class="av"><a href="#" class="avatar-link"><img src="assets/i/temp/avatar.s.jpg" alt="" class="avatar" /><span class="t"><?=$item['login']?></span></a></td>
									<td class="an"><?=$item['a_count']?></td>
									<td class="date"><?=date_format(new DateTime($item['creation_date']),'Y.m.d H:i:s')?></td>
								</tr>
							<?php } ?>							
							</tbody>
						</table>
				<!-- 	<ul class="pages-list clearfix">
							<li class="control"><a href="#">« Назад</a> <a href="#">Вперед »</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><strong>3</strong></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li>...</li>
							<li><a href="#">34</a></li>
						</ul> 	-->
						<?=$this->question_list_pager?>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->


<script language="JavaScript" type="text/javascript" src="<?php echo $this -> js_url;?>tab.js"></script>

		<div id="tabs">
		<?php $request = Project::getRequest(); ?>
			<div class="tab tab-selected" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$request->createUrl('QuestionAnswer','List')?>"><?=$this->tab_list_name?></a></div>
			<?php if($this->current_user && $this->current_user->id > 0) { ?>
				<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$request->createUrl('QuestionAnswer','UserQuestions')?>" title="Мои вопросы"><?=$this->tab_my_list_name?></a></div> 
			<?php } ?>
			<div class="tab" onMouseOver="TabOver(this);" onMouseOut="TabOut(this);"><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion')?>" title="Задать вопрос"><?=$this->tab_manage_question_name?></a></div>
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
						<?php include($this -> _include('tag_list.tpl.php')); ?>
							<div class="block_ee1">
								<div class="block_ee2">
									<div class="block_ee3">
										<div class="block_ee4">
											<div style="margin: 0px -10px;">
												<table class="questions">
													<tr>
														<td style="width: 100%; text-align: left;"><b>Вопросы пользователей</b></td>
														<td><b>Автор</b></td>
														<td><b>Ответов</b></td>
														<td><b>Дата создания</b></td>
													</tr>
													<?php foreach($this->question_list as $key => $item) { ?>
													<tr id=<?php if($key%2==0) { ?>"cmod_tab2"<?php } else { ?>"cmod_tab1"<?php } ?>>
														<td style="text-align: left; white-space: normal;">
															<img src="<?=$this -> image_url; ?>faq.png" width="14" height="14" id="ico2" />
															<a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>"><?=$item['q_text']?></a>
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
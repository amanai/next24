<?php include($this -> _include('../header.tpl.php')); ?>

				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<?php if($this->current_user && $this->current_user->id > 0) { ?>
						<div class="content-header">
							<h1>Задать вопрос<i class="icon ask-icon"></i></h1>
							<form action="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', array($this->question['id']))?>" method="post" class="ask-form">
								<table>
									<tr class="textarea-field">
										<td colspan="5"><textarea name="question_text" rows="5" cols="20"><?=$this->question['q_text']?></textarea></td>
									</tr>
									<tr>
										<td class="label-field">
											<label for="f1">Категория</label>
										</td>
										<td class="select-field">
											<select id="f1" name="cat_id">
								        	<?foreach ($this->question_cat as $cat):?>
								        		<option value="<?=$cat['id']?>" <?if($cat['id']==$this->question['questions_cat_id']) { ?> selected <? } ?>><?=$cat['name']?></option>
								        	<?endforeach;?>
											</select>
										</td>
										<td class="label-field">
											<label for="f2">Tэги</label>
										</td>
										<td class="input-field">
											<input id="f2" type="text" value="<?=$this->question_tag_list?>" name="tags" />
										</td>
										<td class="button-field"><input type="submit" value="Спросить" /></td>
									</tr>
								</table>
							</form>
						</div>
						<? }?>
						<!-- /content-header -->
						<ul class="view-filter clearfix">
							<?php include($this -> _include('../tab_panel.tpl.php')); ?>
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
<?php include($this -> _include('../footer.tpl.php')); ?>
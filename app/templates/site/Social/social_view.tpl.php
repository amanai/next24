<!-- TEMPLATE: Форма просмотра Соц.позиций, добавления комментариев, оценки -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="view-filter clearfix">
							<form class="search-filter" action="#" method="get">
								<fieldset>
									<label for="sf1">Поиск по имени:</label>
									<input type="text" id="sf1" value="Введиите имя" size="45" />
									<input type="submit" value="Ok" />
								</fieldset>
							</form>
							<ul class="clearfix">
								<li><strong>Каталог позиций<span></span></strong></li>
								<li><a href="#">Популярные</a></li>
							</ul>
						</div>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="breadcrumbs">
							<? if (count($this->social_row > 0)) { ?>
								<?=$this->social_row[0]['social_category']; ?>
							<? } ?>			
								▪ <a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » С рождеством!
							</div>
						</div>
						<!-- /display-filter -->
						<div class="blog-post">
						<? if (count($this->social_row > 0)) { ?>
							<h2><?=$this->social_row[0]['name'];?></h2>
						<? } ?>	
							<div class="object-rating">
							<? if (count($this->social_row > 0)) { ?>
								<table class="view-rating">
									<tbody>	
									<?php $cnt=1; ?>
									<? foreach($this->social_row as $key => $value)  {?>
										<tr class="type-<?=$cnt?>">
											<th><?=$value['criteria_name'];?></th>
											<td class="view">
												<div class="container"><div class="c-wrp"><div class="c-wrp">
													<div class="percentage" style="width:<?=number_format($value['votes_avg'], 2, '.',' ')*10;?>%" ><div class="p-wrp"><div class="p-wrp"></div></div></div>
												</div></div></div>
											</td>
											<td class="summ"><?=number_format($value['votes_avg'], 2, '.',' ');?></td>
										</tr>	
										<? $cnt++;?>								
									<? } ?>
									</tbody>
								</table>
							<? } ?>	
								<!-- /view-rating -->
								<div class="do-rating clearfix">
								<? if (count($this->social_row > 0)) { ?>
									<div class="overall-rating">Общий рейтинг <strong><?=number_format($this->social_row[0]['avg_rating'], 3, '.',' ');?></strong></div>
								<? } ?>	
								<? $a=1; ?>
								<?php $v_form_action = $this->createUrl('Social', 'SocialVoteAdd', array($this->social_row[0]['id'])); ?>
								<? if ($this->count_comment == 0) { ?>
									Для того, чтобы иметь возможность оценить позицию вам необходимо оставить хотя бы один комментарий к ней.
								<? } else { ?>
									<? $v_i = 1; ?>
									<? if ($this->count_votes < 1) { ?>	
								<form action="<?=$v_form_action;?>" method="post">
           <? foreach($this->social_row as $key => $value) {?>
             <td style="text-align: left; width: 200px;">
               <?=$value['criteria_name'].' : ';?>
               <select name="inp_select_<?=$v_i;?>" style="width: 40px;" id="vote<?=$v_i;?>">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5" selected="">5</option>
                 <option value="6">6</option>
                 <option value="7">7</option>
                 <option value="8">8</option>
                 <option value="9">9</option>
                 <option value="10">10</option>
               </select>
               <input type="hidden" name="inp_criteria_id_<?=$v_i;?>" value="<?=$value['criteria_id'];?>">
             </td>
             <? $v_i++; ?>
           <? } ?>
									<table>
										<tbody>
											<tr>
												<th><label for="r1">Обслуживание</label></th>
												<td><select id="r1"><option>1</option><option>2</option><option>3</option></select></td>
												<th><label for="r2">Цена</label></th>
												<td><select id="r2"><option>1</option><option>2</option><option>3</option></select></td>
												<th><label for="r3">Качество</label></th>
												<td><select id="r3"><option>1</option><option>2</option><option>3</option></select></td>
											</tr>
											<tr>
												<th><label for="r4">Комфорт</label></th>
												<td><select id="r4"><option>1</option><option>2</option><option>3</option></select></td>
												<th><label for="r5">Новации</label></th>
												<td><select id="r5"><option>1</option><option>2</option><option>3</option></select></td>
												<td class="button" colspan="2"><input type="submit" value="Оценить" /></td>
											</tr>
										</tbody>
									</table>
								</form>	
								<? } else { ?>
									Вы уже проголосовали.
           						<? } ?>
         					<? } ?>													
								</div>
							</div>
							<!-- /object-rating -->
							<div class="post-content">
								<p>Если зайти сейчас на главный сайт компании — можно посмотреть веселый мультик на знакомую тему, так сказать, «пародию на 
								пародию», поздравляющий нас с Рождеством. <a href="#">Mac или PC, господа</a>? :)</p>
								<p>АПД: Видеоверсия для тех, у кого не пашет флэшевая, спасибо meako.</p>
								<p>«Совершенный Ajax» — новый подход к построению web-приложений, при котором web-сервер не генерирует ни строчки HTML-кода 
								и взаимодействует с внешним миром только посредством web-служб; а клиентский интерфейс реализуется только на основе 
								клиентских HTML, CSS, JavaScript.</p>
								<p>Статья состоит из двух частей. В первой части — более живой и провокационной я постараюсь заинтересовать проблемой, 
								рассказать о технологии «Совершенный Ajax» и показать ее применение на примере нашего проекта «Система Интерактивного 
								Тестирования Знаний “Синтез”» (который имеет ряд интересных особенностей, таких, как использование серверного JavaScript на 
								платформе Mozilla Rhino, прототипно-ориентированная ORM и поддержка SPARQL — языка запросов к Semantic Web).</p>
								<p>Вторая часть – более занудная будет содержать много технических деталей и выйдет в следующий раз.</p>
								<p>По доброй традиции, награждаю плюсиками всех участников дискуссии, в том числе и конструктивных критиков, с чьим мнением я 
								не согласен.</p>
							</div>
							<!-- /post-content -->
							<div class="tag-list">
								<i class="icon tags-list-icon"></i>
								<ul>
									<li><a href="#" rel="tag">apple</a>,</li>
									<li><a href="#" rel="tag">mac</a>,</li>
									<li><a href="#" rel="tag">pc</a></li>
								</ul>
							</div>
							<!-- /tag-list -->
							<div class="post-meta"><div class="bg"><div class="bg clearfix">
								<ul>
									<li class="it ath">
										<div class="dropdown">
											<div class="d-head">
												<a href="<?=$request->createUrl('Index','Index', null, $this->social_row[0]['login']); ;?>" class="with-icon-s"><i class="icon-s user-icon"></i><?=$this->social_row[0]['login']; ?></a><i class="arrow-icon vcard-icon"></i>
											</div>
											<div class="d-body">
												<ul>
													<li><a href="#">Профиль пользователя</a></li>
													<li><a href="#">Добавить в друзья</a></li>
													<li><a href="#">Написать сообщение</a></li>
													<li><a href="#">Послать подарок</a></li>
												</ul>
											</div>
										</div>
										<span class="user-status"><span class="online">online</span><span class="nr">245 nr</span></span>
									</li>
									<li class="it date"><?=date_format(new DateTime($this->social_row[0]['creation_date']),'d.m.y H:i'); ?></li>
									<li class="it com">
										<a href="#" class="with-icon-s"><i class="icon-s commets-icon"></i>23</a>
									</li>
								</ul>
							</div></div></div>
							<!-- /post-meta -->
						</div>
						<!-- /blog-post -->
						<?=$this->comment_list?>
						<div class="comments">
							<h2><i class="icon-s comment-m-icon"></i>Комментарии <em>(2)</em></h2>
							<ul class="comment-entry">
								<li class="c-holder">
									<div class="c-meta clearfix">
										<ul class="controll">
											<li><a href="#">цитировать</a> |</li>
											<li><a href="#">редактировать</a> |</li>
											<li><a href="#">удалить</a></li>
										</ul>
										<ul class="info">
											<li><img class="avatar" src="assets/i/temp/avatar.ss.jpg" alt="" /><a href="#">mixalich</a><i class="arrow-icon vcard-icon"></i></li>
											<li class="date">17 декабря 2008, 15:39</li>
										</ul>
									</div>
									<div class="c-content">
										<p>Да уж хорошо что все так удачно закончилось. Рад за пассажиров, хотя стресс полюбому был сильный. </p>
									</div>
								</li>
								<li class="c-holder">
									<div class="c-meta clearfix">
										<ul class="controll">
											<li><a href="#">цитировать</a></li>
										</ul>
										<ul class="info">
											<li><img class="avatar" src="assets/i/temp/avatar.ss.jpg" alt="" /><a href="#">SuperUserovich</a><i class="arrow-icon vcard-icon"></i></li>
											<li class="date">17 декабря 2008, 15:39</li>
										</ul>
									</div>
									<div class="c-content">
										<blockquote>
											<div class="cite">цитата <span>SuperUserovich</span></div>
											<div class="quote">
												<p>Да уж хорошо что все так удачно закончилось. Рад за пассажиров, хотя стресс полюбому был сильный. </p>
											</div>
										</blockquote>
										<p>В принципе, подобные идеи (о полном отказе от генерации HTML-кода на сервере) в неявном виде витали в воздухе уже давно. См. например статью «Ajax-машина».</p>
										<p class="alert">Отредактировано администратором. Предупреждение: q4</p>
									</div>
								</li>
								<li class="c-holder">
									<div class="c-meta clearfix">
										<ul class="controll">
											<li><a href="#">цитировать</a></li>
										</ul>
										<ul class="info">
											<li><img class="avatar" src="assets/i/temp/avatar.ss.jpg" alt="" /><a href="#">SuperUserovich</a><i class="arrow-icon vcard-icon"></i></li>
											<li class="date">17 декабря 2008, 15:39</li>
										</ul>
									</div>
									<div class="c-content">
										<blockquote>
											<div class="cite">цитата <span>SuperUserovich</span></div>
											<div class="quote">
												<blockquote>
													<div class="cite">цитата <span>SuperUserovich</span></div>
													<div class="quote">
														<p>Да уж хорошо что все так удачно закончилось. Рад за пассажиров, хотя стресс полюбому был сильный. </p>
													</div>
												</blockquote>
												<p>Да уж хорошо что все так удачно закончилось. Рад за пассажиров, хотя стресс полюбому был сильный. </p>
											</div>
										</blockquote>
										<p>В принципе, подобные идеи (о полном отказе от генерации HTML-кода на сервере) в неявном виде витали в воздухе уже давно. См. например статью «Ajax-машина».</p>
										<p class="signature">Моя подпись</p>
									</div>
								</li>
							</ul>
							<!-- /comment-entry -->
							<div class="leave-comment">
								<h2>Задать вопрос</h2>
								<div class="rules"><a href="#">правила</a></div>
								<form action="#" method="post" class="comment-form">
									<table>
										<tr class="textarea-field">
											<td colspan="4"><textarea rows="5" cols="20">[quote name="ipartemk"]сколько выпил?[/quote]</textarea></td>
										</tr>
										<tr>
											<td class="select-field">
												<select>
													<option>Моя яя</option>
													<option>2</option>
													<option>3</option>
												</select>
											</td>
											<td class="select-field big-select-field">
												<select>
													<option>Введите ваш текст настроения</option>
													<option>2</option>
													<option>3</option>
												</select>
											</td>
											<td class="input-field">
												<input type="text" value="Авто, Гонки, Погонять" />
											</td>
											<td class="button-field"><input type="submit" value="Комментировать" /></td>
										</tr>
									</table>
								</form>
							</div>
							<!-- /leave-comment -->
						</div>
						<!-- /comments -->
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<div class="navigation">
							<div class="title">
								<h2>Блоги</h2>
								<i title="Показать фильтр" class="filter-link icon hide-filter-icon"></i>
							</div>
							<form class="filter" action="#" method="get">
								<ul>
									<li><select><option>Авто</option></select></li>
									<li><select><option>AUDI</option></select></li>
									<li><select><option>Выберете раздел</option></select></li>
									<li><select disabled="disabled"><option>Выберете раздел выше</option></select></li>
								</ul>
							</form>
							<ul class="nav-list">
								<li><a href="#">Авио</a></li>
								<li><a href="#">Internet</a></li>
								<li><a href="#">Linux для всех</a></li>
								<li><a href="#">Стартапы</a></li>
								<li><a href="#">Типографика</a></li>
								<li><a href="#">Apple</a></li>
								<li><a href="#">Дизайн</a></li>
								<li><a href="#">Программирование</a></li>
								<li><a href="#">Юмор</a></li>
								<li><a href="#">Internet</a></li>
								<li><a href="#">Linux для всех</a></li>
								<li><a href="#">Стартапы</a></li>
								<li><a href="#">Типографика</a></li>
							</ul>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../tab_panel.tpl.php')); ?>

<?php include($this -> _include('../footer.tpl.php')); ?>
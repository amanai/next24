<?php include($this -> _include('../header.tpl.php')); ?>
				<ul class="view-filter clearfix">
					<li><strong>Шпаков Виктор<span></span></strong></li>
					<li><a href="#">Настройки профиля</a></li>
				</ul>
				<!-- /view-filter -->

				<div class="user-profile">
					<div class="clearfix">
						<dl class="main-info">
							<dt><span class="user-status"><span class="online">online</span></span> <strong>Викторчик</strong>  / <span class="nick">madvic</span> /</dt>
							<dd class="av"><img src="assets/i/temp/avatar.bbb.jpg" alt="" /></dd>
							<dd>Украина, Киев</dd>
							<dd>На сайте: <span class="date">12 дней</span></dd>
							<dd>Настроение: <em>супер!</em> <a href="#" class="script-link"><span class="t">изменить</span></a></dd>
							<dd>Статус: <em>хочу есть и пить</em> <a href="#" class="script-link"><span class="t">изменить</span></a></dd>
						</dl>
						<div class="about-info">
							<div class="ttl"><strong>О себе</strong> <a href="#" class="script-link"><span class="t">изменить</span></a></div>
							<div class="cnt">Художественное опосредование, как бы это ни казалось парадоксальным, трансформирует реконструктивный подход, подобный исследовательский подход к проблемам художественной типологии можно обнаружить у К.Фосслера.</div>
						</div>
						<div class="rating-info">
							<div class="ttl"><strong>Рейтинг: <span class="nr">420 NR</span></strong></div>
							<div class="cnt">
								Профиль заполнен на:
								<div class="rating-view">
									<strong>48%</strong>
									<div style="width:48%;"></div>
								</div>
								<a href="#" class="script-link"><span class="t">подробнее о рейтинге</span></a>
							</div>
						</div>
					</div>
					<ul class="user-tabs clearfix">
						<?php include($this -> _include('../tab_panel_profile.tpl.php')); ?>
					</ul>
					<!-- /user-tabs -->
				</div>
				<!-- /user-profile -->

				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<h2 class="page-ttl">Мои вопросы</h2>
						<ul class="question-preview-list question-abridged-preview-view question-user-list">
						<?php foreach($this->question_list as $key => $item) { ?>
							<li class="clearfix">
								<dl>
									<dt><a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>"><?=$item['q_text']?></a>(<?=$item['login']?>)</dt>
									<dd class="reply"><a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>" class="with-icon-s"><i class="icon-s reply-icon"></i><?=$item['a_count']?> ответов</a></dd>
									<dd class="date"><?=date_format(new DateTime($item['creation_date']),'Y.m.d H:i:s')?></dd>
									<?php if($item['user_id'] == Project::getUser()->getDbUser()->id) { ?>
										<dd class="action">
											<a href="<?=$this->createUrl('QuestionAnswer','ManagedQuestion',array($item['id']))?>" title="Редактировать" class="func"><i class="icon edit-icon"></i></a>
											<a href="<?=$this->createUrl('QuestionAnswer','Delete',array($item['id']))?>" title="Удалить" class="func"><i class="icon delete-icon"></i></a>
											<!-- <?=$this->question['user_id']?> -->
										</dd>															
									<?php } ?>									
								</dl>
							</li>						
						<?php } ?>
						</ul>
					</div></div>
					<?php include($this -> _include('tag_list.tpl.php')); ?>
					<?=$this->question_list_pager?>
					<!-- /main -->
					<div class="sidebar">
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion')?>"><i class="icon macomm-icon"></i> Задать вопрос</a></li>
								<li><a href="<?php echo $this->createUrl('QuestionAnswer', 'UserQuestions', null, false); ?>"><i class="icon faq-icon"></i>Мои вопросы</a></li>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion')?>"><i class="icon mcomm-icon"></i>Мои ответы</a></li>
							</ul>
						</div>
						<?php $par['u_id']= $this->current_user->id ?>
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
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
					<?php include($this -> _include('tag_list.tpl.php')); ?>
					<?=$this->question_list_pager?>						
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', null, $this->current_user->login)?>"><i class="icon macomm-icon"></i> Задать вопрос</a></li>
								<li><a href="<?php echo $this->createUrl('QuestionAnswer', 'UserQuestions', null, $this->current_user->login); ?>"><i class="icon faq-icon"></i>Мои вопросы</a></li>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'UserQuestionsAnswers',null, $this->current_user->login)?>"><i class="icon mcomm-icon"></i>Мои ответы</a></li>
							</ul>
						</div>
						<?php $par['u_id']= $this->current_user->id ?>
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<?php include($this -> _include('../footer.tpl.php')); ?>
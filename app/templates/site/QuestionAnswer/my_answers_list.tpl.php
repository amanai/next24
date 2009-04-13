<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<h2 class="page-ttl">Мои ответы</h2> 
						<ul class="question-preview-list question-abridged-preview-view"> 
						<?php foreach($this->question_list as $key => $item) { ?>
							<?php 
								$user = Project::getUser()->getDbUser()->getUserByLogin($item['login']);
								$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
								$avPath = $avatar['path'];
								if(!$avPath || $avPath == 'no.png') $avPath = 'no50.jpg';
								if($user['gender']) {
									$class = 'user-icon';	
								}
								else {
									$class = 'wuser-icon';
								} 								
							?>
							<li class="it clearfix"> 
								<dl> 
									<dt><a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>"><?=$item['q_text']?></a></dt> 
									<dd class="auth"> 
										<span class="as">спросил:</span> <img class="avatar" src="<?=$this->image_url.'avatar/'.$avPath;?>" style="width:50px;height:50px;" alt="" /> 
										<div class="dropdown"> 
											<div class="d-head"> 
												<a href="<?php echo $this->createUrl('User', 'Profile', null, $item['login'])?>" class="with-icon-s"><i class="icon-s <?=$class; ?>"></i><?=$item['login'];?></a><i class="arrow-icon bid-arrow-icon"></i> 
											</div> 
											<div class="d-body"> 
												<ul> 
													<li><a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>">Профиль пользователя</a></li> 
													<li><a href="<?php echo $this->createUrl('Messages', 'Friend',null,$this->current_user->login); ?>">Добавить в друзья</a></li> 
													<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage',null,$this->current_user->login);?>">Написать сообщение</a></li> 
													<li><a href="<?php echo $this -> createUrl('Messages', 'SendMessage',null,$this->current_user->login);?>">Послать подарок</a></li> 
												</ul> 
											</div> 
										</div> 
									</dd> 
									<dd class="reply"><a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>" class="with-icon-s"><i class="icon-s reply-icon"></i><?=$item['a_count']?>  ответов</a> <a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']))?>" class="my">Мой ответ</a></dd> 
									<dd class="date"><?=date_format(new DateTime($item['creation_date']),'Y.m.d H:i:s')?></dd> 
								</dl> 
							</li> 																		
							<?php } ?>														
						</ul>
						<?php include($this -> _include('tag_list.tpl.php')); ?>
						<ul class="pages-list clearfix"> 
							<?=$this->question_list_pager;?>
						</ul> 						 
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<div class="user-action">
							<ul>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion', null, $this->current_user->login)?>"><i class="icon macomm-icon"></i> Задать вопрос</a></li>
								<li><a href="<?php echo $this->createUrl('QuestionAnswer', 'UserQuestions', null, $this->current_user->login); ?>"><i class="icon faq-icon"></i>Мои вопросы</a></li>
								<li><a href="<?=$this->createUrl('QuestionAnswer', 'ManagedQuestion',null, $this->current_user->login)?>"><i class="icon mcomm-icon"></i>Мои ответы</a></li>
							</ul>
						</div>
						<?php $par['u_id']= $this->current_user->id ?>
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<?php include($this -> _include('../footer.tpl.php')); ?>
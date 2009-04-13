<?php include($this -> _include('../header.tpl.php')); ?>
<?php 
	$v_session = Project::getSession(); 
	$qpp = $v_session->getKey('qpp');
?>	
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
										<?php $i = 0;
											foreach ($this->question_tag_list as $v) {
												if($i) {
													$q_list .= ', '.$v['name'];
												}
												else {
													$q_list .= $v['name'];
												}	
												$i++;
											}
										?>	
										<td class="input-field">
											<input id="f2" type="text" value="<?=$q_list; ?>" name="tags" />										
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
								показывать по: 
							<?php if(!$qpp || $qpp == 10){ ?>
									<strong>10</strong> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>/qpp:20">20</a> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>/qpp:30">30</a> ответов
							<?php }elseif($qpp == 20) { ?>
									<a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>/qpp:10">10</a> | <strong>20</strong> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>/qpp:30">30</a> ответов
							<?php } elseif($qpp == 30) { ?>	
									<a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>/qpp:10">10</a> | <a href="<?php echo $this->createUrl('QuestionAnswer', 'List', null, false); ?>/qpp:20">20</a> | <strong>30</strong> ответов
							<? } ?>	
							</div> 
						</div> 
						<!-- /display-filter --> 
						<ul class="question-preview-list question-abridged-preview-view"> 
							<?php foreach($this->question_list as $key => $item) { ?>
							<?php 
								$user = Project::getUser()->getDbUser()->getUserByLogin($item['login']);
								$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
								$avPath = $avatar['path'];
								if(!$avPath || $avPath == 'no.png') $avPath = 'no25.jpg';
								if($user['gender']) {
									$class = 'user-icon';	
								}
								else {
									$class = 'wuser-icon';
								} 								
							?>
							<li class="it clearfix"> 
								<dl> 
									<dt><a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']),$this->current_user->login)?>"><?=$item['q_text']?></a></dt> 
									<dd class="auth"> 
										<span class="as">спросил:</span> <img class="avatar" src="<?=$this->image_url.'avatar/'.$avPath;?>" style="width:50px;height:50px;" alt="" /> 
										<div class="dropdown"> 
											<div class="d-head"> 
												<a href="<?=$request->createUrl('Index','Index', null, $item['login']);?>" class="with-icon-s"><i class="icon-s <?=$class; ?>"></i><?=$item['login'];?></a><i class="arrow-icon bid-arrow-icon"></i> 
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
									<dd class="reply">
										<?php if($item['a_count']) { ?>
											<a href="<?=$this->createUrl('QuestionAnswer', 'ViewQuestion', array($item['id']),$this->current_user->login)?>" class="with-icon-s"><i class="icon-s reply-icon"></i><?=$item['a_count']; ?> ответов</a>
										<? } else { ?>
											<span class="with-icon-s">
												<i class="icon-s reply-icon"></i>
												нет ответов
											</span>									
										<? } ?>									
									</dd> 
									<dd class="date"><?=date_format(new DateTime($item['creation_date']),'Y.m.d H:i:s')?></dd> 
								</dl> 
							</li> 								
							<?php } ?>															
						</ul>
						<ul class="pages-list clearfix"> 
							<?=$this->question_list_pager?>
						</ul> 						 
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<?php include($this -> _include('left_panel.tpl.php')); ?>
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<?php include($this -> _include('../footer.tpl.php')); ?>
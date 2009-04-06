<?php include($this -> _include('../header.tpl.php')); ?>
<?php include($this -> _include('../profile_line.tpl.php')); ?>
<?php 
	$user = Project::getUser()->getDbUser()->getUserById($this->post_user_id);
	$avatar = Project::getUser()->getDbUser()->getUserAvatar($this->post_user_id);
	$is_online = Project::getUser()->getDbUser()->isUserOnline($this->post_user_id);
	$nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->post_user_id);
	$avPath = $avatar['path'];
	if(!$avPath || $avPath == 'no.png') $avPath = 'no50.jpg';
	if($user['gender']) {
		$class = 'user-icon';	
	}
	else {
		$class = 'wuser-icon';
	} 
//$this->post_user_id;
?>	
<!-- Главный блок, с вкладками (Контент) -->
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<ul class="view-filter clearfix"> 
							<li><strong><? echo $this->blog_info['title'];  ?><span></span></strong></li> 
			<!-- 				<li><a href="#">Популярные посты</a></li> 
							<li><a href="#">TOP 100 за неделю</a></li> 
							<li class="view-tag"><a href="#"><i class="icon tags-icon"></i>Тэги</a></li> 	-->
						</ul> 
						<!-- /view-filter --> 
						<div class="display-filter clearfix"> 
							<div class="breadcrumbs"> 
								▪ <a href="#">Последние посты</a> » <a href="#">Праздники</a> » <a href="#">РождествоM</a> » С рождеством!
							</div> 
						</div> 
						<!-- /display-filter --> 
						<div class="blog-post"> 
							<h2><?php echo $this->post_title; ?></h2> 
							<div class="post-content"> 
            					<?php 
            					if ($this->user_avatar){
            					   $user_avatar = $this->user_avatar;
            					   $avatar_path = ($user_avatar['sys_av_id'])?$user_avatar['sys_av_path']:$user_avatar['path']; 
            					?>
            					   <div class="av_preview av_gallery right5">
            					   <img style="margin: 5px;" alt="<?php echo $user_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avatar_path; ?>"/>
            					   </div>
            					<?php } ?>  							
								<?php echo $this->full_text; ?>
							</div> 
							<!-- /post-content --> 
							<div class="tag-list"> 
								<?php echo $this->post_tag; ?>
								<i class="icon tags-list-icon"></i> 
								<ul> 
									<li><a href="#" rel="tag">apple</a>,</li> 
									<li><a href="#" rel="tag">mac</a>,</li> 
									<li><a href="#" rel="tag">pc</a></li> 
								</ul> 
							</div> 
							<!-- /tag-list --> 
							<div class="post-meta"><div class="bg"><div class="bg clearfix"> 
								<div class="voting vote-positive"> 
									99
									<a href="#" class="vote_plus" title="нравится">+<span></span></a> 
									<a href="#" class="vote_minus" title="не нравится">-<span></span></a> 
								</div> 
								<ul> 
									<li class="it ath"> 
										<div class="dropdown"> 
											<div class="d-head"> 
												<a href="#" class="with-icon-s"><i class="icon-s <?=$class; ?>"></i><?=$user['login']; ?></a><i class="arrow-icon bid-arrow-icon"></i> 
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
										<span class="user-status"><span class="online"><?=($is_online)?'online':'offline'; ?></span><span class="nr"><?=$nr['rate'];?> nr</span></span> 
									</li> 
									<li class="it date"><?php echo date("j F Y", strtotime($this->post_creation_date));?></li> 
									<li class="it com"> 
										<a href="#"  class="with-icon-s"><i class="icon-s commets-icon"></i>8 ответов</a> 
									</li> 
								</ul> 
							</div></div></div> 
							<!-- /post-meta --> 
						</div> 
						<!-- /blog-post --> 
						<?php if($this->post_mood) echo '<hr align="left" class="hr_comment"/><div class="micro3">'.$this->post_mood.'</div>'; ?>
						<? if ($this -> blog_banner_code) { ?>
						<div style="clear: both;">
							<?php echo $this->blog_banner_code; ?><hr/>
						</div>
						<? } ?>
						<? if (!empty($this -> comment_list)) { ?>
							<?php echo $this -> comment_list; ?>
						<? } ?>
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<?php echo $this -> control_panel; ?>
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
								<li><i class="arrow-icon"></i><a href="#">Авио</a></li> 
								<li class="active"><i class="arrow-icon"></i><a href="#">Internet</a> 
									<ul> 
										<?php require('blog_left_tree.tpl.php'); ?>
										<li class="active"><a href="#">AUDI</a> (8)</li> 
										<li><a href="#">Acura</a> (3)</li> 
										<li><a href="#">BMW</a> (25)</li> 
										<li><a href="#">Chrysler</a> (14)</li> 
										<li><a href="#">Citroe Acura n Юмор Chrysler BMW</a> (28)</li> 
										<li><a href="#">Acura</a> (3)</li> 
										<li><a href="#">BMW</a> (25)</li> 
										<li><a href="#">Chrysler</a> (14)</li> 
										<li><a href="#">Citroen</a> (28)</li> 
										<li><a href="#">Acura</a> (3)</li> 
										<li><a href="#">BMW</a> (25)</li> 
										<li><a href="#">Chrysler</a> (14)</li> 
										<li><a href="#">Citroen</a> (28)</li> 
										<li><a href="#" class="all-sections script-link"><span class="t">Все разделы</span></a> (57)</li> 
									</ul> 
								</li> 
							</ul> 
						</div> 
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
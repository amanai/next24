<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->

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
					<div class="main"><div class="wrap" id="user_profile_js">
						<h2 class="page-ttl">Личная почта</h2>
						<ul class="user-blog-view message-blog-view" id="cmod_messages">
        					<?php
        $i = 1;
		foreach ($this->aMessages as $userMessage){
		    if ($i/2 == 1){$i = 1;} else {$i++;}
		    if ($userMessage['avatars_id']){
		        if ($userMessage['sys_av_id']){
		            $avPath = $userMessage['sys_av_path'];
		        }else{
		            $avPath = $userMessage['avatars_path'];
		        }
		        $avName = $userMessage['avatars_av_name'];
		    }else {
		        $avPath = 'no.png';
		        $avName = 'no image';
		    }
		    if (!$userMessage['is_read']) $sIsRead = '<dd class="message-status unread-message-status"><div class="status-wrp"><span class="with-icon-s"><i class="icon-s mess-unread-icon"></i>Ваше последнее отправленное сообщение не прочтено</span></div></dd>';
		    else $sIsRead = '';
		    echo '<li class="it clearfix">
					<dl>
						<dt><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'" class="with-icon-s"><i class="icon-s online-icon"></i>'.$userMessage['author_login'].'</a> [ <a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'">'.$userMessage['author_login'].'</a> ]</dt>
						<dd class="av"><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'"><img class="avatar" src="'.$this->image_url.'avatar/'.$avPath.'" alt="'.$avName.'" /></a></dd>
						<dd class="date">'.$userMessage['send_date'].'</dd>
						<dd class="theme">'.$userMessage['header'].'</dd>
						<dd class="message srv-msg">'.nl2br($userMessage['m_text']).'</dd>
						'.$sIsRead.'
					</dl>
					<ul class="links">
						<li><a href="'.Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$userMessage['author_id'].'" class="new-link">Переписка</a>  ( <span class="of-all-count">1</span> / 12)</li>
						<li><a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'">Написать сообщение</a></li>
						<li><a href="#">Добавить в друзья</a></li>
						<li><a onclick="return DelMessage('.$userMessage['messages_id'].', '.(int)$message['current_page'].', '.(int)$message['groupId'].', \''.$message['groupName'].'\');" href="javascript: void(0);" class="spam-link">Удалить</a></li>
					</ul>
				</li>';
		}
		if (!$htmlMess) $htmlMess = "В данной группе нет писем";
        					?>	
						</ul>
						<!-- /message-blog-view -->
						<ul class="pages-list clearfix">
							<li class="control"><span>« Назад</span> <a href="#">Вперед »</a></li>
							<li><strong>1</strong></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li>...</li>
							<li><a href="#">34</a></li>
						</ul>
						<div id="myMessagePager"><?php echo $this->myMessagePager; ?></div>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('control_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
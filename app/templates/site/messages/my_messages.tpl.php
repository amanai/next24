<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../profile_line.tpl.php')); ?>
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
		        $avPath = 'no90.jpg';
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
						<ul class="pages-list clearfix" id="myMessagePager">
							<?php echo $this->myMessagePager; ?>
						</ul>
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
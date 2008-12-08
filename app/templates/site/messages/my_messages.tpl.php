<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- ПРОФИЛЬ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_left">
				<!-- левый блок -->
					<?php include($this -> _include('control_panel.tpl.php')); ?>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
				<!-- правый блок -->
					<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Личная почта<span id="titleGroupName">. Все сообщения</span></h2></div>
								<div class="block_title_right">
									<img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js'); return false;" style="cursor: pointer;" />
								</div>
						</div>

						<div id="user_profile_js">
        					<div class="cmod_messages" id="cmod_messages">
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
		    if (!$userMessage['is_read']) $sIsRead = ' - <span id="red">Новое</span>';
		    else $sIsRead = '';
		    echo '
		    <div class="cmod_tab'.$i.'">
				<table class="cmod_x">
				<tr>
					<td class="cmod_x1" rowspan="2">
						<h2><a href="'.Project::getRequest() -> createUrl('User', 'Profile', null, $userMessage['author_login']).'">'.$userMessage['author_login'].'</a></h2>
						<div class="av_preview"><img src="'.$this->image_url.'avatar/'.$avPath.'" alt="'.$avName.'" style="margin: 5px;"/></div>
					</td>
					<td class="cmod_x2a" rowspan="2">
						<p>'.$userMessage['send_date'].$sIsRead.'</p>
						<h3>'.$userMessage['header'].'</h3><br/>
						'.$userMessage['m_text'].'
					</td>
					<td class="cmod_x4">
					   <a onclick="return DelMessage('.$userMessage['messages_id'].', '.(int)$message['current_page'].', '.(int)$message['groupId'].', \''.$message['groupName'].'\');" href="javascript: void(0);">удалить</a>
					</td>
				</tr>
				<tr>
				    <td class="cmod_x3">
						<a href="'.Project::getRequest() -> createUrl('Messages', 'SendMessage').'/message_action:reply/mess_id:'.$userMessage['id'].'"><b>написать сообщение</b></a>  |  
						<a href="'.Project::getRequest() -> createUrl('Messages', 'CorrespondenceWith').'/corr_user_id:'.$userMessage['author_id'].'"><b>читать переписку</b></a><br/>
					</td>
				</tr>
				</table>
			</div>
		    
    	    ';
		}
		if (!$htmlMess) $htmlMess = "В данной группе нет писем";
        					?>
        					</div>
						</div>

					</div></div></div></div>
					<div id="myMessagePager"><?php echo $this->myMessagePager; ?></div>
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /ПРОФИЛЬ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
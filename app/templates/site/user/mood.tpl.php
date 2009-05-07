<?php include($this -> _include('../header.tpl.php')); ?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->current_user->id); ?>
<!-- Главный блок, с вкладками (Контент) -->
				<ul class="view-filter clearfix"> 
					<li><a href="<?php echo $this -> createUrl('User', 'Profile');?>">
					<?if(!trim($this->user_name)) echo $this->user_profile['login'];
					 else echo $this->user_name;?></a></li>
					<li><strong>Настройки профиля<span></span></strong></li> 
				</ul> 
				<!-- /view-filter --> 
 
				<div class="user-profile"> 
					<div class="clearfix"> 
					<form action="<?=$this -> createUrl('User', 'Saveprofile'); ?>" method="post">
					<input type="hidden" name="flash" value="true" />					
						<dl class="main-info"> 
							<dt><span class="user-status"><span class="online">online</span></span> <strong>
							<?if(!trim($this->user_name)) echo 'Нет имени';
					 		else echo $this->user_name;?></strong>  / <span class="nick"><?=$this->user_profile['login'];?></span> /</dt> 
							<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; 
	    						if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no90.jpg';
	    						else $avator_path = $this->image_url.'avatar/'.$avator_path;							
							?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $avator_path;?>" /></dd> 
							<dd><?=$this->user_location;?></dd> 
							<dd>На сайте: <span class="date">12 дней</span></dd> 
							<dd>Статус: <input type="text" name="status" value="<?=$this->user_profile['status'];?>" size="26" /><input type="submit" value="OK" /></dd> 
							<dd>Настроение: <input name="mood" type="text" value="<?=$this->user_profile['mood'];?>" size="20" /><input type="submit" value="OK" /></dd> 
						</dl> 
						<div class="about-info"> 
							<div class="ttl"><strong>О себе</strong></div> 
							<div class="cnt"> 
								<textarea name="about" cols="20" rows="3"><?=$user['about']; ?></textarea> 
								<input type="submit" value="OK" /> 
							</div> 
						</div> 
						<div class="rating-info"> 
							<div class="ttl"><strong>Рейтинг: <span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->current_user->id); echo $nr['rate']; ?> NR</span></strong></div> 
							<div class="cnt"> 
								Профиль заполнен на:
								<div class="rating-view"> 
									<strong><?=$user['rate']*10;?>%</strong> 
									<div style="width:<?=$user['rate']*10;?>%;"></div> 
								</div> 
								<a href="#" class="script-link"><span class="t">подробнее о рейтинге</span></a> 
							</div> 
						</div> 
						</form>
					</div> 
				</div> 
				<!-- /user-profile --> 
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<?=$this -> flash_messages; ?>
						<form class="main-form" action="#" method="post">
							<input type="hidden" name="mood_action" value="ok"/> 
							<fieldset class="alt"> 
								<h2>Управление фразами настроения</h2> 
								<p class="field-help">Эти фразы Вы можете использовать в своих комментариях</p> 
								<ul> 
									<li class="field-it"> 
										<div class="label"><label for="mood_name">Название:</label></div> 
										<div class="field f-bbig"> 
											<input type="text" id="mood_name" name="mood_name" value="я сегодня не такой как вчера, а вчера я был совсем никакой" />
											<input type="submit" name="add_mood" value="Добавить" />
											<p class="field-help">Не длиннее 100 символов</p> 
										</div> 
									</li> 
                					<?php if (($this->user_profile['id']==$this->current_user->id || $this->isAdmin) && $this->user_moods){ ?>
									<li class="field-it"> 
										<div class="label">Изменить существующие</div>
										<?php $cnt=0; ?> 
                						<?php foreach ($this->user_moods as $mood){ ?>
                							<div class="field f-bbig"><input type="text" id="moods[<?php echo $mood['id']; ?>]" name="moods[<?php echo $mood['id']; ?>]" value = "<?php echo $mood['name']; ?>" /> <input type="checkbox" name="del_moods[<?php echo $mood['id']; ?>]" value="<?php echo $mood['id']; ?>" id="d<?=$cnt;?>" /><label for="d<?=$cnt;?>">Удалить</label></div> 
                						<?php $cnt++; ?>
                						<?php } ?>										
									</li>                 					
                					<?php } ?>									
								</ul> 
								<div class="button"><input type="submit" name="change_mood" value="Сохранить изменения" /></div> 
							</fieldset> 
						</form> 					
					</div></div> 
					<!-- /main --> 
					<div class="sidebar"> 
						<div class="user-action"> 
							<ul> 
								<li><a href="<?php echo $this -> createUrl('User', 'ProfileEdit');?>"><i class="icon prof-ed-icon"></i>Редктировать профиль</a></li> 
								<li><a href="<?php echo $this -> createUrl('User', 'AvatarEdit');?>"><i class="icon avatar-ed-icon"></i>Редактировать аватары</a></li> 
								<li><a href="<?php echo $this -> createUrl('User', 'Mood');?>"><i class="icon mood-ed-icon"></i>Фразы настроения</a></li> 
								<li><a href="<?php echo $this -> createUrl('Places', 'Index');?>"><i class="icon place-ed-icon"></i>Места работы, учебы</a></li> 
							</ul> 
						</div> 
					</div> 
					<!-- /sidebar --> 
				</div> 
				<!-- /columns-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->current_user->id); ?>
				<ul class="view-filter clearfix"> 
					<li><a href="<?php echo $this -> createUrl('User', 'Profile');?>">
					<?if(!trim($this->user_name)) echo 'Нет имени';
					 else echo $this->user_name;?></a></li>
					<li><strong>Настройки профиля<span></span></strong></li> 
				</ul> 
				<!-- /view-filter --> 
 
				<div class="user-profile"> 
					<div class="clearfix"> 
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
							<dd>Статус: <input type="text" value="Улетел на багамы" size="26" /><input type="submit" value="OK" /></dd> 
							<dd>Настроение: <input type="text" value="Отличное" size="20" /><input type="submit" value="OK" /></dd> 
						</dl> 
						<div class="about-info"> 
							<div class="ttl"><strong>О себе</strong></div> 
							<div class="cnt"> 
								<textarea cols="20" rows="3"><?=$user['about']; ?></textarea> 
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
					</div> 
				</div> 
				<!-- /user-profile --> 
 
				<div class="columns-page clearfix"> 
					<div class="main"><div class="wrap"> 
						<?=$this -> flash_messages; ?>
					<?php if ($this->count_user_avatars < 10){ ?>
						<form class="main-form" enctype="multipart/form-data" method="post" action=""> 
							<input type="hidden" name="avatar_action" value="create_avatar"/>
							<fieldset class="alt"> 
								<h2>Загрузка аватара</h2> 
								<p class="field-help">Аватар - это картинка, которая может быть показана рядом с вашим именем в комментариях, блоге, личном профиле и т.д.
Размер аватара будет автоматически изменен до 100х100 пикселей. </p> 
								<ul> 
									<li class="field-it"> 
										<div class="label"><label for="newava_name">Название:</label></div> 
										<div class="field f-mid"> 
											<input type="text" id="newava_name" name="newava_name" value="<?php echo $this->newava_name;?>" />
											<span class="field-help">Не длиннее 50 символов</span> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="newava_file">Аватар</label></div> 
										<div class="field f-mid"> 
											<input type="file" id="newava_file" name="newava_file" />
											<span class="field-act"><a href="#" class="with-icon-s"><i class="icon-s add-s-icon"></i>Добавить еще аватар</a></span> 
										</div> 
									</li> 
                					<?php if ($this->isAdmin){ ?>
                					<li>
                						<div class="label"><label for="is_system">Ситемный аватар:</label></div>
        								<div class="field f-mid"> 
											<input type="checkbox" id="is_system" name="is_system" />
											<span class="field-help">Администраторская функия</span> 
										</div>         						
                					</li>
                					<?php } ?>									
								</ul> 
								<div class="button"><input type="submit" value="Загрузить аватар" /></div> 				
							</fieldset> 
						</form> 
						
						<form class="main-form" method="post" action=""> 
							<input type="hidden" name="avatar_action" value="sys_avatar"/>
							<fieldset> 
								<h2>Выбор системного аватара</h2> 
								<div class="item-edit-list"> 
									<ul class="clearfix">
                					<?php foreach ($this->sys_avatars as $sys_avatar) { ?>
										<li class="it"> 
											<div class="nm"><input type="text" value="<?php echo $sys_avatar['av_name'];?>" name="avatar_names[<?php echo $sys_avatar['id'];?>]"/></div> 
											<div class="av"><img alt="<?php echo $sys_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$sys_avatar['path'];?>"/></div> 
											<div class="act"><input type="radio" id="s-av-1" value="<?php echo $sys_avatar['id'];?>" name="avatar_check" /><label for="s-av-1">Выбрать</label</div> 
											<?php if ($this->isAdmin){ ?>
												<div class="act del-act"><input type="checkbox" id="s-av-1-del" name="avatars_delete[<?php echo $sys_avatar['id'];?>]"/><label for="s-av-1-del">Удалить</label></div> 
											<?php } ?>
										</li>                 					
        							<?php } ?>									 
									</ul> 
								</div> 
								<div class="button">
									<input type="submit" value="Выбрать<?php if ($this->isAdmin){ echo "/Изменить"; }?> аватар"/>
								</div> 
							</fieldset> 
						</form> 			
					<?php } ?>
					<?php if ($this->count_user_avatars){ ?>
						<form class="main-form" method="post" action="">
						<input type="hidden" name="avatar_action" value="change_avatar"/> 
							<fieldset> 
								<h2>Управление своими аватарами</h2> 
								<div class="item-edit-list"> 
									<ul class="clearfix"> 
                					<?php foreach ($this->user_avatars as $user_avatar){
                	    				$avator_path = ($user_avatar['sys_av_id'])?$user_avatar['sys_path']:$user_avatar['path']; ?>
										<li class="it"> 
											<div class="nm"><input type="text" value="<?php echo $user_avatar['av_name'];?>" name="avatar_names[<?php echo $user_avatar['id'];?>]"/></div> 
											<div class="av"><img alt="<?php echo $user_avatar['av_name'];?>" src="<?php echo $this->image_url."avatar/".$avator_path;?>"/></div> 
											<div class="act"><input type="radio" value="<?php echo $user_avatar['id'];?>" name="avatar_default" <?php if ($user_avatar['def']) echo 'checked="checked"'; ?> id="c-av-2" /><label for="c-av-2">По умолчанию</label></div> 
											<div class="act del-act"><input type="checkbox" name="avatars_delete[<?php echo $user_avatar['id'];?>]" id="d-av-2" /><label for="d-av-2">Удалить</label></div> 
										</li>                 	    				
    								<?php } ?>									
									</ul> 
								</div> 
								<div class="button"><input type="submit" value="Сохранить изменения"></div> 
							</fieldset> 
						</form> 							
					<?php } ?>											
					</div></div> 
					<!-- /main --> 
					<?php  if ($this->user_profile['id']==$this->current_user->id){ ?>
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
					<?php } ?>
				</div> 
				<!-- /columns-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->current_user->id); ?>
			<ul class="view-filter clearfix"> 
					<li><a href="<?php echo $this -> createUrl('User', 'Profile');?>">
					<? $name_usr = implode(' ',array($user['last_name'],$user['first_name'],$user['middle_name']));
					if(!trim($name_usr)) echo 'Нет имени';
					else echo $name_usr;?></a></li> 
					<li><strong>Настройки профиля<span></span></strong></li> 
				</ul> 
				<!-- /view-filter --> 
 
				<div class="user-profile"> 
					<div class="clearfix"> 
						<dl class="main-info"> 
							<dt><span class="user-status"><span class="online">online</span></span> <strong>
							<?if(!trim($name_usr)) echo 'Нет имени';
								else echo $name_usr;?></strong>  / <span class="nick"><?=$this->current_user->login; ?></span> /</dt> 
							<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; 
	    						if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no90.jpg';
	    						else $avator_path = $this->image_url.'avatar/'.$avator_path;								
							?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $avator_path;?>" /></dd> 
							<dd><?			$tmp=array();
			if ($user['country']) $tmp[]=$user['country'];
			if ($user['state']) $tmp[]=$user['state'];
			if ($user['city']) $tmp[]=$user['city'];
			$user_location = $tmp?implode(' ', $tmp):false; echo $user_location;?></dd> 
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
						<form class="main-form" action="<?php echo $this->createUrl('Places', 'AddEntity', null, $this->current_user->login)?>" id="nav_form" method="post"> 
							<fieldset class="alt"> 
								<h2>Добавить место</h2> 
								<ul> 
									<li class="field-it"> 
										<div class="label"><label for="geo_type">Добавление нового места</label></div> 
										<div class="field f-big"> 
											<select id="geo_type" onChange="reload_dropdowns('geo_type');" style="width: 150px;" name="geo_type_id">
											<? if (!$this->session->geo_type_id) { ?><option value="0" selected="selected">- выберите тип -</option><? } ?>
												<? foreach ($this->geo_types as $item) { ?>
													<option value="<?=$item['id'];?>"<?=($item['id']==$this->session->geo_type_id?' selected="selected"':'');?>><?=$item['name'];?></option>
												<? } ?>
											</select>											
										</div> 
									</li> 
									<li class="field-it fl-l"> 
										<div class="label"><label for="f2">Страна</label></div> 
										<div class="field f-big"> 
											<?=$this->_dropdown('country', 'выберите тип места', '- выберите страну -', $this->countries); ?>
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f3">Город</label></div> 
										<div class="field f-big"> 
											<?=$this->_dropdown('city', 'выберите страну', '- выберите город -', $this->cities); ?>
										</div> 
									</li> 
									<li class="field-it fl-l"> 
										<div class="label"> 
											<label for="f4">Тип Места</label> 			
											<input type="submit" name="add_type" value="добавить тип" onClick="return AddType();">											
										<!--  	<a href="#" class="script-link"><span class="t">Добавить тип</span></a> 	-->
										</div> 
										<div class="field f-big"> 
											<?=$this->_dropdown('geo_subtype', 'выберите город', '- выберите тип -', $this->geo_subtypes); ?>	
										</div> 
									</li> 
									<li class="field-it field-it"> 
										<div class="label"> 
											<label for="f5">Место</label> 	
											<input type="submit" value="добавить место" name="add_place" onClick="return AddPlace();">&nbsp;<span id="show_users"></span>										
										<!--  <a href="#" class="script-link"><span class="t">Добавить место</span></a> -->
										</div> 
										<div class="field f-big"> 
											<select disabled="disabled" id="f5"> 
												<?=$this->_dropdown('geo_place', 'выберите тип', '- выберите место -', $this->geo_places); ?>													
											</select> 
										</div> 
									</li> 
								</ul> 
								<div class="button"><input type="submit" class="button" name="add_object_to_user" onClick="return AddObjToUser(); " value="Добавить"/></div> 
								<? if (Project::getRequest()->add_type) include($this -> _include('addtype_form.tpl.php')); ?>
								<? if (Project::getRequest()->add_place) include($this -> _include('addplace_form.tpl.php')); ?>
								<? if (Project::getRequest()->add_object_to_user) include($this -> _include('add_object_to_user_form.tpl.php')); ?>	
								<? if ($this->edit_place) include($this -> _include('add_object_to_user_form.tpl.php')); ?>	
								<? if (is_array($this->users_list)) include($this -> _include('users_list.tpl.php')); ?>								
							</fieldset> 
						</form> 	
						<?php  include($this -> _include('my_places_list.tpl.php')); ?>									
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
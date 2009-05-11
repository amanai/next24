<?php include($this -> _include('../header.tpl.php')); ?>
<?php $user = Project::getUser()->getDbUser()->getUserById($this->current_user->id); ?>
				<ul class="view-filter clearfix"> 
					<li><a href="<?php echo $this -> createUrl('User', 'Profile');?>">
					<?	if(!trim($this->user_name)) echo $this->user_profile['login'];
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
							<?	if(!trim($this->user_name)) echo 'Нет имени';
								else echo $this->user_name;?></strong>  / <span class="nick"><?=$this->user_profile['login'];?></span> /</dt> 
							<?php $avator_path = ($this->user_default_avatar['sys_av_id'])?$this->user_default_avatar['sys_path']:$this->user_default_avatar['path']; 
	    						if(!$avator_path || $avator_path == 'no.png') $avator_path = $this->image_url.'avatar/no90.jpg';
	    						else $avator_path = $this->image_url.'avatar/'.$avator_path;							
							?>
							<dd class="av"><img alt="<?php echo $this->user_default_avatar['av_name'];?>" src="<?php echo $avator_path;?>" /></dd>
							<dd><?=$this->user_location;?></dd> 
						<!-- <dd>На сайте: <span class="date">12 дней</span></dd>  -->
							<dd>Статус: <input name="status" type="text" value="<?php echo $this -> helper -> status;?>" size="26" /><input type="submit" value="OK" /></dd> 
							<dd>Настроение: <input name="mood" type="text" value="<?php echo $this -> helper -> mood;?>" size="20" /><input type="submit" value="OK" /></dd> 
						</dl> 
						<div class="about-info"> 
							<div class="ttl"><strong>О себе</strong></div> 
							<div class="cnt"> 
								<textarea cols="20" rows="3" name="about"><?php echo $this -> helper -> about;?></textarea> 
								<input type="submit" value="OK" /> 
							</div> 
						</div> 
						<div class="rating-info"> 
							<div class="ttl"><strong>Рейтинг: <span class="nr"><? $nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($this->current_user->id); echo $nr['rate']; ?> NR</span></strong></div> 
							<div class="cnt"> 
								Профиль заполнен на:
								<div class="rating-view"> 
									<strong><?=(($user['rate']*10)-10);?>%</strong> 
									<div style="width:<?=(($user['rate']*10)-10);?>%;"></div> 
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
						<form class="main-form" action="<?=$this->edit?$this -> createUrl('User', 'Saveprofile'):$this -> createUrl('User', 'Registration'); ?>" method="post" id="register_form"> 
						<?=$this -> flash_messages; ?>
							<fieldset class="alt"> 
								<h2>Обязательные данные <i class="arrow-icon up-arrow"></i></h2> 
								<div class="profile-data-filed">
								<p class="field-help main-field-help"><span>Логин 
									<strong><?=$this -> helper -> login;?></strong>							
								</span> Чтобы изменить логин - обратитесь в <a href="#">службу поддержки</a></p> 
								<ul class="clearfix"> 
									<li class="field-it"> 
										<div class="label"><label for="f1" <?=($this->email_error?'style="color:red;"':'')?>>Email <em>*</em></label></div> 
										<div class="field f-mid"> 
											<?=$this -> helper -> email;?>											
										</div> 
									</li> 
									<li class="field-it fl-l"> 
										<div class="label"><label for="f2" <?=($this->pass_error?'style="color:red;"':'')?>>Новый пароль <em>*</em></label></div> 
										<div class="field f-mid"> 
											<input type="password" name="pwd" class="field" id="f2" value="" />
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f3">Подтверждение пароля <em>*</em></label></div> 
										<div class="field f-mid"> 
											<input type="password" name="pwd_repeat" class="field" id="f3" value="" />
										</div> 
									</li> 
									<li class="field-help"><div>Если хотите изменить пароль - заполните эти поля. В обратном случае осавьте эти поля пустыми.<br />Пароль может содержать латинские буквы, цифры и спецсимволы и должен быть не короче 6 символов.</div></li> 								
								</ul> 
								</div>
							</fieldset> 
							<fieldset class="alt"> 
								<h2>Основная информация о себе <span class="more-inf">(+15 баллов рейтинга максимально, +1.5 NextMoney максимально)</span> <i class="arrow-icon up-arrow"></i></h2> 
								<div class="profile-data-filed">
								<ul class="clearfix"> 
									<li class="field-it fl-l"> 
										<div class="label"><label for="f4">Фамилия</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f4" name="surname" value="<?php echo $this -> helper -> surname;?>" class="field" />
										</div> 
									</li> 
									<li class="field-it fl-l no-cl"> 
										<div class="label"><label for="f5">Имя</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f5" name="name" value="<?php echo $this -> helper -> name;?>" class="field" />
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f6">Отчество</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f6" name="father_name" value="<?php echo $this -> helper -> father_name;?>" class="field" />
										</div> 
									</li> 
									<li class="field-help"><div>Допустима кириллица, пробел и символ дефиса. Если вы хотите участвовать в поиске своих друзей, пожалуйста, введите свои реальные данные о себе.</div></li> 
									<li class="field-it fl-l"> 
										<div class="label"><label for="country">Страна</label></div> 
										<div class="field f-smid"> 
											<select name="country" id="country" onchange='changeList(<?=$this->change_country_param;?>, this);' class="field">
											<?php foreach($this -> country_list as $item) { ?>
												<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> country === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
											<?php } ?>
											</select>
											<div id="loading"></div>										
										</div> 
									</li> 
									<li class="field-it fl-l no-cl"> 
										<div class="label"><label for="state">Область</label></div> 
										<div class="field f-smid" id="state_div"> 
										<?php if ($this->state_list) { ?>
											<select name="state" id="state" onchange='changeList(<?=$this->change_state_param;?>, this);' class="field">
												<option value="0">---</option>
												<?php foreach($this -> state_list as $item) { ?>
													<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> state === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['name'];?></option>
												<?php } ?>
											</select>
										<?php } else { ?>		
											<select class="field" name="state">
												<option value="0">---</option>
											</select>			
										<? } ?>									
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="city">Город</label></div> 
										<div class="field f-smid" id="city_div"> 			
										<?php if ($this->city_list) { ?>
											<select name="city" id="city" class="field">
												<option value="0">---</option>
												<?php foreach($this -> city_list as $item) { ?>
												<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> city === (int)$item['id']){ echo 'selected';}?>><?php echo $item['name'];?></option>
												<?php } ?>
											</select>
										<?php } else { ?>		
											<select class="field" name="city">
												<option value="0">---</option>
											</select>		
										<? } ?>										
										</div> 
									</li> 
									<li class="field-it fl-l fl-c2"> 								
										<div class="fl-l f-ssmall"> 
											<div class="label"><label for="f10">Дата рождения</label></div> 
											<div class="field"> 
												<select name="day" id="f10">
												<?php foreach($this -> day_list as $item) { ?>
													<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> day === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['value'];?></option>
												<?php } ?>
												</select>											
											</div> 
										</div> 
										<div class="fl-l f-msmall"> 
											<div class="label"><label for="f11">Месяц</label></div> 
											<div class="field"> 
											<select name="month" id="f11">
											<?php foreach($this -> month_list as $item) { ?>
												<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> month === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['value'];?></option>
											<?php } ?>
											</select>											
											</div> 
										</div> 
										<div class="fl-l f-ssmall"> 
											<div class="label"><label for="f12">Год</label></div> 
											<div class="field"> 
											<select id="f12" name="year">
											<?php foreach($this -> year_list as $item) { ?>
												<option value="<?php echo $item['id'];?>" <?php if ((int)$this -> helper -> year === (int)$item['id']){ echo 'selected="selected"';}?>><?php echo $item['value'];?></option>
											<?php } ?>
											</select>												
											</div> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f13">Семейное положение</label></div> 
										<div class="field f-smid"> 
											<input id="f13" type="text" name="marital_status" value="<?php echo $this -> helper -> marital_status;?>" class="field"/>
										</div> 
									</li> 
									<li class="field-it"> 
										<span class="label">Пол:</span> 
										<span class="field f-men"> 
											<input type="radio" name="gender" id="gender_male" value="1" class="radio"<?=($this->helper->gender==1?' checked="checked"':'')?> />									
											<label for="gender_male">Мужской</label> 
										</span> 
										<span class="field f-women"> 
											<input type="radio" name="gender" id="gender_female" value="0" class="radio"<?=($this->helper->gender==0?' checked="checked"':'')?>/>
											<label for="gender_female">Женский</label> 
										</span> 
									</li> 
									<li class="field-it fl-l"> 
										<div class="label"><label for="f15">ICQ</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f15" name="icq" value="<?php echo $this -> helper -> icq;?>" class="field"/>
										</div> 
									</li> 
									<li class="field-it fl-l no-cl"> 
										<div class="label"><label for="f16">Skype</label></div> 
										<div class="field f-smid"> 
											<input type="text" name="skype" id="f16" value="<?php echo $this -> helper -> skype;?>" /> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f17">IM</label></div> 
										<div class="field f-smid"> 
											<input type="text" name="im" id="f17" value="<?php echo $this -> helper -> im;?>" /> 
										</div> 
									</li> 
									<li class="field-it fl-l"> 
										<div class="label"><label for="f18">Сайт</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f18" name="website" value="<?php echo $this -> helper -> website;?>" class="field"/>
										</div> 
									</li> 
									<li class="field-it fl-l no-cl"> 
										<div class="label"><label for="f19">Телефон</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f19" name="phone" value="<?php echo $this -> helper -> phone;?>" class="field" />
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f20">Мобильный телефон</label></div> 
										<div class="field f-smid"> 
											<input type="text" id="f20" name="mobile_phone" value="<?php echo $this -> helper -> mobile_phone;?>" class="field"/>
										</div> 
									</li> 
								</ul> 
								</div>
							</fieldset> 
							<fieldset class="alt"> 						
								<h2>Дополнительная информация о себе <span class="more-inf">(+4 балла рейтинга максимально, +1.5 NextMoney максимально)</span> <i class="arrow-icon up-arrow"></i></h2> 
								<div class="profile-data-filed">
								<ul class="clearfix"> 
									<li class="field-it"> 
										<div class="label"><label for="f21">О себе</label></div> 
										<div class="field f-bbig"> 
											<textarea id="f21" cols="20" rows="5" name="about"><?php echo $this -> helper -> about;?></textarea> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f22">Интересы</label></div> 
										<div class="field f-bbig"> 
											<textarea id="f22" cols="20" rows="5" name="interest"><?php echo $this -> helper -> interest;?></textarea> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f23">Любимые книги</label></div> 
										<div class="field f-bbig"> 
											<textarea id="f23" cols="20" rows="5" name="books"><?php echo $this -> helper -> books;?></textarea> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f24">Любимые фильмы</label></div> 
										<div class="field f-bbig"> 
											<textarea id="f24" cols="20" rows="5" name="films"><?php echo $this -> helper -> films;?></textarea> 
										</div> 
									</li> 
									<li class="field-it"> 
										<div class="label"><label for="f25">Любимые музыканты</label></div> 
										<div class="field f-bbig"> 
											<textarea id="f25" cols="20" rows="5" name="musicians"><?php echo $this -> helper -> musicians;?></textarea> 
										</div> 
									</li> 									
								</ul> 
								</div>
							</fieldset> 
							<div class="button">
							<input type="submit" name="register" value="Сохранить профиль" /></div> 
						</form> 
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
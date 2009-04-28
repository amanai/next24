		<form class="main-form" action="#" method="post"> 
							<fieldset> 
								<h2>Места учебы, работы, отдыха, службы</h2> 
								<div class="places-list"> 
									<ul> 
									<? foreach ($this->my_places as $place) { ?>
										<li class="clearfix it"> 
											<div class="date"><?=$place['date_start'];?> — <?=$place['date_end'];?></div> 
											<h3 class="name">Украина <span>/</span> <?=$place['city'];?> <span>/</span> <strong><?=$place['name'];?></strong></h3> 
											<ul class="action clearfix"> 
												<li><a href="<?php echo $this->createUrl('Places', 'ShowUsers', array('id'=>$place['geo_place_id']), $this->current_user->login)?>">смотреть <strong><!--125--></strong> пользователей</a><span>|</span></li> 
												<li><a href="<?php echo $this->createUrl('Places', 'EditPlace', array('id'=>$place['id']), $this->current_user->login)?>">редактировать</a><span>|</span></li> 
												<li><a href="<?php echo $this->createUrl('Places', 'DeletePlace', array('id'=>$place['id']), $this->current_user->login)?>" class="delete-link">удалить</a></li> 
											</ul>
										<!-- 
										<div class="edit-box"> 
												<div class="ttl clearfix"> 
													<h4>Редактирование объекта</h4> 
													<div class="close"><a href="#"><span>x</span> закрыть</a></div> 
												</div> 
													<fieldset> 
														<span class="legend">Годы:</span> 
														<label for="year-s">c</label> 
														<select id="year-s"><option>1985</option></select> 
														<label for="year-e">по</label> 
														<select id="year-e"><option>1985</option></select> 
														<p><input type="submit" value="Сохранить" /></p> 
													</fieldset> 
											</div> -->
											<!-- /edit-box --> 										
										 	
										<!-- 
											<div class="edit-box"> 
												<div class="ttl clearfix"> 
													<h4>Список пользователей</h4> 
													<div class="close"><a href="#"><span>x</span> закрыть</a></div> 
												</div> 
												<ul class="users"> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
													<li class="user-it"> 
														<dl> 
															<dt><a href="#">Козицкий Анатолий Александрович</a> [ <a href="#">slonik</a> ]<img class="avatar" src="assets/i/temp/avatar.jpg" alt="" /></dt> 
															<dd class="where">Россия / Москва</dd> 
															<dd class="when">В этом месте <strong>1990 – 2009</strong></dd> 
															<dd class="cntrl"> 
																<ul class="member-controll clearfix"> 
																	<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
																	<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
																	<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
																	<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
																</ul> 
															</dd> 
														</dl> 
													</li> 
												</ul> 
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
											</div>  -->
											<!-- /edit-box --> 																 
										</li> 											
									<? } ?>									
									</ul> 
								</div> 
							</fieldset> 
						</form> 
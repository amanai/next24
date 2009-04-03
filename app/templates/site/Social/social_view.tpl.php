<!-- TEMPLATE: Форма просмотра Соц.позиций, добавления комментариев, оценки -->
<?php include($this -> _include('../header.tpl.php')); ?>
<?php $request = Project::getRequest(); ?>
				<div class="columns-page clearfix">
					<div class="main"><div class="wrap">
						<div class="view-filter clearfix">
					<!--  	<form class="search-filter" name="frm_find" method="post" action="<?php echo $this->createUrl('Social', 'SocialMainList');?>">
								<fieldset>
									<label for="sf1">Поиск по имени:</label>
									<input type="text" id="sf1" value="Введиите имя" size="45" name="inp_find" value="<?=$this->str_find; ?>" />
									<input type="submit" name="btn_find" value="Ok" />
								</fieldset>
								<input type="hidden" name="inp_hide" value="find">
							</form>		-->
							<ul class="clearfix">
								<?php include($this -> _include('../tab_panel.tpl.php')); ?>
							</ul>
						</div>
						<!-- /view-filter -->
						<div class="display-filter clearfix">
							<div class="breadcrumbs">
							<? if (count($this->social_row > 0)) { ?>
								<?=$this->social_row[0]['social_category']; ?>
							<? } ?>			
							</div>
						</div>
						<!-- /display-filter -->
						<div class="blog-post">
						<? if (count($this->social_row > 0)) { ?>
							<h2><?=$this->social_row[0]['name'];?></h2>
						<? } ?>	
							<div class="object-rating">
							<? if (count($this->social_row > 0)) { ?>
								<table class="view-rating">
									<tbody>	
									<?php $cnt=1; ?>
									<? foreach($this->social_row as $key => $value)  {?>
										<tr class="type-<?=$cnt?>">
											<th><?=$value['criteria_name'];?></th>
											<td class="view">
												<div class="container"><div class="c-wrp"><div class="c-wrp">
													<div class="percentage" style="width:<?=number_format($value['votes_avg'], 2, '.',' ')*10;?>%" ><div class="p-wrp"><div class="p-wrp"></div></div></div>
												</div></div></div>
											</td>
											<td class="summ"><?=number_format($value['votes_avg'], 2, '.',' ');?></td>
										</tr>	
										<? $cnt++;?>								
									<? } ?>
									</tbody>
								</table>
							<? } ?>	
								<!-- /view-rating -->
								<div class="do-rating clearfix">
								<? if (count($this->social_row > 0)) { ?>
									<div class="overall-rating">Общий рейтинг <strong><?=number_format($this->social_row[0]['avg_rating'], 3, '.',' ');?></strong></div>
								<? } ?>	
								<? $a=1; ?>
								<?php $v_form_action = $this->createUrl('Social', 'SocialVoteAdd', array($this->social_row[0]['id'])); ?>
								<? if ($this->count_comment == 0) { ?>
									<div style="text-align:center;width:100%;padding-top:27px;">Для того, чтобы иметь возможность оценить позицию вам необходимо оставить хотя бы один комментарий к ней.</div>
								<? } else { ?>
									<? $v_i = 1; ?>
									<? if ($this->count_votes < 1) { ?>	
								<form action="<?=$v_form_action;?>" method="post">
									<table>
										<tbody>
           								<? foreach($this->social_row as $key => $value) {?>
           								<? if(!$key%3) { ?>
           									<tr>
           								<? } ?>	
           									<th>
           										<label for="vote<?=$v_i;?>"><?=$value['criteria_name'];?></label>
           									</th>
             								<td>
               									<select name="inp_select_<?=$v_i;?>" id="vote<?=$v_i;?>">
                									<option value="1">1</option>
                 									<option value="2">2</option>
                 									<option value="3">3</option>
                 									<option value="4">4</option>
                 									<option value="5" selected="">5</option>
                 									<option value="6">6</option>
                 									<option value="7">7</option>
                 									<option value="8">8</option>
                 									<option value="9">9</option>
                 									<option value="10">10</option>
               									</select>
               									<input type="hidden" name="inp_criteria_id_<?=$v_i;?>" value="<?=$value['criteria_id'];?>">
             								</td>
           								<? if(!$key%3) { ?>
           									</tr>
           								<? } ?>	             								
             								<? $v_i++; ?>
           								<? } ?>
           								<tr>
           									<td class="button" colspan="2"><input type="submit" name="inp_submit_vote" value="Оценить" /></td>
           								</tr>
           								</tbody>
           							</table>	
								</form>	
								<? } else { ?>
									<div style="text-align:center;width:100%;padding-top:27px;">Вы уже проголосовали.</div>
           						<? } ?>
         					<? } ?>													
								</div>
							</div>
							<!-- /object-rating -->
							<div class="post-content">
								
							</div>
							<!-- /post-content -->
						  	<div class="tag-list">
							<!--  <i class="icon tags-list-icon"></i>
								<ul>
									<li><a href="#" rel="tag">apple</a>,</li>
									<li><a href="#" rel="tag">mac</a>,</li>
									<li><a href="#" rel="tag">pc</a></li>
								</ul>	-->
								&nbsp;
							</div>	
							<!-- /tag-list -->
							<div class="post-meta"><div class="bg"><div class="bg clearfix">
								<ul>
									<li class="it ath">
										<div class="dropdown">
											<div class="d-head">
											<?php 
												$user = Project::getUser()->getDbUser()->getUserByLogin($this->social_row[0]['login']);
												$avatar = Project::getUser()->getDbUser()->getUserAvatar($user['id']);
												$avPath = $avatar['path'];
												if(!$avPath || $avPath == 'no.png') $avPath = 'no50.jpg';
												if($user['gender']) {
													$class = 'user-icon';	
												}
												else {
													$class = 'wuser-icon';
												} 											
											?>
												<a href="<?=$request->createUrl('Index','Index', null, $this->social_row[0]['login']); ;?>" class="with-icon-s"><i class="icon-s <?=$class; ?>"></i><?=$this->social_row[0]['login']; ?></a><i class="arrow-icon vcard-icon"></i>
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
										<?php 
											$user = Project::getUser()->getDbUser()->getUserByLogin($this->social_row[0]['login']);
											$online = Project::getUser()->getDbUser()->isUserOnline($user['id']);
											$nr = Project::getUser()->getDbUser()->getUserRateNMByRegistrationData($user['id']);				
										?>
										<span class="user-status"><span class="online"><?=($online)?'online':'offline';?></span><span class="nr"><?=$nr['rate'];?> nr</span></span>
									</li>
									<li class="it date"><?=date_format(new DateTime($this->social_row[0]['creation_date']),'d.m.y H:i'); ?></li>
									<li class="it com">
										<?php $comment_num = count($this->comment_list); ?>
										<a href="#" class="with-icon-s"><i class="icon-s commets-icon"></i><?=$comment_num; ?></a>
									</li>
								</ul>
							</div></div></div>
							<!-- /post-meta -->
						</div>
						<!-- /blog-post -->
						<?=$this->comment_list?>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
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
							<?php include($this -> _include('panel_category.tpl.php')); ?>
						</div>
					</div>
					<!-- /sidebar -->
				</div>
				<!-- /columns-page -->
<?php include($this -> _include('../footer.tpl.php')); ?>
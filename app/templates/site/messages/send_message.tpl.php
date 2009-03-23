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
					<div class="main"><div class="wrap">
						<h2 class="page-ttl">Написать Сообщение</h2>
						<form class="write-message" action="#">
							<table>
								<tbody>
									<tr>
										<td class="label">Кому</td>
										<?php if ($this->message_to == "admin"){ ?>
										<td><div class="wrp">
						          			Администрации <input type="hidden" value="admin" name="message_to" />
						          		</div></td>	
						     			<? }else{ ?>
										<td><div class="wrp">
											<span class="field-help"><label for="f1">Выбрать из списка друзей</label></span>
											<select id="f1" name="recipient" id="recipient" onchange="messageRecipientChange(1);">
						          				<option value="0">Список друзей</option>
						         				<?php foreach ($this->user_friends as $friend){ ?>
						              				<option value="<?=$friend['login']; ?>"><?=$friend['login']; ?></option>
						          				<? } ?>
											</select>
										</div></td>
										<td><div class="wrp">
											<span class="field-help"><label for="f2">Ввести имя вручную</label></span>
											<input type="text" id="f2" name="recipient_name" value="<?=$this->recipient_name; ?>" onchange="messageRecipientChange(2);" />  <!-- id="recipient_name" -->
										</div></td>
										<? } ?>
									</tr>
									<tr>
										<td class="label"><label for="f3">Тема</label></td>
										<td colspan="2">
											<input type="text" class="big" id="f3" name="mess_header" value="<?=$this->mess_header; ?>" />
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<label for="f4" class="label">Сообщение</label>
											<textarea rows="8" cols="30" id="f4" name="m_text"><?=$this->m_text; ?></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<div class="label"><label for="f5">Выберите аватар для сообщения</label></div>
											<select id="f5" name="avatar_id">
                			    				<option value="0"> [Ваши аватары] </option>
                    							<?php foreach ($this->user_avatars as $user_avatar){
                    			    				$selected = ($user_avatar['id']==$this->default_avatar['id'])?"selected=\"selected\"":"";
                    			    				echo '<option value="'.$user_avatar['id'].'" '.$selected.'>'.$user_avatar['av_name'].'</option>';
                    							} ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="button"><input type="submit" name="Submit" alt="Отправить" value="Отпавить сообщение" /></div>
						</form>
					</div></div>
					<!-- /main -->
					<div class="sidebar">
						<?php include($this -> _include('control_panel.tpl.php')); ?>
					</div>
					<!-- /sidebar -->
					<div id="myMessagePager"></div>
				</div>
				<!-- /columns-page -->
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
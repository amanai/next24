<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<input type="hidden" name="currEtap" id="currEtap" value="ChooseHelpers" />
						<input type="hidden" name="refreshNow" id="refreshNow" value="0" />					
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>4</strong> из 7. Выбор помошников</div> 
							<?php $this->showTimer(); ?>
							<div class="time">Осталось <span>30</span> мин. <span>24</span> сек.</div> 
						</div> 
						<?php 
							if ($this->isDebateUser){ 
   							 echo '<p>Вам необходимо выбрать себе 2-х помощников. Если вы не выберите себе помощников в течении отведенного времени, то они будут 
							Назначены вам автоматически из числа изъявивших желание пользователей.</p>';
							}else{
    							echo '<p>Если вы хотите стать помощников одного из участников дебатов нажмите на кнопку «Я хочу быть помощником» с желаемым участником.
								<span class="alert">ВНИМАНИЕ. Перед тем, как нажимать на кнопку обязательно ознакомьтесь с обязанностями помощников.</span></p>';
							}
						?>						
					</div> 
					<!-- /d-head --> 
					<h1><span>Тема дебатов:</span> <?php echo $this->debateNow['theme']; ?></h1> 
					<div class="d-wrap clearfix"> 
						<div class="d-content"><div class="inn"> 
							<ul class="helpers"> 
								<li><a href="#"><i class="big-icon helpers-icon"></i>Я хочу стать помошником <strong>madvic</strong></a></li> 
								<li><a href="#"><i class="big-icon helpers-icon"></i>Я хочу стать помошником <strong>fedor</strong></a></li> 
							</ul> 
							<!-- /bid --> 
						</div></div> 
						<!-- /d-content --> 
						<div class="member-info l-side"> 
							<div class="avatar">
								<a href="<?=$this->createUrl('User', 'Profile', null, $this->debateUser1['login']);?>">
									<?php $this->showUserAvator($this->user1_avatar, $this -> image_url); ?>
									<span class="member-name"><?=$this->debateUser1['login']; ?></span>
								</a>
							</div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul> 
							<dl id="helpersList1"> 
							<?php 
	   							if ($this->helper1_1){
	       							echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a></p>'; 
	   							}else echo '<p>&nbsp;</p>';
	   							if ($this->helper1_2){
	       							echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a></p>'; 
	   							}else echo '<p>&nbsp;</p>';
	   						?>
								<dt>Помощники</dt> 
								<dd><a href="#">fedor</a></dd> 
								<dd>?</dd> 
							</dl> 
						</div> 
						<div class="member-info r-side"> 
							<div class="avatar"><a href="#"><img src="assets/i/temp/avatar.b.jpg" alt="" /><span class="member-name">fedor</span></a></div> 
							<ul class="controll clearfix"> 
								<li><a href="#" title="Написать сообщение"><i class="icon mail-icon"></i></a></li> 
								<li><a href="#" title="Статьи"><i class="icon mbook-icon"></i></a></li> 
								<li><a href="#" title="Добавить"><i class="icon adduser-icon"></i></a></li> 
								<li><a href="#" title="Комментарии"><i class="icon mcomm-icon"></i></a></li> 
							</ul> 
							<dl> 
								<dt>Помощники</dt> 
								<dd><a href="#">madvic</a></dd> 
								<dd>?</dd> 
							</dl> 
						</div> 
					</div> 
					<!-- /d-wrap --> 
					
					
				</div> 
				<!-- /debate-page --> 
 









<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	

<input type="hidden" name="currEtap" id="currEtap" value="ChooseHelpers" />
<input type="hidden" name="refreshNow" id="refreshNow" value="0" />
<!-- Этап 4 из 7. Идет выбор помощников. -->
<?php $this->showTimer(); ?>


<h2>Этап 4 из 7. Идет выбор помощников.</h2>
<?php 
if ($this->isDebateUser){ 
    echo 'Вам необходимо выбрать себе 2-х помощников. Если вы не выберите себе помощников в течении отведенного времени, то они будут 
Назначены вам автоматически из числа изъявивших желание пользователей.';
}else{
    echo 'Если вы хотите стать помощников одного из участников дебатов нажмите на кнопку «Я хочу быть помощником» с желаемым участником.
ВНИМАНИЕ. Перед тем, как нажимать на кнопку обязательно ознакомьтесь с обязанностями помощников.';
}
?>

<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

    <div style="text-align: center; margin: 0px -10px;">
	<div style="text-align: center;">
	<table class="debate_user" align="center">
	<tr>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <h2><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a>'; ?></h2>
	   <?php 
	   $this->showUserAvator($this->user1_avatar, $this -> image_url);
	   ?>
	   <h2>Помощники</h2>
	   <div id="helpersList1">
	   <?php 
	   if ($this->helper1_1){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_1['login']).'">'.$this->helper1_1['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   if ($this->helper1_2){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper1_2['login']).'">'.$this->helper1_2['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   ?>
	   </div>
	   </div>
	   </td>
	   <td valign="top"> 
	   
         <!-- center part  -->	
	
	    <form name="frmCheckHelper" action="" method="POST">
		<table class="questions">
		<tr>
			<td align="left"><div class="center width_400"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
        </tr>
            <td>
                <div id="centerTable">
                <table  class="questions">
		<?php 
		if ($this->isDebateUser){
		    echo '
		      <tr>
		          <td><b>Помощник</b></td>
		          <td><b>Рейтинг</b></td>
		          <td><b>Действия</b></td>
		      </tr>
		    ';
		    foreach ($this->aDebateUserHelpers as $debateUserHelpers){
		        $tr_id = "cmod_tab2";
		        echo '
		      <tr id="'.$tr_id.'">
		          <td><a href="'.$this->createUrl('User', 'Profile', null, $debateUserHelpers['login']).'">'.$debateUserHelpers['login'].'</a></td>
		          <td>'.(int)$debateUserHelpers['rate'].'</td>
		          <td>';
		        if ($this->isDebateUserCanAddHelpers &&  
		            $this->debateNow['helper_id_'.$this->userNumber.'_1'] != $debateUserHelpers['helper_id'] && 
		            $this->debateNow['helper_id_'.$this->userNumber.'_2'] != $debateUserHelpers['helper_id'] ){ // т.е. не был еще выбран
		            echo '<a href="'.$this->createUrl('Debate', 'Debate').'/check_helper:'.$debateUserHelpers['helper_id'].'">выбрать</a>';
		        }else {
		            echo '-';
		        }
		        echo '
		          </td>
		      </tr>
		          ';
		    }
		}elseif ($this->user_id && !$this->helperTable){
		    echo '
    		<tr id="helper1tr">
    			<td colspan="2"><div class="center"><input type="button" size=250 id="helper1btn" name="helper1" onclick="wantBeHelper(1);" value="Я хочу быть помощником участника '.$this->debateUser1['login'].'" /></div></td>
    		</tr><tr id="helper2tr">
    			<td colspan="2"><div class="center"><input type="button" size=250 id="helper2dtn" name="helper2" onclick="wantBeHelper(2);" value="Я хочу быть помощником участника '.$this->debateUser2['login'].'" /></div></td>
    		</tr>
		    ';
		}elseif ($this->helperTable){
		    echo '
		    <tr>
    			<td colspan="2"><div class="center" id=>Вы выбрали быть помощником у '.$this->helperTable['login'].'</div></td>
    		</tr>
		    ';
		}elseif(!$this->user_id){
		    echo '
		    <tr>
    			<td colspan="2"><div class="center">Что бы принять участие в дебатах, необходимо зарегистрироваться</div></td>
    		</tr>
    		
		    ';
		}
		?>
		      </table>
		      </div>
		  </td>
        </tr>
		</table>
		</form>
	   <!-- / chat part  -->
		
	   </td>
	   <td valign="top">
	   <div class="block_d_ld2">
	   <h2><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a>'; ?></h2>
	   <?php 
	   $this->showUserAvator($this->user2_avatar, $this -> image_url);
	   ?>
	   <h2>Помощники</h2>
	   <div id="helpersList2">
	   <?php 
	   if ($this->helper2_1){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_1['login']).'">'.$this->helper2_1['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   if ($this->helper2_2){
	       echo '<p><a href="'.$this->createUrl('User', 'Profile', null, $this->helper2_2['login']).'">'.$this->helper2_2['login'].'</a></p>'; 
	   }else echo '<p>&nbsp;</p>';
	   ?>
	   </div>
	   </div>
	   </td>
	</tr>
	</table>
		
	</div></div>

		
</div></div></div></div>



<!-- /Этап 4 из 7. Идет выбор помощников. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
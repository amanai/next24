<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
						<li><strong>Активные дебаты<span></span></strong></li> 
						<li><a href="#">Завершенные дебаты</a></li> 
						<li class="alt"><a href="#">Победители</a></li> 
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>7</strong> из 7.  Дебаты завершены!</div> 
						</div> 
						<p>Спасибо всем за участие</p> 
					</div> 
					<!-- /d-head --> 
					<div class="end-view"><div class="wrap"> 
						<i class="big-icon lose-icon"></i> 
						<p class="end-info"><span>Вы победили в дебатах</span> Есть ли жизнь на марсе?</p> 
						<h1 class="congratulations"><a href="#">Попробывать себя в других дебатах</a></h1> 
						<h2>Оцените ваших помошников</h2> 
						<form class="assess" action="#" method="post"> 
							<ul class="helpers-vote clearfix"> 
								<li class="it"> 
										<a class="avatar-link" href="#"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">leonid</span></a> 
										<ul> 
											<li><input type="radio" name="m1" id="m11" /><label for="m11">Хорошо помогал</label></li> 
											<li><input type="radio" name="m1" id="m12" /><label for="m12">Плохо помогал</label></li> 
											<li><input type="radio" name="m1" id="m13" /><label for="m13">Не помогал</label></li> 
										</ul> 
								</li> 
								<li class="it last"> 
										<a class="avatar-link" href="#"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">leonid</span></a> 
										<ul> 
											<li><input type="radio" name="m2" id="m21" /><label for="m21">Хорошо помогал</label></li> 
											<li><input type="radio" name="m2" id="m22" /><label for="m22">Плохо помогал</label></li> 
											<li><input type="radio" name="m2" id="m23" /><label for="m23">Не помогал</label></li> 
										</ul> 
								</li> 
							</ul> 
							<div class="buttom-field"><input type="submit" value="Оценить" /></div> 
						</form> 
					</div></div> 
					<!-- /end-view --> 
				</div> 
				<!-- /debate-page --> 
				
				
				
				
	<div class="debate-page"> 
		<ul class="view-filter clearfix"> 
			<?php include($this -> _include('../tab_panel.tpl.php')); ?>
		</ul> 
		<!-- /view-filter --> 
		<div class="d-head"> 
			<div class="title clearfix"> 
				<div class="stage">Этап <strong>7</strong> из 7.  Дебаты завершены!</div> 
			</div> 
			<p>
				<?php
					if ($this->userNumber){ // Debate User
						echo 'Спасибо за участие. Вы должны выставить оценки вашим помощникам.';
					}elseif($this->userIdFromHelper){ // Helper
    					echo 'Спасибо за участие.';
					}elseif($this->user_id){ // registred User
    					echo 'Спасибо что досмотрели до конца.';
					}else{
    					echo 'Спасибо что досмотрели до конца.';
					}
				?>			
			</p> 
		</div> 
		<!-- /d-head --> 
		<div class="end-view win-view" id="brok"><div class="wrap"> 
			<input type="hidden" name="currEtap" id="currEtap" value="Results" />
			<input type="hidden" name="refreshNow" id="refreshNow" value="0" />	
			<?php $this->showTimer(); ?>	
			<i class="big-icon win-icon"></i> 
			<?php
            if ($this->userNumber){ // Debate User
                if ($this->winnerUser){
                    if ($this->user_id == $this->winnerUser['id']){
                	   echo '<b>Вы победили в дебатах на тему «'.$this->debateNow['theme'].'».<br />
                        Поздравляем!</b>';
                    }else{
                        echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                        </b>';
                    }
                }else{ // ничья
                    echo '<b>В дебатах никто не победил.</b>';
                }
                if (!$this->isEstimated){ // not estimated
                    echo '
                        <div class="center">
                        <form action="">
                        <table align="center">
                        <tr>';
                    $tdNum = 0;
                    if ($this->currentHelper1){
                        $tdNum ++;
                        echo '
                            <td><div class="center">
                                <b><a href="'.$this->createUrl('User', 'Profile', null, $this->currentHelper1['login']).'">'.$this->currentHelper1['login'].'</a></b>
                                </div>
                                <div class="left">
                                <input type="radio" name="helper1" value="2" checked /> хорошо помогал<br />
                                <input type="radio" name="helper1" value="1" /> плохо помогал<br />
                                <input type="radio" name="helper1" value="0" /> не помогал
                                </div>
                            </td>';
                    }
                    if ($this->currentHelper2){
                        $tdNum ++;
                        echo '
                            <td><div class="center">
                                <b><a href="'.$this->createUrl('User', 'Profile', null, $this->currentHelper1['login']).'">'.$this->currentHelper2['login'].'</a></b><br />
                                </div>
                                <div class="left">
                                <input type="radio" name="helper2" value="2" checked /> хорошо помогал<br />
                                <input type="radio" name="helper2" value="1" /> плохо помогал<br />
                                <input type="radio" name="helper2" value="0" /> не помогал
                                </div>
                            </td>';
                    }
                    echo '
                        </tr>';
                    if ($tdNum){
                        echo '
                        <tr>
                            <td colspan="'.$tdNum.'">
                            <div class="center"><input type="submit" name="estimateHelper" value="Оценить"></div>
                            </td>
                        </tr>';
                    }
                    echo '
                        </table>
                        </form>
                        </div>
                    ';
                }
            }elseif($this->userIdFromHelper){ // Helper
                if ($this->winnerUser){
                    echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                        Поздравляем!</b>';
                }else{
                    echo '<b>В дебатах никто не победил.</b>';
                }
            }elseif($this->user_id){ // registred User
                if ($this->winnerUser){
                    echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                        Поздравляем победителя!<br /><br />';
                    //echo 'Вы сделали правильную ставку и выиграли 12nm</b>';
                }else{
                    echo '<b>В дебатах никто не победил.</b>';
                }
            }else{
                if ($this->winnerUser){
                    echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                        Поздравляем победителя!<br /><br /></b>';
                }else{
                    echo '<b>В дебатах никто не победил.</b>';
                }
            }
            $res1 = ($this->debateResult[$this->debateUser1['id']])?$this->debateResult[$this->debateUser1['id']]:0;
            $res2 = ($this->debateResult[$this->debateUser2['id']])?$this->debateResult[$this->debateUser2['id']]:0;
            echo '<br/><br/><b>Результаты голосования:</b><br/> '.
                 '<b><a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a></b> - '.$res1.'<br/> '.
                 '<b><a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a></b> - '.$res2;
            ?>			
			<p class="end-info"> 
				<span>В дебатах</span> 
					Есть ли жизнь на марсе? 
				<span>победил <a class="avatar-link" href="#"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">leonid</span></a> и его помошники <a href="#">suslik</a> и <a href="#">murzik</a></span> 
			</p> 
			<h1 class="congratulations">Поздравляем победителя!</h1> 
			<h2>Вы сделали правильную ставку и выиграли <span class="nm">120 nm</span></h2>
			<?php echo $this->debate_pager;  ?> 
		</div></div> 
		<!-- /end-view --> 
	</div> 
<!-- /debate-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
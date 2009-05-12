<?php include($this -> _include('../header.tpl.php')); ?>
				<div class="debate-page"> 
					<ul class="view-filter clearfix"> 
					<!-- 	<li><strong>Активные дебаты<span></span></strong></li> 
						<li><a href="#">Завершенные дебаты</a></li> 
						<li class="alt"><a href="#">Победители</a></li> --> 
						<?php include($this -> _include('../tab_panel.tpl.php')); ?>
					</ul> 
					<!-- /view-filter --> 
					<div class="d-head"> 
						<input type="hidden" name="currEtap" id="currEtap" value="Results" />
						<input type="hidden" name="refreshNow" id="refreshNow" value="0" />	
						<div class="title clearfix"> 
							<div class="stage">Этап <strong>7</strong> из 7.  Дебаты завершены!</div>
							<?php $this->showTimer(); ?> 
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
					<div class="end-view"><div class="wrap"> 
			<?php
            if ($this->userNumber){ // Debate User
                if ($this->winnerUser){
                    if ($this->user_id == $this->winnerUser['id']){
                    	echo '<i class="big-icon win-icon"></i>';
                	   	echo '<p class="end-info"><span>Вы победили в дебатах</span> '.$this->debateNow['theme'].'</p><h1 class="congratulations">Поздравляем!</h1>';
                    }else{
                        echo '<i class="big-icon lose-icon"><p class="end-info"> 
								<span>В дебатах</span> 
									'.$this->debateNow['theme'].' 
								<span>победил <a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">'.$this->winnerUser['login'].'</span></a> и его помошники <a href="#">suslik</a> и <a href="#">murzik</a></span>'.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).' 
							</p>
							<h1 class="congratulations"><a href="#">Попробывать себя в других дебатах</a></h1>';
                    }
                }else{ // ничья
                    echo '<i class="big-icon lose-icon"></i><p class="end-info"><span>В дебатах никто не победил.</span></p>';
                }
                if (!$this->isEstimated){ // not estimated
                	if($this->currentHelper1 || $this->currentHelper2) {
                	echo '<h2>Оцените ваших помошников</h2> 
							<form class="assess" action="" method="post"> 
								<ul class="helpers-vote clearfix">';
                    $tdNum = 0;
                    if ($this->currentHelper1){
                        $tdNum ++;
                        echo '<li class="it">
								<a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $this->currentHelper1['login']).'"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">'.$this->currentHelper1['login'].'</span></a> 
									<ul> 
										<li><input type="radio" name="helper1" value="2" checked="checked" id="m11" /><label for="m11">Хорошо помогал</label></li> 
										<li><input type="radio" name="helper1" value="1" id="m12" /><label for="m12">Плохо помогал</label></li> 
										<li><input type="radio" name="helper1" value="0" id="m13" /><label for="m13">Не помогал</label></li> 
									</ul>                         
                        	  </li>';
                 //   }
                //    if ($this->currentHelper2){
                        $tdNum ++;
                        echo '<li class="it last">
								<a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $this->currentHelper1['login']).'"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">'.$this->currentHelper2['login'].'</span></a> 
									<ul> 
										<li><input type="radio" name="helper2" value="2" checked="checked" id="m21" /><label for="m21">Хорошо помогал</label></li> 
										<li><input type="radio" name="helper2" value="1" id="m22" /><label for="m22">Плохо помогал</label></li> 
										<li><input type="radio" name="helper2" value="0" id="m23" /><label for="m23">Не помогал</label></li> 
									</ul>                         
                        	  </li>';
                    }
                    echo '</ul>';
                    if ($tdNum){
                        echo '<div class="buttom-field"><input type="submit" name="estimateHelper" value="Оценить" /></div>';
                    }
                    echo '</form>';
                	}
                }
            }elseif($this->userIdFromHelper){ // Helper
                if ($this->winnerUser){
                    echo '<p class="end-info"> 
								<span>В дебатах</span> 
									'.$this->debateNow['theme'].' 
								<span>победил <a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">'.$this->winnerUser['login'].'</span></a> и его помошники <a href="#">suslik</a> и <a href="#">murzik</a></span>'.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).' 
							</p>';
                }else{
                    echo '<i class="big-icon lose-icon"></i><p class="end-info"><span>В дебатах никто не победил.</span></p>';
                }
            }elseif($this->user_id){ // registred User
                if ($this->winnerUser){
                    echo '<p class="end-info"> 
								<span>В дебатах</span> 
									'.$this->debateNow['theme'].' 
								<span>победил <a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">'.$this->winnerUser['login'].'</span></a> и его помошники <a href="#">suslik</a> и <a href="#">murzik</a></span>'.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).' 
							</p>';
                    //echo 'Вы сделали правильную ставку и выиграли 12nm</b>';
                }else{
                    echo '<i class="big-icon lose-icon"></i><p class="end-info"><span>В дебатах никто не победил.</span></p>';
                }
            }else{
                if ($this->winnerUser){
                    echo '<p class="end-info"> 
								<span>В дебатах</span> 
									'.$this->debateNow['theme'].' 
								<span>победил <a class="avatar-link" href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'"><img class="avatar" alt="" src="assets/i/temp/avatar.s.jpg"/><span class="t">'.$this->winnerUser['login'].'</span></a> и его помошники <a href="#">suslik</a> и <a href="#">murzik</a></span>'.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).' 
							</p>';
                }else{
                    echo '<i class="big-icon lose-icon"></i><p class="end-info"><span>В дебатах никто не победил.</span></p>';
                }
            }
            $res1 = ($this->debateResult[$this->debateUser1['id']])?$this->debateResult[$this->debateUser1['id']]:0;
            $res2 = ($this->debateResult[$this->debateUser2['id']])?$this->debateResult[$this->debateUser2['id']]:0;
            echo '<table style="text-align:center;width:100%;">
            		<thead><tr><th colspan="2"><h2>Результаты голосования</h2></th></tr></thead><tbody>'.
                 '<tr><td><a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a></td><td style="text-align:left;">'.$res1.'</td></tr>'.
                 '<tr><td><a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a></td><td style="text-align:left;">'.$res2.'</td></tr></tbody></table>';
            ?>
            <?php echo $this->debate_pager;  ?> 			
					</div></div> 
					<!-- /end-view --> 
			</div> 
			<!-- /debate-page --> 
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
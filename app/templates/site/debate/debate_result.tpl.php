<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	


<!-- Этап 7 из 7. Окончание. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось 30 минут
</div></div></div></div>


<h2>Этап 7 из 7. Окончание.</h2>
<?php
if ($this->userNumber){ // Debate User
	echo 'Дебаты окончены. Спасибо за участие. Вы должны выставить оценки вашим помощникам.';
}elseif($this->userIdFromHelper){ // Helper
    echo 'Дебаты окончены. Спасибо за участие.';
}elseif($this->user_id){ // registred User
    echo 'Дебаты окончены. Спасибо что досмотрели до конца.';
}else{
    echo 'Дебаты окончены. Спасибо что досмотрели до конца.';
}
?>

<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<div style="text-align: center; margin: 0px -10px;">
	<div style="width: 40%;">
		<table class="questions">
		<tr>
			<td>
			<div class="center">
			<?php
            if ($this->userNumber){ // Debate User
                if ($this->user_id == $this->winnerUser['id']){
            	   echo '<b>Вы победили в дебатах на тему «'.$this->debateNow['theme'].'».<br />
                    Поздравляем!</b>';
                }else{
                    echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> и его помощники '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                    </b>';
                }
                if (!$this->isEstimated){ // not estimated
                    echo '
                        <div class="center">
                        <form action="">
                        <table>
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
                echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> и его помощники '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                    Поздравляем!</b>';
            }elseif($this->user_id){ // registred User
                echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> и его помощники '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                    Поздравляем победителя!<br /><br />';
                echo '
                    Вы сделали правильную ставку и выиграли 12nm</b>';
            }else{
                echo '<b>В дебатах на тему «'.$this->debateNow['theme'].'» победил <a href="'.$this->createUrl('User', 'Profile', null, $this->winnerUser['login']).'">'.$this->winnerUser['login'].'</a> и его помощники '.$this->showWinnerHelpersName($this->winnerHelper1, $this->winnerHelper2, $this->user_id).'.<br />
                    Поздравляем победителя!<br /><br /></b>';
            }
            ?>

			
			</div>
			</td>
		</tr>
		</table>
	</div>
	</div>

	<?php echo $this->debate_pager;  ?>
	
</div></div></div></div>


<!-- /Этап 7 из 7. Окончание. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
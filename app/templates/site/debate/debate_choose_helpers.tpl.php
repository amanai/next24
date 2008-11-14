<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	


<!-- Этап 4 из 7. Идет выбор помощников. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось 30 минут
</div></div></div></div>


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
	<div style="width: 10%;">
	первый в дебатах: <b><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a>'; ?></b>
	второй в дебатах: <b><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a>'; ?></b>
	
	    <form name="frmCheckHelper" action="" method="POST">
		<table class="questions">
		<tr>
			<td align="left"> <b>Тема дебатов: </b></td><td><b><?php echo $this->debateNow['theme']; ?></b></td>
        </tr>
		<?php 
		if ($this->isDebateUser){
		    echo '
		    <table class="helpers_list">
		      <tr>
		          <th>Помощник</th>
		          <th>Рейтинг</th>
		          <th>Действия</th>
		      </tr>
		    ';
		    foreach ($this->aDebateUserHelpers as $debateUserHelpers){
		        echo '
		      <tr>
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
		    echo '</table>';
		}elseif (!$this->helperTable){
		    echo '
    		<tr>
    			<td colspan="2"> <input type="submit" size=250 name="helper1" value="Я хочу быть помощником участника '.$this->debateUser1['login'].'" /> </td>
    		</tr><tr>
    			<td colspan="2"> <input type="submit" size=250 name="helper2" value="Я хочу быть помощником участника '.$this->debateUser2['login'].'" /> </td>
    		</tr>
		    ';
		}elseif ($this->helperTable){
		    echo '
		    <tr>
    			<td colspan="2"> Вы выбрали быть помощником у '.$this->helperTable['login'].'</td>
    		</tr>
		    ';
		}
		?>
        
		</table>
		</form>
		
	</div></div>

		
</div></div></div></div>



<!-- /Этап 4 из 7. Идет выбор помощников. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
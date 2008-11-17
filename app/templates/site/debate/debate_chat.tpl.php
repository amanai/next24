<?php include($this -> _include('../header.tpl.php')); ?>

<script type="text/javascript">
function send_message(fromId, toId){
    var fromElement = document.getElementById(fromId);
    ajax(
        {"url":"\/debate_chat","type":"POST","async":true,"data":{"areaId":toId,"textValue":fromElement.value},"dataType":"json"}, 
        true);
    <?php
    //echo 'ajax('.AjaxRequest::getJsonParam("Debate", "DebateChat", array("areaId"=>areaId , "textValue"=>areaElement.value, "lastUpdate"=>lastUpdate), "POST").', true);';
    ?>
    fromElement.value = "";
    return true;
}

</script>

<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	


<!-- Этап 5 из 7. Подтверждение готовности, прием ставок. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось 30 минут
</div></div></div></div>


<h2>Этап 5 из 7. Подтверждение готовности, прием ставок.</h2>
<?php 
if ($this->userNumber && $this->isReady){ 
    echo 'Подождите пока будут сделаны ставки и участники подтвердят свою готовность к дебатам.';
}
?>
Вы можете общаться в чате с другими пользователями. ВНИМАНИЕ – мат в чате запрещен.
Кроме того, вы можете проголосовать за одного из участников дебатов.
<hr />
Вы можете общаться с другим участником дебатов, так также сделать запрос на перерыв на 10 минут. Перерыв будет объявлен только при
подтверждении его другим участником дебатов.
<hr />
Вы можете подсказывать своему участнику дебатов как лучше вести линию разговора. По окончании дебатов, участник выставит вам оценку,
поэтому постарайтесь подсказывать по существу.
<hr />
Дебаты прерваны на перерыв. Во время перерыва в окне дебатов могут оставлять свои сообщения помощники.
<hr />
Дебаты прерваны на перерыв. Во время перерыва в окне дебатов могут оставлять свои сообщения помощники.
<hr />

<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

    <div style="text-align: center; margin: 0px -10px;">
	<div style="width: 10%;">
	первый в дебатах: <b><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser1['login']).'">'.$this->debateUser1['login'].'</a>'; ?></b><br>
	второй в дебатах: <b><?php echo '<a href="'.$this->createUrl('User', 'Profile', null, $this->debateUser2['login']).'">'.$this->debateUser2['login'].'</a>'; ?></b>
	
		<table class="questions">
		<tr>
			<td colspan="3"><div class="center"><b>Тема дебатов: <?php echo $this->debateNow['theme']; ?></b></div></td>
        </tr>
		<tr>
			<td align="left" colspan="3"> <div class="ChatMessagesB" id="chat_messages"></div> </td>
	    </tr>
		<tr>
		    <td colspan="2"> 
		       <textarea id="chat_text" name="chat_text" cols="58" rows="3"></textarea>
			</td>
			<td>
			   <input type="button" onclick="javascript:send_message('chat_text', 'chat_messages');" value="Сказать" /><br/>
			   <input type="button" value="Перерыв" />
			</td>
		</tr>
		
		
		<tr>
		    <td colspan="3"> 
		       <div class="center"><input type="button" value="Разрешить говорить первому " />&nbsp;&nbsp;<input type="button" value="Разрешить говорить второму " /></div>
			</td>
		</tr>
		
		
		<tr>
			<td colspan="3"><div class="center"><b>Чат помощников</b></div></td>
        </tr>
        <tr>
			<td align="left" colspan="3"> <div class="ChatMessagesB_helpers" id="chat_messages_helpers"></div> </td>
	    </tr>
	    <tr>
		    <td colspan="2"> 
		       <textarea id="chat_text_helpers" name="chat_text_helpers" cols="58" rows="1"></textarea>
			</td>
			<td>
			   <input type="button" onclick="javascript:send_message('chat_text_helpers', 'chat_messages_helpers');" value="Сказать" />
			</td>
		</tr>
		</table>
		
	</div></div>

		
</div></div></div></div>



<!-- /Этап 5 из 7. Подтверждение готовности, прием ставок. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
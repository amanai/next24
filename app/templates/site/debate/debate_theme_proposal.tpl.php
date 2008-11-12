<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
	


<!-- Этап 1 из 7. Идет прием тем для дебатов. -->
<div class="block_ee1 debati_time"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	Осталось 30 минут
</div></div></div></div>


<h2>Этап 1 из 7. Идет прием тем для дебатов.</h2>
Вы можете свою тему для дебатов. Если ваша тема победит при последующем голосовании вы станете участником дебатов.
ВНИМАНИЕ. Если вы не уверены, что сможете участвовать в дебатах то не отправляйте тему на конкурс. Прочитайте сначала <a href="#">правила дебатов</a>.
<br /><div id="brok"></div>

<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<div style="margin: 0px -10px;">
		<table class="questions">
		<tr>
			<td style="width: 100%; text-align: left;"><img src="<?php echo $this -> image_url; ?>open.png" width="21" height="24" align="absmiddle" /> <a href="#"><b>Тема</b></a></td>
			<td><img src="<?php echo $this -> image_url; ?>open.png" width="21" height="24" align="absmiddle" /> <a href="#"><b>Предложил</b></a></td>
		</tr>

		<tr id="cmod_tab2">
			<td style="text-align: left;"><a href="#">Есть ли жизнь на Марсе ???</a></td>
			<td><a href="#">Hunter</a></td>
		</tr>

		<tr>
			<td style="text-align: left;"><a href="#">Есть ли жизнь на Марсе ???</a></td>
			<td><a href="#">Hunter</a></td>
		</tr>

		<tr id="cmod_tab2">
			<td style="text-align: left;"><a href="#">Есть ли жизнь на Марсе ???</a></td>
			<td><a href="#">Hunter</a></td>
		</tr>

		<tr>
			<td style="text-align: left;"><a href="#">Есть ли жизнь на Марсе ???</a></td>
			<td><a href="#">Hunter</a></td>
		</tr>
		</table>
	</div>

	<!-- листинг -->
	<div class="listing_div_r">
		<li class="listing">
			<a href="#" title="Предыдущая страница">«</a>
			<a class="active">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a href="#" title="Следующая страница">»</a>
		</li>
	</div>
	<!-- /листинг -->
</div></div></div></div>


<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
	<div class="block_title"><h2>Новая тема</h2></div>
	<!-- Новая тема -->
	<div>
		<form action="">
			<table width="100%">
			<tr>
				<td width="100%"><input type="text" style="width: 100%;" /></td>
				<td><input type="submit" value="Предложить" /></td>
			</tr>
			</table>
		</form>
	</div>
	<!-- /Новая тема -->
</div></div></div></div>
<!-- /Этап 1 из 7. Идет прием тем для дебатов. -->








    </div>
</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
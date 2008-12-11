<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- напоминилка пароля -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_right">
				<form action="<?php echo $this -> createUrl('User', 'RemindPassword'); ?>" method="post" id="remind_form">
                <?=$this -> flash_messages; ?>
                <table class="regdetails" cellpadding="4">
                <tr>
            		<td>Введите Email с которым Вы регистрировались </td>
            		<td>
            			<input type="text" name="email" size="50" class="field"/>
            		</td>
            	</tr>
                </table>
                <input type="submit" name="remind" value="Напомнить" />
                </form>
			</td>
		</tr>
		</table>
		<!-- / напоминилка пароля -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
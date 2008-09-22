<?php include($this -> _include('../header.tpl.php')); ?>
<!-- Главный блок, с вкладками (Контент) -->
<div class="tab-page" id="modules-cpanel">
	<?php include($this -> _include('../tab_panel.tpl.php')); ?>
	<div class="tab-page tab-page-selected">
		<!-- РЕГИСТРАЦИЯ -->
		<table width="100%" height="100%" cellpadding="0">
		<tr>
			<td class="next24u_left">
				<!-- левый блок -->
					<?php  include($this -> _include('control_panel.tpl.php')); ?>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
				<!-- правый блок -->
				<?php include($this -> _include('form_registration.tpl.php')); ?>
				<!--	<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">
						<div class="block_title">
								<div class="block_title_left"><h2>Редактирование профиля</h2></div>
								<div class="block_title_right"><img src="<?php echo $this -> image_url;?>/close.png" width="21" height="24" onclick="ShowOrHide(this, 'user_profile_js')" style="cursor: pointer;" /></div>
						</div>
						<?php include($this -> _include('form_registration.tpl.php')); ?>
					</div></div></div></div>-->
				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /РЕГИСТРАЦИЯ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
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
					<?php  include($this -> _include('../user/control_panel.tpl.php')); ?>
				<!-- /левый блок -->
			</td>
			<td class="next24u_right">
				<!-- правый блок -->
<div class="block_ee1"><div class="block_ee2"><div class="block_ee3"><div class="block_ee4">

	<?php  include($this -> _include('my_places_list.tpl.php')); ?>


	<form action="/user/objects/" id="nav_form" method="post">
		<h2 class="tmarg">Добавление нового места
		
		<select id="geo_type" style="width: 150px;" name="geo_type_id">
		<? if (!$this->session->geo_type_id) { ?><option value="0" selected="selected">- выберите тип -</option><? } ?>
		<? foreach ($this->geo_types as $item) { ?>
			<option value="<?=$item['id'];?>"<?=($item['id']==$this->session->geo_type_id?' selected="selected"':'');?>><?=$item['name'];?></option>
		<? } ?>
		</select>
		
		</h2><br/>
		<table border="0" cellpadding="4">

		<tr>
			<td width="100">Страна:</td>
			<td>
				<select id="country" style="width: 150px;" name="country_id"<?=$this->isClosed('country')?' disabled="disabled"':''?>>
				<? if ($this->isClosed('country')) { ?><option value="0" selected="selected">выберите тип места</option>
				<? } elseif (!$this->session->country_id) { ?><option value="0" selected="selected">- выберите страну -</option><? } ?>
				<? foreach ($this->countries as $item) { ?>
					<option value="<?=$item['id'];?>"<?=($item['id']==$this->session->country_id?' selected="selected"':'');?>><?=$item['name'];?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Город:</td>
			<td>
				<select id="ct_sel" onChange="CitySelect();" style="width: 250px;" name="ct_id" disabled="disabled">

											<option value="0">выберите страну</option>
									</select> 
				<input type="submit" value="добавить город" onClick="return AddCity();">
			</td>
		</tr>
		<tr>
			<td>Тип:</td>
			<td>

				<select id="got_sel" onChange="TypeSelect();" style="width: 250px;" name="got_id" disabled="disabled">
											<option value="0">выберите город</option>
									</select> 
				<input type="submit" value="добавить тип" onClick="return AddType();">
			</td>
		</tr>
		<tr>
			<td>Место:</td>

			<td>
				<select id="go_sel" onChange="PlaceSelect();" style="width: 250px;" name="go_id" disabled="disabled">
											<option value="0">выберите тип</option>
									</select> 
				<input type="submit" value="добавить место" onClick="return AddPlace();">&nbsp;<span id="show_users"></span>
			</td>
		</tr>
		<tr><td colspan="2" align="left"><br/><input type="submit" class="button" name="tmp" onClick="return AddObjToUser(); " value="Добавить"/></td></tr>
		</table>

		
</form>
		
		
		
	
</div></div></div></div>

				<!-- /правый блок -->
			</td>
		</tr>
		</table>
		<!-- /РЕГИСТРАЦИЯ -->
	</div>

</div>
<!-- /Главный блок, с вкладками (Контент) -->
<?php include($this -> _include('../footer.tpl.php')); ?>
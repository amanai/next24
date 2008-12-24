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


	<form action="<?php echo $this->createUrl('Places', 'AddEntity', null, $this->current_user->login)?>" id="nav_form" method="post">
		<h2 class="tmarg">Добавление нового места
		
		<select id="geo_type" onChange="reload_dropdowns('geo_type');" style="width: 150px;" name="geo_type_id">
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
				<?=$this->_dropdown('country', 'выберите тип места', '- выберите страну -', $this->countries); ?>
			</td>
		</tr>
		<tr>
			<td>Город:</td>
			<td>
				<?=$this->_dropdown('city', 'выберите страну', '- выберите город -', $this->cities); ?>
			</td>
		</tr>
		<tr>
			<td>Тип:</td>
			<td>
				<?=$this->_dropdown('geo_subtype', 'выберите город', '- выберите тип -', $this->geo_subtypes); ?>
				
				<input type="submit" name="add_type" value="добавить тип" onClick="return AddType();">
			</td>
		</tr>
		<tr>
			<td>Место:</td>

			<td>
				<?=$this->_dropdown('geo_place', 'выберите тип', '- выберите место -', $this->geo_places); ?>
				
				<input type="submit" value="добавить место" name="add_place" onClick="return AddPlace();">&nbsp;<span id="show_users"></span>
			</td>
		</tr>
		<tr><td colspan="2" align="left"><br/><input type="submit" class="button" name="add_object_to_user" onClick="return AddObjToUser(); " value="Добавить"/></td></tr>
		</table>

	
		
		<? if (Project::getRequest()->add_type) include($this -> _include('addtype_form.tpl.php')); ?>
		<? if (Project::getRequest()->add_place) include($this -> _include('addplace_form.tpl.php')); ?>
		<? if (Project::getRequest()->add_object_to_user) include($this -> _include('add_object_to_user_form.tpl.php')); ?>
		
		<? if ($this->edit_place) include($this -> _include('add_object_to_user_form.tpl.php')); ?>
		
		<? if (is_array($this->users_list)) include($this -> _include('users_list.tpl.php')); ?>
		
		
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
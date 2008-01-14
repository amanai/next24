<script language="JavaScript">
	function changeType(){		
		document.f.action = "<?php echo $this->router->createUrl('Rights', 'Index')?>";
		document.f.submit();
	}
</script>
<form action="<?php echo $this->router->createUrl('Rights', 'Save')?>" name="f" method="post">
<table width="100%">
	<tr><th colspan="100" align="center"><?php echo $this->title;?></th></tr>
	<tr>
		<td>
			<select onchange="changeType()" name="userType">
			<?php foreach($this->userTypes as $type){
				$selected = '';
				if ($type['id'] == $this->userType)	$selected = 'selected';
				echo '<option value="'.$type['id'].'" '.$selected.'>'.$type['name'].'</option>';
				}
			?>
			</select>
		</td>
	</tr>
</table>
				
<table width="100%" border="1">
	<tr><th colspan="100" align="center">Карта прав</th></tr>
	<tr><td align="center">Контроллеры</td><td align="center">Дейсвия</td><td align="center">Субдействия</td></tr>
	<?php foreach($this->rightsData as $controllerId=>$controllerData){ ?>
		<tr>
			<td>
				<input type="checkbox" name="controller[<?php echo $controllerData['name']?>]" <?php if($controllerData['allowed']) echo "checked"; ?>/>&nbsp
				<?php echo $controllerData['name']; ?>
			</td>
			<?php $actionCount = 0;?>
			<?php foreach($controllerData['actions'] as $actionId=>$actionData){ ?>
				<?php if($actionCount >0){?>
				<tr><td>&nbsp;</td>
				<?php }?>
				<td>
					<input type="checkbox" name="action[<?php echo $controllerData['name']?>][<?php echo $actionData['name']?>]" <?php if($actionData['allowed']) echo "checked"; ?>/>&nbsp
					<?php echo $actionData['name']; ?>
				</td>
				<?php $actionCount++; ?>
				
				<?php $subactionCount = 0; ?>
				<?php foreach($actionData['subactions'] as $subactionId=>$subactionData){ ?>
					<?php if($subactionCount >0){?>
					<tr><td>&nbsp;</td><td>&nbsp;</td>
					<?php }?>
					<td>
						<input type="checkbox" name="subaction[<?php echo $controllerData['name']?>][<?php echo $actionData['name']?>][<?php echo $subactionData['name']?>]" <?php if($subactionData['allowed']) echo "checked"; ?>/>&nbsp
						<?php echo $subactionData['name']; ?>
					</td>
					</tr>
					<?php $subactionCount++; ?>
				<?php }?>
				</tr>
			<?php }?>
		</tr>			
	<?php }?>
	<tr><td colspan="100" align="right"><input type="submit" value="Сохранить"></td></tr>
</table>
</form>
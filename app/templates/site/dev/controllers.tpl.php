<?php include($this -> _include('../header.tpl.php')); ?>

<h2><a href="<?=$this -> createUrl('Dev', 'Controllers')?>">Контроллеры</a></h2><br/>
<table border="1" cellpadding="2">
	<tr style="background-color: #dedede;">
		<td>
			<b>Имя</b>
		</td>
		<td>
			<b>Описание</b>
		</td>
		<td>
			<b>Админский?</b>
		</td>
		<td>
			<b>По умолчанию?</b>
		</td>
		<td>
			<b>Действия</b>
		</td>
	</tr>
	<? foreach ($this->controllers as $controller) { ?>
	<tr<?=$controller['id']==$this->econtroller['id']?' style="background-color: yellow;"':''?>>
		<td>
			<?=$controller['name']?>
		</td>
		<td>
			<?=$controller['description']?>
		</td>
		<td>
			<?=$controller['admin']?'да':'нет'?>
		</td>
		<td>
			<?=$controller['default']?'да':'нет'?>
		</td>
		<td>
			<a href="<?=$this -> createUrl('Dev', 'Controllers', array('id'=>$controller['id'])); ?>">Править</a>&nbsp;|&nbsp;<a href="<?=$this -> createUrl('Dev', 'ControllerDelete', array('id'=>$controller['id'])); ?>">Удалить</a>&nbsp;|&nbsp;<a href="<?=$this -> createUrl('Dev', 'Actions', array('cid'=>$controller['id'])); ?>"><b>Действия</b></a>
		</td>
	</tr>
	<? } ?>
	<form action="<?=$this->econtroller?$this -> createUrl('Dev', 'ControllerSave', $this->econtroller?array('id'=>$this->econtroller['id']):null):$this -> createUrl('Dev', 'ControllerAdd'); ?>" method="post">
	<tr>
		<td>
			<input type="text" name="name" value="<?=$this->econtroller['name']?>">
		</td>
		<td>
			<input type="text" name="description" value="<?=$this->econtroller['description']?>">
		</td>
		<td>
			<input type="checkbox" name="admin" value="1"<?=$this->econtroller['admin']?' checked="checked"':''?>>
		</td>
		<td>
			<input type="checkbox" name="default" value="1"<?=$this->econtroller['default']?' checked="checked"':''?>>
		</td>
		<td>
			<input type="submit" name="send" value="<?=$this->econtroller?'Сохранить':'Добавить'?>">
		</td>
	</tr>
	</form>
</table>


<?php include($this -> _include('../footer.tpl.php')); ?>
<?php include($this -> _include('../header.tpl.php')); ?>
<? //print_r($this);?>
<? if (!$this->controller) { ?>
	Выберите <a href="<?=$this -> createUrl('Dev', 'Controllers')?>">контроллер</a>.
<? } else { ?>
<h2>Действия контроллера <?=$this->controller->name?>. <a href="<?=$this -> createUrl('Dev', 'Controllers')?>">Назад к контроллерам</a></h2><br/>
<table border="1" cellpadding="2">
	<tr style="background-color: #dedede;">
		<td>
			<b>Имя</b>
		</td>
		<td>
			<b>Тайтл страницы</b>
		</td>
		<td>
			<b>Ключ запроса</b>
		</td>
		<td>
			<b>По умолчанию?</b>
		</td>
		<td>
			<b>Действия</b>
		</td>
	</tr>
	<? foreach ($this->actions as $action) { ?>
	<tr<?=$action['id']==$this->eaction['id']?' style="background-color: yellow;"':''?>>
		<td>
			<?=$action['name']?>
		</td>
		<td>
			<?=$action['page_title']?>
		</td>
		<td>
			<?=$action['request_key']?>
		</td>
		<td>
			<?=$action['default']?'да':'нет'?>
		</td>
		<td>
			<a href="<?=$this -> createUrl('Dev', 'Actions', array('id'=>$action['id'], 'cid'=>$action['controller_id'])); ?>">Править</a>&nbsp;|&nbsp;<a href="<?=$this -> createUrl('Dev', 'ActionDelete', array('id'=>$action['id'])); ?>">Удалить</a>
		</td>
	</tr>
	<? } ?>
	<form action="<?=$this->eaction?$this -> createUrl('Dev', 'ActionSave', $this->eaction?array('id'=>$this->eaction['id'], 'cid'=>$action['controller_id']):null):$this -> createUrl('Dev', 'ActionAdd', array('cid'=>$action['controller_id'])); ?>" method="post">
	<tr>
		<td>
			<input type="text" name="name" value="<?=$this->eaction['name']?>">
		</td>
		<td>
			<input type="text" name="page_title" value="<?=$this->eaction['page_title']?>">
		</td>
		<td>
			<input type="text" name="request_key" value="<?=$this->eaction['request_key']?>">
		</td>
		<td>
			<input type="checkbox" name="default" value="1"<?=$this->eaction['default']?' checked="checked"':''?>>
		</td>
		<td>
			<input type="submit" name="send" value="<?=$this->eaction?'Сохранить':'Добавить'?>">
		</td>
	</tr>
	</form>
</table>
<? } ?>


<?php include($this -> _include('../footer.tpl.php')); ?>
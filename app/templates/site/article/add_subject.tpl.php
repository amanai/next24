<?php include($this -> _include('../header.tpl.php')); ?>

<div class="tab-page" id="modules-cpanel">
				<?php include($this -> _include('../tab_panel.tpl.php')); ?>
				<div class="tab-page tab-page-selected">

<form action="<?=$this->createUrl('Article', 'SaveSubject')?>" method="POST">
	<table cellpadding="2">
		<tr>
			<td colspan="2"><?=$this->message?></td>
		</tr>
		<tr>
			<td>Тема: </td>
			<td><input type="text" style="width:200px" name="title" id="title" <?if($this->active == false) echo "disabled"?>></td>
		</tr>
		<tr>
			<td>Категория: </td>
			<td>
				<select style="width:200px" id="parent_id" name="parent_id" <?if($this->active == false) echo "disabled"?>>
					<option value="0" > -- Select -- </option>
					<?foreach ($this->tree as $n):?>
						<option value="<?=$n['id']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;",  $n['level'] -1)?><?=$n['name']?></option>
					<?endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="padding-right: 6px;"><input type="submit" name="submit" id="submit" value="Предложить тему" <?if($this->active == false) echo "disabled"?>></td>
		</tr>
	</table>
</form>
				</div>

			</div>

<?php include($this -> _include('../footer.tpl.php')); ?>

